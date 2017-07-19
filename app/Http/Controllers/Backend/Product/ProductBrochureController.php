<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\Brochure;
use File;
use Image;
use DB;
use App\Exceptions\GeneralException;

/**
 * Class ProductController.
 */
class ProductBrochureController extends Controller
{
    /**
     * @var $repo
     */
    protected $repo;
    private $product_brochure_path;

    /**
     * @var $rules
     */

    function __construct()
    {
        $this->product_brochure_path = public_path('images/product/brochure/');
        $this->product_brochure_thumbnail_path = public_path('images/product/brochure/thumbnail/');
    }

    public function show(Product $product)
    {
        return view('backend.product.brochure', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        if (!File::exists($this->product_brochure_path)) {
            File::makeDirectory($this->product_brochure_path, $mode = 0777, true, true);
        }
        if (!File::exists($this->product_brochure_thumbnail_path)) {
            File::makeDirectory($this->product_brochure_thumbnail_path, $mode = 0777, true, true);
        }

        DB::beginTransaction();
            try {
                
                $files = [];

                $files = $request->file;

                foreach ($files as $file) {
                    if (!empty($file)) {
                        $name = 'brochure_' . $product->id . '_' . time(); 

                        try {
                            $filename = $name . '.' . $file->getClientOriginalExtension();
                            $file->move($this->product_brochure_path, $filename);

                            $source = $this->product_brochure_path . '/' . $filename;
                            $target = $this->product_brochure_thumbnail_path . '/' . $name . '.jpg';
                            $im     = new \Imagick($source."[0]"); // 0-first page, 1-second page
                            

                            // $im->setImageBackgroundColor(new \ImagickPixel( 'white' ));
                            // $im = $im->flattenImages();

                            $im->setImageFormat("jpg");
                            // $im->setImageCompressionQuality(95);
                            $im->setImageBackgroundColor('white');
                            $im->setImageAlphaChannel(\Imagick::ALPHACHANNEL_REMOVE);
                            $im->mergeImageLayers(\Imagick::LAYERMETHOD_FLATTEN);

                            // $im->setImageColorspace(255); // prevent image colors from inverting
                            $im->thumbnailimage(200, 280); // width and height
                            $im->writeimage($target);
                            $im->clear();
                            $im->destroy();



                            $product->brochures()->create([
                                'path'       =>  $filename,
                                'image'      =>  $name . '.jpg',
                            ]);
                            
                        } catch (\Exception $e) {
                            throw new GeneralException($e->getMessage());
                            
                        }


                    }
                }

                DB::commit();

                $message = "Product brochure successfully updated";

                return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);

            } catch (\Exception $e) {
                DB::rollback();
                dd($e);
                // if(file_exists($this->product_brochure_path . $brochure->path)){
                //     File::delete($this->product_brochure_path . $brochure->path);
                // }
                // if(file_exists($this->product_brochure_thumbnail_path . $brochure->image)){

                //     File::delete($this->product_brochure_thumbnail_path . $brochure->image);
                // }
            }
    }

    public function destroy(Request $request, Brochure $brochure)
    {
        if(file_exists($this->product_brochure_path . $brochure->path)){
            File::delete($this->product_brochure_path . $brochure->path);
        }
        if(file_exists($this->product_brochure_thumbnail_path . $brochure->image)){

            File::delete($this->product_brochure_thumbnail_path . $brochure->image);
        }

        $deleted = $brochure->delete();

        if ($deleted) {
            return redirect()->back()->withFlashSuccess('Successfully deleted');
        }

    }

}
