<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Access\User\User;
use App\Models\Inquiry\Inquiry;
use App\Models\Product\Product;
use App\Models\Project\Project;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
    	$widget = [
    		'users' => User::count(),
    		'inquiry' => Inquiry::count(),
    		'product' => Product::count(),
    		'project' => Project::count(),

    	];
    	
        return view('backend.dashboard', compact('widget'));

    }
}

