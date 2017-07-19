<?php

namespace App\Http\Controllers\Backend\View\Api;

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
     * @param Request $request, Model $model
     * @return $model
     */
    public function restore(Request $request, $slug)
    {
        $model = Model::withTrashed()->whereSlug($slug)->first();
        $this->repo->restore($model);
        $message = trans('base.alerts.success.messages.restored', ['attribute' => $model->name ]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);
    }

    /**
     * 
     * @param Request $request, Model $model
     * @return $response
     */
    public function force(Request $request, $slug)
    {
        $model = Model::withTrashed()->whereSlug($slug)->firstOrFail();
        $this->repo->force($model);
        $message = trans('base.alerts.success.messages.force', ['attribute' => $model->name]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);
    }



    /**
     * 
     * @param Request $request, Model $model
     * @return $response
     */
    public function contentDestroy(Request $request, $slug, $content_id, $criteria_id)
    {
        $view = Model::whereSlug($slug)->firstOrFail();
        $content = $view->contents()->findOrFail($content_id);
        $model = $content->criterias()->findOrFail($criteria_id);
        $this->repo->contentDestroy($model, $view);
        $message = trans('base.alerts.success.messages.updated', ['attribute' => $view->name]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);
    }
   
}
