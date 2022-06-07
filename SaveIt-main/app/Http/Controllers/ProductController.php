<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('products', compact('products'));
    }

    public function create() {
        return view('create');
    }

    public function store(Request $request) {
        Product::create([
            'category' => $request->category,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        return redirect('/products');
    }

    public function show($id) {
        $product = Product::find($id);
        return view('show', compact('product'));
    }

    public function edit($id) {
        $product = Product::find($id);
        return view('edit', compact('product'));
    }

    public function update(Request $request, $id) {
        $product = Product::find($id);
        $product->update([
            'category' => $request->category,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        return redirect('/products');
    }

    public function delete($id) {
        $product = Product::find($id);
        $product->delete();
        return back();
    }
}
