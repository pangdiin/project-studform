<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Gallery\GalleryRepository as Repository;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use File;
use Image;

/**
 * Class ProductController.
 */
class ProductGalleryController extends Controller
{
    /**
     * @var $repo
     */
    protected $repo;
    private $product_gallery_path;

    /**
     * @var $rules
     */

    function __construct(Repository $repo)
    {
        $this->repo = $repo;
        $this->product_gallery_path = "images/gallery/product/";
    }

    public function show(Product $product)
    {
        return view('backend.gallery.product.index', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        if (!File::exists($this->product_gallery_path)) {
            File::makeDirectory($this->product_gallery_path, $mode = 0777, true, true);
        }

        $this->repo->upload($request, $product, $this->product_gallery_path);

        $message = "Product gallery successfully updated";

        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);

        return redirect()->back()->withFlashSuccess($message);
    }

}
