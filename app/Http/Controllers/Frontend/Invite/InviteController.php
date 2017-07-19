<?php

namespace App\Http\Controllers\Frontend\Invite;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Invite\InviteRepository as Repository;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;


/**
 * Class InviteController.
 */
class InviteController extends Controller
{

	/**
	 * @var Repository $repo
	 */
	protected $repo;


	/**
	 * @param Repository $repo
	 */
	function __construct(Repository $repo)
	{
		$this->repo = $repo;
	}


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('frontend.invite.create');
    }

    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'first_name' 	=> 'required|max:255',
    		'last_name' 	=> 'required|max:255',
    		'email' 		=> ['required', 'email', 'max:255', Rule::unique('users'), Rule::unique('invites')],
    		'address'		=> 'required|max:255',
    		'contact_number'=> 'required|max:20',
    	]);

    	$invite = $this->repo->store($request);
    	return redirect()->back()->withFlashSuccess(trans('alerts.frontend.invite.created'));
    }
}
