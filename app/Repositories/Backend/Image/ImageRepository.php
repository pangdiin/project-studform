<?php

namespace App\Repositories\Backend\Image;

use App\Models\Image as Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use Image;
use File;
/**
 * Class ImageRepository.
 */
class ImageRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Model::class;

    /**
     * @var Image Model
     */
    protected $model;

    /**
     * @var History slug $history_slug
     */
    protected $history_slug = 'Image';

    /**
     * @param RoleRepository $role
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param Request $request
     * @param Model  $model
     *
     * @return static
     */
    public function store($content, $attr, $files=[])
    {
    	$strict 			= array_get($attr, 'strict' , config('image.strict'	));
    	$width 				= array_get($attr, 'width'	, config('image.width'	));
		$height 			= array_get($attr, 'height'	, config('image.height'	));
		$path 				= array_get($attr, 'path'	, config('image.path'	));
		$def_name 			= array_get($attr, 'name'	, config('image.name'	));


		$uploaded 	= collect();

		if(count($files) && $content){
			foreach ($files as $f => $file) {
				$name = $def_name . $content->id . '_' . $f . '_' . time() . '.' . $file->getClientOriginalExtension();
				if(!file_exists('images')){ $folder = File::makeDirectory('images', 755); }
				if(!file_exists($path)	 ){ $folder = File::makeDirectory($path, 755); }
				$full_path = $path . $name;
				DB::beginTransaction();
				try {
					$upload = Image::make($file->getRealPath())->resize($width, $height)->save($full_path);
					$image 		= $this->model->create([

						'path' 			=> $full_path,
						'relation_id'	=> $content->id,
						'relation_type'	=> get_class($content),

					]);
					$uploaded 	= $uploaded->push($image);
					DB::commit();
				} catch (\Exception $e) {
					DB::rollback();
					if(!file_exists($full_path)){ File::delete($full_path); }
				}
			}
		}
		return $uploaded;
    }

    public function update($image, $attr, $file=[])
    {
    	$strict 			= array_get($attr, 'strict' , config('image.strict'	));
    	$width 				= array_get($attr, 'width'	, config('image.width'	));
		$height 			= array_get($attr, 'height'	, config('image.height'	));
		$path 				= array_get($attr, 'path'	, config('image.path'	));
		$def_name 			= array_get($attr, 'name'	, config('image.name'	));

    	$name = $def_name . $content->id . '_' . $f . '_' . time() . '.' . $file->getClientOriginalExtension();
		if(!file_exists('images')){ $folder = File::makeDirectory('images', 755); }
		if(!file_exists($path)	 ){ $folder = File::makeDirectory($path, 755); }
		$full_path = $path . $name;
		DB::beginTransaction();
		try {
			$upload = Image::make($file->getRealPath())->resize($width, $height)->save($full_path);
			File::delete($image->path);
			$image->update([ 'path' => $full_path ]);
			DB::commit();
			return $image;
		} catch (\Exception $e) {
			DB::rollback();
			if(!file_exists($full_path)){ File::delete($full_path); }
			$this->exceptions('Image was not uploaded.');
		}
    }


    /**
     * @param int $id
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function destroy($id)
    {
        DB::beginTransaction();
		try {
		
			$image = Model::findOrFail($id);
			File::delete($image->path);
			$image->delete();
			DB::commit();
			return response()->json(trans('base.alerts.success.messages.deleted', ['attribute' => 'Image']));
		} catch (\Exception $e) {
			DB::rollback();
			return response()->json(trans('base.alerts.failed.messages.deleted', ['attribute' => 'Image']), 500);
		}

    }
   
}
