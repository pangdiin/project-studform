<?php

namespace App\Http\Controllers\Backend\Block\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Block\BlockRepository as Repository;

use App\Models\Block as Model;


/**
 * Class BlockController.
 */
class BlockController extends Controller
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
     * @param Request $request, Model $block
     * @return $block
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
   
}
