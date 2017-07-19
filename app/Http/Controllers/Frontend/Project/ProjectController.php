<?php

namespace App\Http\Controllers\Frontend\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project\Project as Model;
use App\Models\Page;


/**
 * Class ProjectController.
 */
class ProjectController extends Controller
{
	public function index()
    {
		$page = Page::where('priority', config('page.project'))->first();
    	$projects = Model::where('status', 'active')->paginate(10);

        return view('frontend.project.index', compact('projects', 'page'));
    }

    public function show(Model $project)
    {
        return view('frontend.project.show', compact('project'));
    }
}
