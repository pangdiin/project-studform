<?php

namespace App\Http\Controllers\Frontend\Inquiry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Repositories\Frontend\Inquiry\InquiryRepository as Repository;


/**
 * Class InquiryController.
 */
class InquiryController extends Controller
{

	/**
	 * Inquiry Repository
	 */
	protected $repo;


	function __construct(Repository $repo)
	{
		$this->repo = $repo;
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.inquiry.index');
    }

    public function store(Request $request)
    {


        $this->validate($request, [
            'email'     => 'required|email',
            'name'      => 'required|min:2|max:255',
            'state'     => 'required|max:255',
            'code'      => 'required|integer',
            'subject'   => 'required|max:255',
            'contact_no'=> 'required|max:20',
            'message'   => 'required',
            'g-recaptcha-response' => 'required',
        ]);


        $inquiry = $this->repo->store($request);

    	return redirect()->back()->withFlashSuccess(trans('alerts.frontend.inquiry.created'));

    }
}
