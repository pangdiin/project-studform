<?php

namespace App\Http\Controllers\Frontend\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page as Model;
use App\Models\View\View as ViewModel;
use App\Models\Product\Brochure;



/**
 * Class PageController.
 */
class PageController extends Controller
{
    public function show($page, $slug=null)
    {
        if($page->priority == config('page.contact')){
            return view('frontend.page.contact', compact('page'));
        }

        if($page->priority == config('page.brochure')){

            $brochures = Brochure::all();

            return view('frontend.page.brochure', compact('brochures','page'));
        }

        return view('frontend.page.index', compact('page'));
    }

    public function node($node)
    {
    	if(is_array($node)){
	        return view('frontend.page.type', compact('node'));
    	}
        return view('frontend.page.node', compact('node'));
    }

}
