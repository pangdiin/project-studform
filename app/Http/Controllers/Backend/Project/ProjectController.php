<?php

namespace App\Http\Controllers\Backend\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Project\ProjectRepository as Repository;

use App\Models\Project\Project as Model;


/**
 * Class ProjectController.
 */
class ProjectController extends Controller
{
    /**
     * @var $repo
     */
    protected $repo;

    /**
     * @var $rules
     */
    protected $rules;

    function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.project.index');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function deleted()
    {
        return view('backend.project.deleted');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.project.create');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function edit(Model $project)
    {
        return view('backend.project.edit', compact('project'));
    }

    /**
     * @param Request $request 
     * @return $project
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|max:255',
            'description'   => 'max:255',

            'image'         => 'required|mimes:jpeg,jpg,png',

        ]);

        $project = $this->repo->store($request);
        $message = trans('base.alerts.success.messages.created', ['attribute' => $project->name]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.project.index')->withFlashSuccess($message);
    }

    /**
     * @param Request $request, Model $project
     * @return $project
     */
    public function update(Request $request, Model $project)
    {
        $this->validate($request, [
            'name'          => 'required|max:255',
            'description'   => 'max:255',

            'image'         => 'mimes:jpeg,jpg,png',
        ]);
        $project = $this->repo->store($request, $project);
        $message = trans('base.alerts.success.messages.updated', ['attribute' => $project->name ]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.project.index')->withFlashSuccess($message);
    }

    /**
     * 
     * @param Request $request, Model $project
     * @return $response
     */
    public function destroy(Request $request, Model $project)
    {
        $this->repo->destroy($project);
        $message = trans('base.alerts.success.messages.deleted', ['attribute' => $project->name]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.project.index')->withFlashSuccess($message);
    }
   
}
