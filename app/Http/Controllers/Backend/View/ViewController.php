<?php

namespace App\Http\Controllers\Backend\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\View\ViewRepository as Repository;

use App\Models\View\View as Model;


/**
 * Class ViewController.
 */
class ViewController extends Controller
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
        return view('backend.view.index');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function deleted()
    {
        return view('backend.view.deleted');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // if(!config('base.view.can_add')){ abort(404); }
        return view('backend.view.create');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function edit(Model $view)
    {
        $contents = $view->contents()->with(['criterias'])->get();
        return view('backend.view.edit', compact('view', 'contents'));
    }

    /**
     * @param Request $request 
     * @return $model
     */
    public function store(Request $request)
    {
        // if(!config('base.view.can_add')){ abort(404); }
        $this->validate($request, [
            'name'          => 'required|max:255|unique:views',
            'description'   => 'max:255',

            // 'type'          => 'required|in:block,page,both',
            'seo'           => 'max:255',
            'meta'          => 'max:255',

            'image'         => 'mimes:jpeg,jpg,png',
            'row_id'        => 'max:255',
            'row_class'     => 'max:255',
            'item_class'    => 'max:255',
            'paginate'      => 'numeric|max:255',
        ]);

        $model = $this->repo->store($request);
        $message = trans('base.alerts.success.messages.created', ['attribute' => $model->name]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.view.index')->withFlashSuccess($message);
    }

    /**
     * @param Request $request, string $slug
     * @return $model
     */
    public function update(Request $request, $slug)
    {
        // dd($request->all());
        $model = Model::whereSlug($slug)->firstOrFail();
        $this->validate($request, [
            'name'          => 'required|max:255|unique:views,id,' . $model->id,
            'description'   => 'max:255',

            // 'type'          => 'required|in:block,page,both',
            'seo'           => 'max:255',
            'meta'          => 'max:255',

            'image'         => 'mimes:jpeg,jpg,png',
            'row_id'        => 'max:255',
            'row_class'     => 'max:255',
            'item_class'    => 'max:255',
            'paginate'      => 'numeric|max:255',
        ]);
        $model = $this->repo->store($request, $model);
        $message = trans('base.alerts.success.messages.updated', ['attribute' => $request->name ]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.view.edit', $model)->withFlashSuccess($message);
    }

    /**
     * 
     * @param Request $request, Model $model
     * @return $response
     */
    public function destroy(Request $request, $slug)
    {
        $model = Model::whereSlug($slug)->firstOrFail();
        $this->repo->destroy($model);
        $message = trans('base.alerts.success.messages.deleted', ['attribute' => $model->name]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);
    }
   
}
