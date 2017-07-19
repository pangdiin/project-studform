<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product as Model;
use App\Models\Page;


/**
 * Class ProductController.
 */
class ProductController extends Controller
{
	public function index()
	{
		$page = Page::where('priority', config('page.product'))->first();
		$products = Model::with(['brand'])->paginate(10);
		return view('frontend.product.index', compact('products', 'page'));
	}


    public function show(Model $product)
    {
        return view('frontend.product.show', compact('product'));
    }
}
