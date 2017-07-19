<?php

namespace App\Http\Controllers\Backend\Invite\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Invite\InviteRepository as Repository;
use Yajra\Datatables\Facades\Datatables;

use App\Models\Invite\Invite as Model;


/**
 * Class InviteTableController.
 */
class InviteTableController extends Controller
{
    /**
     * @var $repo
     */
    protected $repo;


    function __construct(Repository $repo)
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
            ->escapeColumns(['name'])
            ->editColumn('status', function($invite){
                return $invite->statusLabel;
            })
            ->editColumn('created_at', function($invite){
                return $invite->created_at->format(config('base.date_format'));
            })
            ->addColumn('actions', function ($invite) {
                return $invite->action_buttons;
            })
            ->withTrashed()
            ->make(true);
    }


}
