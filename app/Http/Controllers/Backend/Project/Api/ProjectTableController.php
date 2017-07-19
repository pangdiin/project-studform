<?php

namespace App\Http\Controllers\Backend\Project\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Project\ProjectRepository;
use App\Models\Project\Project as Model;

/**
 * Class ProjectTableController.
 */
class ProjectTableController extends Controller
{
    /**
     * @var ProjectRepository
     */
    protected $repo;

    /**
     * @param ProjectRepository $repo
     */
    public function __construct(ProjectRepository $repo)
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
            ->editColumn('status', function($project){
                return [
                    'type' => $project->status == "active" ? 'success' : 'danger',
                    'label' => ucfirst($project->status)
                ];
            })
            ->editColumn('image', function($project){
                return asset($project->image);
            })
            ->editColumn('updated_at', function($project){
                return $project->updated_at->format(config('base.date_format'));
            })
            ->addColumn('actions', function ($project) {
                return $project->actions();
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
