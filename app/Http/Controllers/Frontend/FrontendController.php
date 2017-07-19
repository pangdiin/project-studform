<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Models\Page;
use App\Models\View\View;

/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $page = Page::where('id', 1)->whereSlug('home')->first();
        $sliders = collect();
        if(config('base.slide.active'))
            $sliders = Slide::latest()->take(1)->get();
        return view('frontend.index', compact('sliders', 'page'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }
    public function about()
    {
        return view('frontend.about.index');
    }
    public function products()
    {
        return view('frontend.products.index');
    }
    public function brands()
    {
        return view('frontend.brands.index');
    }
    public function projects()
    {
        return view('frontend.projects.index');
    }
    public function contact_us()
    {
        return view('frontend.contact_us.index');
    }
    
}
