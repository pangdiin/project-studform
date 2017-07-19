<?php

namespace App\Http\Controllers\Backend\Inquiry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry\Inquiry as Model;
use App\Repositories\Backend\Inquiry\InquiryRepository as Repository;

/**
 * Class InquiryController.
 */
class InquiryController extends Controller
{
    /**
     * @var InquiryRepository
     */
    protected $repo;

    /**
     * @param InquiryRepository $repo
     */
    public function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.inquiry.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function show(Model $inquiry)
    {
        return view('backend.inquiry.show', compact('inquiry'));
    }

    /**
     * 
     * @param Request $request, Model $model
     * @return $response
     */
    public function destroy(Request $request, $slug)
    {
        $model = Model::where('id', $slug)->firstOrFail();
        $this->repo->destroy($model);
        $message = trans('base.alerts.success.messages.deleted', ['attribute' => $model->name]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->back()->withFlashSuccess($message);
    }
}
