<?php

namespace App\Http\Controllers\Backend\Block\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Block\BlockRepository;
use App\Models\Block as Model;

/**
 * Class BlockTableController.
 */
class BlockTableController extends Controller
{
    /**
     * @var BlockRepository
     */
    protected $repo;

    /**
     * @param BlockRepository $repo
     */
    public function __construct(BlockRepository $repo)
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
            ->escapeColumns(['status'])
            ->editColumn('status', function($block){
                return [
                    'type' => $block->status == "active" ? 'success' : 'danger',
                    'label' => ucfirst($block->status)
                ];
            })
            ->editColumn('image', function($block){
                return asset($block->image);
            })
            ->editColumn('updated_at', function($block){
                return $block->updated_at->format(config('base.date_format'));
            })
            ->addColumn('actions', function ($block) {
                return $block->actions();
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
