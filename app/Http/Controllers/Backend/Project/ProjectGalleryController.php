<?php

namespace App\Http\Controllers\Backend\Project;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Gallery\GalleryRepository as Repository;
use Illuminate\Http\Request;
use App\Models\Project\Project;
use File;
use Image;

/**
 * Class projectController.
 */
class ProjectGalleryController extends Controller
{
    /**
     * @var $repo
     */
    protected $repo;

    private $project_path;

    /**
     * @var $rules
     */

    function __construct(Repository $repo)
    {
        $this->repo = $repo;
        $this->project_path = "images/gallery/project/";
    }

    public function show(Project $project)
    {
        return view('backend.gallery.project.index', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        if (!File::exists($this->project_path)) {
            File::makeDirectory($this->project_path, $mode = 0777, true, true);
        }

        $this->repo->upload($request, $project, $this->project_path);

        $message = "Project gallery successfully updated";

        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);

        return redirect()->back()->withFlashSuccess($message);
    }

}
