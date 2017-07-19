<?php

namespace App\Http\Controllers\Backend\Slide\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Slide\SlideRepository;
use App\Models\Slide\Slide as Model;

/**
 * Class SlideTableController.
 */
class SlideTableController extends Controller
{
    /**
     * @var SlideRepository
     */
    protected $repo;

    /**
     * @param SlideRepository $repo
     */
    public function __construct(SlideRepository $repo)
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
            ->escapeColumns(['title'])
            ->editColumn('title', function($slide){
                return $slide->name;
            })
            ->addColumn('image', function($slide){
                return '<a href="'. $slide->image .'" class="colorbox" data-toggle="colorbox" data-title="'. $slide->name .'"><img src="'. $slide->image .'" class="img-responsive img-thumbnail"/></a>';
            })
            ->editColumn('updated_at', function($slide){
                return $slide->updated_at->format(config('base.date_format'));
            })
            ->addColumn('actions', function ($slide) {
                return $slide->action_buttons;
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
