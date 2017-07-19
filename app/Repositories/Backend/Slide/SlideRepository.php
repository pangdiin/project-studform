<?php

namespace App\Repositories\Backend\Slide;

use App\Models\Slide as Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use Image;
use File;
/**
 * Class SlideRepository.
 */
class SlideRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Model::class;

    /**
     * @var Slide Model
     */
    protected $model;

    /**
     * @var History slug $history_slug
     */
    protected $history_slug = 'Slide';

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
        return $this->query()
            ->select([
                'id', 'title', 'path', 'description', 'created_at', 'updated_at'
            ]);
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
            $process = $model ? 'update' : 'create';
            if($model){
                $model->update($data);
                $slide = $model;
                $this->eventUpdated($slide);
            }else{
                $data['path'] = asset('img/no-default.png');
                $slide = $this->model->create($data);
                $this->eventCreated($slide);
            }
            if($request->hasFile('image')){
                $this->storeImage($process, $data, $slide);
            }
            DB::commit();
            return $slide;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            $this->exceptions(trans('base.alerts.failed.messages.' . ($model ? 'updated' : 'created'), ['attribute' => 'Inquiry']));
        }
    }

    public function storeImage($process, $data, $slide)
    {
        /** Initialise Data
         * $file - Image 
         * $name - Generated Name
         * $max_width - 
        */
        $file       = $data['image'];
        $name       = 'slide_' . $slide->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $max_width  = config('base.slide.max_width');
        $max_height = config('base.slide.max_height');

        if(!file_exists('images'        )){ $folder = File::makeDirectory('images', 755); }
        if(!file_exists('images/slides' )){ $folder = File::makeDirectory('images/slides', 755); }
        $full_path = 'images/slides/' . $name;
        
        $upload = Image::make($file->getRealPath())->resize($max_width, $max_height)->save($full_path);
        if($process == 'update' && $slide->path != asset('img/no-image.png')){ File::delete($slide->path); }
        $slide->update([ 'path' => $full_path ]);

    }


    /**
     * Create stub in storing Inquiries
     * @param Request $request
     * @param Model $model
     * @return array $data
     */
    public function generateStub($request, $model=null)
    {
        return $request->only('title', 'description', 'image');
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
            File::delete($model->path);
            if($model->delete()){
                $this->eventDeleted($deleted);
                return true;
            }
            $this->exceptions(trans('base.alerts.failed.messages.deleted', ['attribute' => 'Slide #' . $deleted->id]));
        });

    }
   
}
