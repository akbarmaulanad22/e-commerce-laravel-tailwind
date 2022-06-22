<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $products = Product::search($request->search)->paginate(20);
        } else {
            $products = Product::with('category')->paginate(20);
        }

        $categories = Category::all();
        return view('app', compact('products', 'categories'));
    }

    public function showByCategory($category)
    {
        $message = '';
        $products = collect();
        try {
            if (request()->search) {
                $products = Product::withWhereHas('category', fn ($query) => $query->where('slug', 'like', '%'.$category.'%'))
                                ->where('name', 'like', '%'.request()->search.'%')
                                ->get();
            } else {
                $products = Product::withWhereHas('category', fn ($query) => $query->where('slug', 'like', '%'.$category.'%'))
                ->get();
            }
        } catch (\Throwable $th) {
            $message = "there are no categories for $category";
        }

        $categories = Category::all();
        return view('app', compact('products', 'message', 'categories'));
    }

    // public function detail($slug)
    // {
    //     Product::where('slug', 'like', '%'.$slug.'%')
    //     ->get()->dd();
    // }


}
