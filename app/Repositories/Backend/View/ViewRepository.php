<?php

namespace App\Repositories\Backend\View;

use App\Models\View\View as Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use Image;
use File;

/**
 * Class ViewRepository.
 */
class ViewRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Model::class;

    /**
     * @var View Model
     */
    protected $model;

    /**
     * @var History slug $history_slug
     */
    protected $history_slug = 'View';

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
            if(count($request->contents)){
                $this->storeContent($model, $request);
            }

            if($request->hasFile('image')){
                $this->updateImage($model, $request->only(['image']));
            }
            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            $this->exceptions($e->getMessage());
        }
    }


    public function storeContent($model, $request)
    {
        DB::beginTransaction();
        try {
            $model->contents()->delete();
            foreach ($request->contents as $c => $content) {
                $type = $model->contents()->create(['type' => $content]);
                $criteria = array_get($request->criteria, $content);
                if(count($criteria['field'])){
                    $data = [];
                    foreach ($criteria['field'] as $index => $value) {
                        $field      = $value;
                        $comparison = $criteria['comparison'][$index];
                        $condition  = $criteria['condition' ][$index];
                        $data[] = [
                            'view_id'       => $model->id,
                            'content_id'    => $type->id,
                            'field'         => $field,
                            'comparison'    => $comparison,
                            'condition'     => $condition,
                        ];
                    }
                    $type->criterias()->insert($data);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            $this->exceptions($e->getMessage());
        }

    }


    public function updateImage($model, $images)
    {
        if(count($images)){
            foreach ($images as $key => $image) {
                if(!$image){ continue; }
                $path   = 'images/views/'. $key .'/';
                $width  = $key == "image" ? '988' : '403';
                $height = $key == "image" ? '600' : '200';
                $name   = $key . '_' . $model->slug . '_' . time() . '.' . $image->getClientOriginalExtension();
                if(!file_exists('images')){ $folder = File::makeDirectory('images', 755); }
                if(!file_exists('images/views')   ){ $folder = File::makeDirectory('images/views', 755); }
                if(!file_exists($path)   ){ $folder = File::makeDirectory($path, 755); }
                $full_path = $path . $name;
                DB::beginTransaction();
                try {
                    $upload = Image::make($image->getRealPath())->resize($width, $height)->save($full_path);
                    File::delete($model->$key);
                    $model->update([$key => $full_path]);
                    // $image      = $this->model->create([

                    //     'path'          => $full_path,
                    //     'relation_id'   => $content->id,
                    //     'relation_type' => get_class($content),

                    // ]);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                    if(!file_exists($full_path)){ File::delete($full_path); }
                }
            }
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
        $data = $request->except(['_token', '_method', 'content', 'criteria']);
        $data['status'] = 'active';
        $data['type'  ] = 'block';
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
            $this->exceptions(trans('base.alerts.failed.messages.deleted', ['attribute' => 'View #' . $deleted->name]));
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
        $this->exceptions(trans('base.alerts.failed.messages.restored', ['attribute' => 'View']));
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

            $this->exceptions(trans('base.alerts.failed.messages.deleted_permanently', ['attribute' => 'View']));
        });
    }



    /**
     * @param Model $user
     *
     * @throws GeneralException
     */
    public function contentDestroy($model, $view)
    {
        DB::transaction(function () use ($model, $view) {
            if ($model->delete()) {
                $this->eventUpdated($view);
                return true;
            }

            $this->exceptions(trans('base.alerts.failed.messages.updated', ['attribute' => 'View']));
        });
    }
   
}
