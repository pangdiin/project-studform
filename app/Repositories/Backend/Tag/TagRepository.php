<?php

namespace App\Repositories\Backend\Tag;

use App\Models\Tag as Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use File;
use Image;
/**
 * Class TagRepository.
 */
class TagRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Model::class;

    /**
     * @var Tag Model
     */
    protected $model;

    /**
     * @var History slug $history_slug
     */
    protected $history_slug = 'Tag';

    /**
     * @param RoleRepository $role
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
    public function getForDataTable($request, $type)
    {
        /**
         * Note: You must return deleted_at or the User getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        $dataTableQuery = $this->query()
            ->select([
                'id', 'name', 'type', 'image', 'slug', 'updated_at'
            ])->where('type', $type['key']);

        if ($request->trashed == 'true') {
            return $dataTableQuery->onlyTrashed();
        }

        // active() is a scope on the UserScope trait
        return $dataTableQuery;
    }

    /**
     * @param Request $request
     * @param Model  $model
     *
     * @return static
     */
    public function store($request, $type, $model = null)
    {

        $data = $this->generateStub($request, $type, $model);
        DB::beginTransaction();

        try {
            if($model){
                $model->update($data);
                $tag = $model;
                $this->eventUpdated($tag);
            }else{
                $tag = $this->model->create($data);
                $this->eventCreated($tag);
            }
            if($request->hasFile('image') && $type['image']){
                $this->updateImage($tag, $type, $request->image);
            }
            DB::commit();
            return $tag;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            $this->exceptions(trans('base.alerts.failed.messages.' . ($model ? 'updated' : 'created'), ['attribute' => 'tag']));
        }
    }

    public function updateImage($model, $type, $image)
    {
        if(count($image)){
            $path   = 'images/tag/'. $type['route'] .'/';
            $width  = 350;
            $height = 350;
            $name   = $type['route'] . '_' . $model->slug . '_' . time() . '.' . $image->getClientOriginalExtension();
            if(!file_exists('images')){ $folder = File::makeDirectory('images', 755); }
            if(!file_exists('images/tag')){ $folder = File::makeDirectory('images/tag', 755); }
            if(!file_exists($path)   ){ $folder = File::makeDirectory($path, 755); }
            $full_path = $path . $name;
            DB::beginTransaction();
            try {
                $upload = Image::make($image->getRealPath())->resize($width, $height)->save($full_path);
                File::delete($model->image);
                $model->update(['image' => $full_path]);
                DB::commit();
                return true;
            } catch (\Exception $e) {
                DB::rollback();
                if(!file_exists($full_path)){ File::delete($full_path); }
            }
        }
    }


    /**
     * Create stub in storing Inquiries
     * @param Request $request
     * @param Config Tag Type $type
     * @param Model $model
     * @return array $data
     */
    public function generateStub($request, $type, $model=null)
    {
        $data = [];
        if(!$model){ $data['type'] = $type['key']; }
            
        foreach ($request->only(['name', 'description']) as $key => $value) {
            $data[$key] = $value;
        }
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
            $tag = $model;
            if($model->delete()){
                if(file_exists($model->image    )){ File::delete($model->image    ); }
                $this->eventForceDeleted($tag);
                return true;
            }
            $this->exceptions(trans('base.alerts.failed.messages.deleted', ['attribute' => 'tag #' . $tag->id]));
        });

    }
   
}
