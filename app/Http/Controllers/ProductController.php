<?php

namespace App\Http\Controllers;

use App\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $products = Product::all();

        return view('product/index', [
            'products' => $products
        ]);
    }

    public function view($id)
    {
        $product = Product::find($id);

        return view('product/view', [
            'product' => $product
        ]);
    }

    public function add()
    {
        return view('product/add');
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            "name" => "required|min:3",
            "make" => "required",
            "model" => "required"
        ]);

        if( $validator->fails() ) {
            return redirect('products/add')->withErrors( $validator );
        }

        $product = new Product();
        $product->name = request()->name;
        $product->make = request()->make;
        $product->model = request()->model;
        $product->save();

        return redirect('products');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('product/edit', [
            'product' => $product
        ]);
    }

    public function update($id)
    {
        $validator = validator(request()->all(), [
            "name" => "required|min:3",
            "make" => "required",
            "model" => "required"
        ]);

        if( $validator->fails() ) {
            return back()->withErrors( $validator );
        }

        $product = Product::find($id);
        $product->name = request()->name;
        $product->make = request()->make;
        $product->model = request()->model;
        $product->save();

        return redirect('products')->with('info', $product->name . ' updated.');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('products')->with('info', 'A product deleted.');
    }
}
