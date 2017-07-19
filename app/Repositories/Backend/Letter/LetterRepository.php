<?php

namespace App\Repositories\Backend\Letter;

use App\Models\Letter\Letter as Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use Image;
use File;

/**
 * Class LetterRepository.
 */
class LetterRepository extends BaseRepository
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
    protected $history_slug = 'Letter';

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
                'id', 'name', 'slug','content','deleted_at', 'updated_at'
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
        $data = $request->only(['name','content']);
        $data['status'] = 'active';
        if($request->status != "active"){ $data['status'] = 'disabled'; }
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


}
