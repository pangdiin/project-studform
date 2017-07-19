<?php

namespace App\Repositories\Backend\Gallery;

use App\Models\Gallery\Gallery;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use Image;
use File;
/**
 * Class ProductRepository.
 */
class GalleryRepository extends BaseRepository
{
    /**
     * @var History slug $history_slug
     */
    protected $history_slug = 'Gallery';


    public function upload($request, $model, $path)
    {
        DB::beginTransaction();

        try {

            $files = [];

            $files = $request->file;
            $removes = is_array($request->removed) ? $request->removed : explode(',', $request->removed);
            if(count($removes)){ $this->delete($removes, $model); }

               if (!empty($files)) {

                    foreach ($files as $file) {
                        $filename = uniqid(true) . '.' . $file->getClientOriginalName();

                        $width  = Image::make($file)->width();
                        $height = Image::make($file)->height();

                        if ($width > 1000 || $height > 1000) {
                            Image::make($file)->fit(800, 600, function($c) {
                                $c->aspectRatio();
                            })->save($path . $filename);
                        } else {
                            Image::make($file)->save($path . $filename);
                        }

                        $model->galleries()->create(['path' => $path . $filename]);
                    }
                }
                
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                // dd($e);
            }
        return;
    }

    public function delete($removed, $model)
    {
        DB::beginTransaction();
        if(count($removed)){
            try {
                
                $photos = $model->galleries()->whereIn('id', $removed)->get();
                foreach ($photos as  $photo) {
                    // File::delete($photo->path);
                    $photo->delete();
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                // dd($e);
            }
        }
        return true;
    }
   
}
