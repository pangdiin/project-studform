<?php

namespace App\Http\Controllers\Backend\Product\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Product\ProductRepository as Repository;
use App\Models\Product\Product as Model;

/**
 * Class ProductTableController
 */
class ProductTableController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $repo;

    /**
     * @param ProductRepository $repo
     */
    public function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return Datatables::of($this->repo->getForDataTable($request))
            ->addColumn('image', function ($product) {
                return $product->image_path;
            })
            ->addColumn('brand', function ($product) {
                return $product->brand ? $product->brand->name : 'N/A';
            })
            ->addColumn('actions', function ($product) {
                return $product->actions();
            })
            ->withTrashed()
            ->make(true);
    }


    /**
     * @param Request $request
     *
     * @return json
     */
    public function show(Request $request)
    {
        return response()->json($request->all());
    }
}
