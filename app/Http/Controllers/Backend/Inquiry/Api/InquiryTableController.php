<?php

namespace App\Http\Controllers\Backend\Inquiry\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Inquiry\InquiryRepository;

/**
 * Class InquiryTableController.
 */
class InquiryTableController extends Controller
{
    /**
     * @var InquiryRepository
     */
    protected $repo;

    /**
     * @param InquiryRepository $repo
     */
    public function __construct(InquiryRepository $repo)
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
            ->addColumn('actions', function ($inquiry) {
                return $inquiry->actions();
            })
            ->withTrashed()
            ->make(true);
    }


    /**
     * @param Request $request
     *
     * @return json
     */
    public function view(Request $request)
    {
        return $request->all();
    }
}
