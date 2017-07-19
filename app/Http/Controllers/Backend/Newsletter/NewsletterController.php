<?php

namespace App\Http\Controllers\Backend\Newsletter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class NewsLetterController.
 */
class NewsLetterController extends Controller
{
    /**
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.newsletter.index');
    }
}
