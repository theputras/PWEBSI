<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $products = Product::all(); // Mengambil semua produk
        return view('products.index', compact('products')); // Menampilkan produk di view index.blade.php
    }

    // Menampilkan form untuk membuat produk baru
    public function create()
    {
        return view('products.form'); // Form untuk membuat produk baru
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        // Validasi input dan simpan data produk
        $request->validate([
            'kodeproduk' => 'required|unique:produk,kodeproduk|max:20',
            'nama' => 'required|string|max:50',
            'satuan' => 'required|string|max:15',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|url', // Validasi gambar jika diberikan
        ]);

        // Menyimpan produk baru
        Product::create($request->all()); // Menyimpan data yang sudah tervalidasi
        return redirect()->route('products.index'); // Kembali ke halaman daftar produk
    }

    // Menampilkan form untuk mengedit produk
    public function edit(Product $product)
    {
        return view('products.form', compact('product')); // Passing data produk untuk edit
    }

    // Mengupdate data produk
    public function update(Request $request, Product $product)
    {
        // Validasi input dan update produk
        $request->validate([
            'kodeproduk' => 'required|max:20|unique:produk,kodeproduk,' . $product->id,
            'nama' => 'required|string|max:50',
            'satuan' => 'required|string|max:15',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|url', // Validasi gambar jika diberikan
        ]);

        // Mengupdate data produk
        $product->update($request->all()); // Mengupdate data produk yang ada
        return redirect()->route('products.index'); // Kembali ke halaman daftar produk
    }

    // Menghapus produk
    public function destroy(Product $product)
    {
        $product->delete(); // Menghapus produk
        return redirect()->route('products.index'); // Kembali ke halaman daftar produk
    }
}
