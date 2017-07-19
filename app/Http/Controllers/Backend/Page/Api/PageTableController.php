<?php

namespace App\Http\Controllers\Backend\Page\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Page\PageRepository;
use App\Models\Page as Model;

/**
 * Class PageTableController.
 */
class PageTableController extends Controller
{
    /**
     * @var PageRepository
     */
    protected $repo;

    /**
     * @param PageRepository $repo
     */
    public function __construct(PageRepository $repo)
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
            ->editColumn('status', function($page){
                return [
                    'type' => $page->status == "active" ? 'success' : 'danger',
                    'label' => ucfirst($page->status)
                ];
            })
            ->editColumn('image', function($page){
                return asset($page->image);
            })
            ->editColumn('updated_at', function($page){
                return $page->updated_at->format(config('base.date_format'));
            })
            ->addColumn('actions', function ($page) {
                return $page->actions();
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
