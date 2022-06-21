<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->search) {
            $products = Product::search($request->search)->latest()->paginate(20);
        } else {
            $products = Product::latest()->paginate(20);
        }

        $categories = Category::all();
        return view('app', compact('products', 'categories'));
    }
}
