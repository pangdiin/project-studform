<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Page\PageRepository as Repository;

use App\Models\Page as Model;


/**
 * Class PageController.
 */
class PageController extends Controller
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

        $this->rules = [
            'title'         => 'required|max:255',
            'content'       => 'required',
            'seo'           => 'max:255',
            'description'   => 'max:255'
        ];

    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.page.index');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function deleted()
    {
        return view('backend.page.deleted');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if(!config('base.page.can_add')){ abort(404); }
        return view('backend.page.create');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function edit(Model $page)
    {
        return view('backend.page.edit', compact('page'));
    }

    /**
     * @param Request $request 
     * @return $page
     */
    public function store(Request $request)
    {
        if(!config('base.page.can_add')){ abort(404); }
        $this->validate($request, [
            'name'          => 'required|max:255',
            'content'       => 'required',
            'description'   => 'max:255',

            'seo'           => 'max:255',
            'meta'          => 'max:255',

            'image'         => 'required|mimes:jpeg,jpg,png',
            'thumbnail'      => 'mimes:jpeg,jpg,png',

        ]);

        $page = $this->repo->store($request);
        $message = trans('base.alerts.success.messages.created', ['attribute' => $page->name]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.page.index')->withFlashSuccess($message);
    }

    /**
     * @param Request $request, Model $page
     * @return $page
     */
    public function update(Request $request, Model $page)
    {
        $this->validate($request, [
            'name'          => 'required|max:255',
            'content'       => 'required',
            'description'   => 'max:255',

            'seo'           => 'max:255',
            'meta'          => 'max:255',

            'image'         => 'mimes:jpeg,jpg,png',
            'thumbnail'      => 'mimes:jpeg,jpg,png',
        ]);
        $page = $this->repo->store($request, $page);
        $message = trans('base.alerts.success.messages.updated', ['attribute' => $page->name ]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.page.index')->withFlashSuccess($message);
    }

    /**
     * 
     * @param Request $request, Model $page
     * @return $response
     */
    public function destroy(Request $request, Model $page)
    {
        $this->repo->destroy($page);
        $message = trans('base.alerts.success.messages.deleted', ['attribute' => $page->name]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);
    }
   
}
