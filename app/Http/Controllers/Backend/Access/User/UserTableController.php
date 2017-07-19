<?php

namespace App\Http\Controllers\Backend\Access\User;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Access\User\UserRepository;
use App\Http\Requests\Backend\Access\User\ManageUserRequest;

/**
 * Class UserTableController.
 */
class UserTableController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageUserRequest $request)
    {
        return Datatables::of($this->users->getForDataTable($request->get('status'), $request->get('trashed')))
            ->editColumn('fullname', function ($user) {
                return strip_tags($user->fullname);
            })
            ->addColumn('image', function($user){
                return '<img src="'. $user->picture .'" class="user-profile-image img-circle img-responsive img-thumbnail" />';
            })
            ->editColumn('confirmed', function ($user) {
                return $user->confirmed_label;
            })
            ->editColumn('updated_at', function ($user) {
                return $user->updated_at->format(config('base.date_format'));
            })
            ->addColumn('roles', function ($user) {
                return $user->roles->count() ?
                    implode('<br/>', $user->roles->pluck('name')->toArray()) :
                    trans('labels.general.none');
            })
            ->addColumn('actions', function ($user) {
                return $user->action_buttons;
            })
            ->escapeColumns(['email'])
            ->withTrashed()
            ->make(true);
    }
}


