<?php

namespace App\Http\Controllers\Backend\Menu\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Menu\MenuRepository as Repository; 
use App\Models\Menu\Menu as Model;

/**
 * Class MenuTableController.
 */
class MenuTableController extends Controller
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
            ->escapeColumns(['actions'])
            ->editColumn('name', function($menu){
                return $menu->name;
            })
            ->editColumn('updated_at', function($menu){
                return $menu->updated_at->format(config('base.date_format'));
            })
            ->addColumn('actions', function ($menu) {
                return $menu->action_buttons;
            })
            ->withTrashed()
            ->make(true);
    }
}
