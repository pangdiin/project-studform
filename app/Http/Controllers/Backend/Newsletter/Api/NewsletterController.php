<?php

namespace App\Http\Controllers\Backend\Newsletter\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Newsletter\NewsletterRepository as Repository;

/**
 * Class NewsletterController.
 */
class NewsletterController extends Controller
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
     * @return $subscribe
     */
    public function subscribe(Request $request)
    {
        $subscribe = $this->repo->subscribe($request);
        $message = 'You have successfully subscribed the email ' . $request->email;
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.newsletter.index')->withFlashSuccess($message);
    }

    /**
     * @param Request $request 
     * @return $subscribe
     */
    public function resubscribe(Request $request, $email)
    {
        $subscribe = $this->repo->resubscribe($email);
        $message = 'You have successfully re-subscribed the email ' . $email;
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.newsletter.index')->withFlashSuccess($message);
    }

    /**
     * @param Request $request 
     * @return $subscribe
     */
    public function unsubscribe(Request $request, $email)
    {
        $subscribe = $this->repo->unsubscribe($email);
        $message = 'You have successfully unsubscribed the email ' . $email;
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.newsletter.index')->withFlashSuccess($message);
    }


    /**
     * @param Request $request 
     * @return $subscribe
     */
    public function delete(Request $request, $email)
    {
        $subscribe = $this->repo->destroy($email);
        $message = trans('base.alerts.success.messages.deleted', ['attribute' => $email]);
        return $request->ajax() ? response()->json(['message' => $message]) : redirect()->route('admin.newsletter.index')->withFlashSuccess($message);
    }
}
