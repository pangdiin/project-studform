<?php

namespace App\Http\Controllers\Backend\Invite\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Invite\InviteStatusRepository as Repository;
use Illuminate\Validation\Rule;

use App\Models\Invite\Invite as Model;


/**
 * Class InviteStatusController.
 */
class InviteStatusController extends Controller
{
    /**
     * @var $repo
     */
    protected $repo;


    function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }

    public function status(Request $request, Model $invite)
    {
        $this->validate($request, ['status' => ['required', Rule::in([0, 2])]]);
        $this->repo->status($request, $invite);
        $message = trans('base.alerts.success.messages.updated', ['attribute' => $invite->name]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.membership.index')->withFlashSuccess($message);
    }

}
