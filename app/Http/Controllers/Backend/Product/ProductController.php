<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Product\ProductRepository as Repository;
use App\Models\Product\Product;
use App\Models\Tag;
use File;
use DB;
use Image;


/**
 * Class ProductController.
 */
class ProductController extends Controller
{
    /**
     * @var $repo
     */
    protected $repo;
    private $product_path;

    /**
     * @var $rules
     */

    function __construct(Repository $repo)
    {
        $this->product_path = public_path("img/default/product/");
        $this->repo = $repo;
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.product.index');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tags = Tag::where('type', config('tag.type.brand.key'))->select(['id', 'name', 'slug', 'type', 'image'])->get();
        return view('backend.product.create', compact('tags'));
    }

    /**
     * @param Request $request 
     * @return $slide
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
            'name'          => 'required|max:255',
            'brand_id'      => 'required|exists:tags,id',
            'description'   => 'required|max:255',
            'content'       => 'required',
            'specification' => 'required',

            'image'         => 'required|mimes:jpg,png,jpeg',
            'thumbnail'     => 'required|mimes:jpg,png,jpeg',
        ]);

        DB::beginTransaction();
            try {
                $data = $this->upload($request);
                $data['brand_id'] = $request->brand_id;
                //Setting path name
                $data['image'] = 'img/default/product/' . $data['image'];
                $data['thumbnail'] = 'img/default/product/' . $data['thumbnail'];
                //Saving images in the right path
                $product = Product::create($data);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                // dd($e);
            }

        $message = "Product successfully created";
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);
    }


    /**
     *
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        dd('show product');
        
        return view('backend.product.show', compact('product'));
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $tags = Tag::where('type', config('tag.type.brand.key'))->select(['id', 'name', 'slug', 'type', 'image'])->get();
        return view('backend.product.edit', compact('product', 'tags'));
    }
    
    /**
     * @param Request $request, Slide $slide
     * @return $slide
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name'          => 'required|max:255',
            'brand_id'      => 'required|exists:tags,id',
            'description'   => 'required|max:255',
            'content'       => 'required',
            'specification' => 'required',

            'image'         => 'sometimes|required|mimes:jpg,png,jpeg',
            'thumbnail'     => 'sometimes|required|mimes:jpg,png,jpeg',
        ]);


        DB::beginTransaction();
            try {
                
            $data = $this->upload($request);
            
            $data['brand_id'] = $request->brand_id;

            if ($request->hasFile('image')) {
                File::delete(asset($product->image));
                $data['image'] = 'img/default/product/' . $data['image'];
            }

            if ($request->hasFile('thumbnail')) {
                File::delete(asset($product->thumbnail));
                $data['thumbnail'] = 'img/default/product/' . $data['thumbnail'];
            }

            $product->update($data);

            DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                // dd($e);
            }
     
        $message = "Product successfully updated";

        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.product.index')->withFlashSuccess($message);
    }

    /**
     * 
     * @param Request $request, Slide $slide
     * @return $response
     */
    public function destroy(Request $request, Product $product)
    {
        File::delete($this->product_path . $product->image);
        File::delete($this->product_path . $product->thumbnail);

        $product->delete();

        $message = 'Product successfully deleted';
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);
    }

    public function upload(Request $request)
    {
        $data = $request->all();

        $files = [];

        if ($request->file('image')) $files['image'] = $request->file('image');
        if ($request->file('thumbnail')) $files['thumbnail'] = $request->file('thumbnail');

        if (!File::exists($this->product_path)) {
            File::makeDirectory($this->product_path, $mode = 0777, true, true);
        }

        foreach ($files as $file) {

            if (!empty($files['image'])) {
                $image = $files['image'];
                $imagename = time() . '.' . $image->getClientOriginalName();
                Image::make($image)->fit(800, 600, function($c) {
                    $c->aspectRatio();
                })->save( $this->product_path . $imagename);
                $data['image'] = $imagename;
            }

            if (!empty($files['thumbnail'])) {
                $thumbnail = $files['thumbnail'];
                $thumbnail_name = time() . '.' . $thumbnail->getClientOriginalName();
                Image::make($thumbnail)->fit(500, 300, function($c) {
                    $c->aspectRatio();
                })->save( $this->product_path . $thumbnail_name);
                $data['thumbnail'] =  $thumbnail_name;
            }
        }

        return $data;
    }


}
