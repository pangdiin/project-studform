<?php

namespace App\Repositories\Backend\Project;

use App\Models\Project\Project as Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use Image;
use File;

/**
 * Class ProjectRepository.
 */
class ProjectRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Model::class;

    /**
     * @var Project Model
     */
    protected $model;

    /**
     * @var History slug $history_slug
     */
    protected $history_slug = 'Project';

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param Request  $request
     *
     * @return mixed
     */
    public function getForDataTable($request)
    {
        /**
         * Note: You must return deleted_at or the User getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */

        $query = $this->query()
            ->select([
                'id', 'name', 'slug', 'status', 'image', 'deleted_at', 'updated_at'
            ]);

        if($request->trashed == "true"){
            $query->onlyTrashed();
        }
        return $query;
    }

    /**
     * @param Request $request
     * @param Model  $model
     *
     * @return static
     */
    public function store($request, $model = null)
    {

        $data = $this->generateStub($request, $model);

        DB::beginTransaction();

        try {
            if($model){
                $model->update($data);
                $this->eventUpdated($model);
            }else{
                $model = $this->model->create($data);
                $this->eventCreated($model);
            }
            if($request->hasFile('image') ){
                $this->updateImage($model, $request->image);
            }

            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);

            $this->exceptions(trans('base.alerts.failed.messages.' . ($model ? 'updated' : 'created'), ['attribute' => 'Project']));
        }
    }

    public function updateImage($model, $image)
    {
        $path   = 'images/project/';
        $width  = 350;
        $height = 350;
        $name   =  'project_' . $model->slug . '_' . time() . '.' . $image->getClientOriginalExtension();
        if(!file_exists('images')){ $folder = File::makeDirectory('images', 755); }
        if(!file_exists($path)   ){ $folder = File::makeDirectory($path, 755); }
        $full_path = $path . $name;
        DB::beginTransaction();
        try {
            $upload = Image::make($image->getRealPath())->resize($width, $height)->save($full_path);
            File::delete($model->image);
            $model->update(['image' => $full_path]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            if(!file_exists($full_path)){ File::delete($full_path); }
        }
    }


    /**
     * Create stub in storing Inquiries
     * @param Request $request
     * @param Model $model
     * @return array $data
     */
    public function generateStub($request, $model=null)
    {
        $data = $request->only(['name', 'description', 'content']);
        $data['status'] = 'active';
        if($request->status && $request->status != "active"){ $data['status'] = 'disabled'; }
        return $data;
    }


    /**
     * @param Model $model
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function destroy($model)
    {
        DB::transaction(function () use ($model) {
            $deleted = $model;
            if(!$model->priority && $model->delete()){
                $this->eventDeleted($deleted);
                return true;
            }
            $this->exceptions(trans('base.alerts.failed.messages.deleted', ['attribute' => $deleted->name]));
        });

    }

    /**
     * @param Model $user
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function restore($model)
    {
        if (is_null($model->deleted_at)) {
            $this->exceptions('This content has not been deleted yet.');
        }

        if ($model->restore()) {
            $this->eventRestored($model);
            return true;
        }
        $this->exceptions(trans('base.alerts.failed.messages.restored', ['attribute' => 'Project']));
    }

    /**
     * @param Model $user
     *
     * @throws GeneralException
     */
    public function force($model)
    {
        if (is_null($model->deleted_at)) {
            $this->exceptions('This content has not been deleted yet.');
        }

        DB::transaction(function () use ($model) {
            if ($model->forceDelete()) {
                if(file_exists($model->image    )){ File::delete($model->image    ); }
                if(file_exists($model->thumbnail)){ File::delete($model->thumbnail); }
                $this->eventForceDeleted($model);
                return true;
            }

            $this->exceptions(trans('base.alerts.failed.messages.deleted_permanently', ['attribute' => 'Project']));
        });
    }
   
}
