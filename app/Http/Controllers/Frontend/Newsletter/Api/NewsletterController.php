<?php

namespace App\Http\Controllers\Frontend\Newsletter\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Newsletter;

/**
 * Class NewsletterController.
 */
class NewsletterController extends Controller
{

    public function store(Request $request)
    {
        $subscriber = Newsletter::subscribe($request->email);
        return redirect()->back()->withFlashSuccess('You have successfully subscribe to ' . app_name());
    }
}
