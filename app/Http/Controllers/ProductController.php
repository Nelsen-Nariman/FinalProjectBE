<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\view;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($request->all(), [
            'category' => 'required|string',
            'name' => 'required|string|min:5|max:80',
            'price' => 'required|integer',
            'stock' => 'required|numeric|integer'
        ]);

        if($validator->fails()){
            return redirect('/products')->with('alert', $validator->messages()->first());
        }

        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = $request->category.'_'.$request->name.'.'.$extension;
        $request->file('image')->storeAs('public/image/', $fileName);

        Product::create([
            'category' => $request->category,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image'=> $fileName
        ]);
        return redirect('/products');
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        return view('show', compact('product'));
    }

    public function member(){
        $products = Product::all();
        return view('member', compact('products'));
    }

    public function cart($id){
        $product = Product::findOrFail($id);
        return view('cart', compact('product'));
    }

    public function edit($id) {
        $product = Product::find($id);
        return view('edit', compact('product'));
    }

    public function update(Request $request, $id) {
        $product = Product::findOrFail($id)->update([
            'stock' => $request->stock
        ]);
        return redirect('/products');
    }

    public function delete($id) {
       Product::destroy($id);
        return back();
    }
}
