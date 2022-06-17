<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::search(request()->name)->where('user_id', auth()->user()->id)->get();
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
        $sizes = Size::all();
        
        return view('dashboard.products.create', compact('categories', 'sizes'));
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
        // dd($request->file('images'));
        
        $validation = $request->validate([
            'name' => 'required',
            'image' => 'required',
            'category_id' => 'required|integer',
            'size' => 'required',
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
        $product->sizes()->attach($request->size);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $path = time().'_'.$file->getClientOriginalName();
                
                $request['product_id'] = $product->id;
                $request['path'] = $path;

                $file->move(\public_path('/uploads/products'), $path); 
                Image::create([
                    'product_id' => $request['product_id'],
                    'path' => $request['path'],
                ]);
            }
        }
        
        return to_route('products.index')->with('success', 'Product created successfully');

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
        $categories = Category::all();
        $sizes = Size::all();

        return view('dashboard.products.edit', compact('product', 'categories', 'sizes'));
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
            'image' => 'required',
            'category_id' => 'required|integer',
            'size' => 'required',
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

        $product->update($data);
        $product->sizes()->sync($request->size);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $path = time().'_'.$file->getClientOriginalName();
                
                $request['product_id'] = $product->id;
                $request['path'] = $path;

                $file->move(\public_path('/uploads/products'), $path); 
                Image::create([
                    'product_id' => $request['product_id'],
                    'path' => $request['path'],
                ]);
            }
        }
        
        return to_route('products.index')->with('success', 'Product updated successfully');
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
        foreach ($images as $image){
            if (File::exists('uploads/products/' . $image->path)) {
                File::delete('uploads/products/' . $image->path);
            }
        }
        
        $product->delete();
        $product->sizes()->delete();
        
        return to_route('products.index')->with('success', 'Product deleted successfully');
    }
}
