<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $products = Products::get();
        return view('product.index', ['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'satuan' => 'required',
            'harga' => 'required|numeric'
        ]);

        Products::create($request->all());
        return redirect('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        Products::find($products->id);
        return view('product.edit',['products'=>$products]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        $product = Products::find($products->id);
        $product->update($request->all());
        return redirect('index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        $product = Products::find($products->id);
        $product->delete();
        return redirect('index');
    }
}
