<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('user_id', auth()->user()->id)->get();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $array = explode(',', $request->category);
        // $array = trim($array[0]);
        // dd($array);
        
        $validation = $request->validate([
            'name' => 'required',
            'category_id' => 'required|integer',
            'price' => 'required|integer',
            'description' => 'required|min:10',
        ]);
        
        
        $data = [
            'user_id' => auth()->user()->id,
            'name' => $validation['name'],
            'category_id' => $validation['category_id'],
            'price' => $validation['price'],
            'description' => $validation['description'],
        ];
        
        $product = Product::create($data);

        // if ($request->hasFile('images')) {
        //     $files = $request->file('images');
        //     foreach ($files as $file) {
        //         $path = Hash::make($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
        //         $request['product_id'] = $request->id;
        //         $request['img'] = $path;
        //         $file->move(public_path('/images'), $path);
        //         Image::create([
        //             'path' => $path,
        //             'product_id' => $product->id,
        //         ]);
        //     }
        // }
        
        return redirect()->route('products.index')->with('success', 'Product created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if ($product->user_id !== auth()->user()->id) {
            abort(404);
        }
        return view('dashboard.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validation = $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required|min:10',
        ]);

        $data = [
            'name' => $validation['name'],
            'price' => $validation['price'],
            'description' => $validation['description'],
        ];

        $product->update($data);
        
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $images = Image::where('product_id', $product->id)->get();
        foreach ($images as $image) {
            if(File::exists("images/".$image->path)) {
                File::delete("images/".$image->path);
            }
        }
        
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
