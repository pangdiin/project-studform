<?php

namespace App\Http\Controllers\Backend\Invite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Invite\InviteRepository as Repository;
use Illuminate\Validation\Rule;

use App\Models\Invite\Invite as Model;


/**
 * Class InviteController.
 */
class InviteController extends Controller
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
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.invite.index');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function deleted()
    {
        return view('backend.invite.deleted');
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.invite.create');
    }

    /**
     * @param Request $request 
     * @return $invite
     */
    public function store(Request $request)
    {
       $this->validate($request, [
            'first_name'    => 'required|max:255',
            'last_name'     => 'required|max:255',
            'email'         => ['required', 'email', 'max:255', Rule::unique('users'), Rule::unique('invites')],
            'address'       => 'required|max:255',
            'contact_number'=> 'required|max:20',
        ]);
        $invite = $this->repo->store($request);
        $message = trans('base.alerts.success.messages.created', ['attribute' => $invite->name ]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.invite.index')->withFlashSuccess($message);
    }

    /**
     * @param Model $invite
     * @return \Illuminate\View\View
     */
    public function show(Model $invite)
    {
        return view('backend.invite.show', compact('invite'));
    }

    /**
     * @param Model $invite
     * @return \Illuminate\View\View
     */
    public function edit(Model $invite)
    {
        if(!$invite->isPending()){ abort(404); }
        return view('backend.invite.edit', compact('invite'));
    }

    /**
     * @param Request $request 
     * @param Model $model 
     * @return $invite
     */
    public function update(Request $request, Model $invite)
    {
         $this->validate($request, [
            'first_name'    => 'required|max:255',
            'last_name'     => 'required|max:255',
            'email'         => ['required', 'email', 'max:255', Rule::unique('users'), Rule::unique('invites')->ignore($invite->id)],
            'address'       => 'required|max:255',
            'contact_number'=> 'required|max:20',
        ]);
        $invite = $this->repo->store($request, $invite);
        $message = trans('base.alerts.success.messages.updated', ['attribute' => $invite->name ]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.invite.index')->withFlashSuccess($message);
    }


    /**
     * 
     * @param Request $request, Model $invite
     * @return $response
     */
    public function destroy(Request $request, Model $invite)
    {
        $this->repo->destroy($invite);
        $message = trans('base.alerts.success.messages.deleted', ['attribute' => $invite->name ]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);
    }

}
