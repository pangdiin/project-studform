<?php

namespace App\Http\Controllers\Backend\View\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\View\ViewRepository as Repository;
use App\Models\View as Model;

/**
 * Class ViewTableController.
 */
class ViewTableController extends Controller
{
    /**
     * @var Repository
     */
    protected $repo;

    /**
     * @param Repository $repo
     */
    public function __construct(Repository $repo)
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
            ->editColumn('status', function($model){
                return [
                    'type' => $model->status == "active" ? 'success' : 'danger',
                    'label' => ucfirst($model->status)
                ];
            })
            ->editColumn('image', function($model){
                if($model->image){ return asset($model->image); }
                return asset('img/no-image.png');
            })
            ->editColumn('updated_at', function($model){
                return $model->updated_at->format(config('base.date_format'));
            })
            ->addColumn('actions', function ($model) {
                return $model->actions();
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
