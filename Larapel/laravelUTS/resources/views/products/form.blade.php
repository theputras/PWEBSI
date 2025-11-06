@extends('layouts.app')

@section('title', isset($product) ? 'Edit Product' : 'Create Product')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center" style="color: var(--secondary-color);">{{ isset($product) ? 'Edit Product' : 'Create Product' }}</h1>

        <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST">
            @csrf
            @if(isset($product))
                @method('PUT')  <!-- Untuk update -->
            @endif

            <div class="mb-3">
                <label for="kodeproduk" class="form-label">Product Code</label>
                <input type="text" name="kodeproduk" class="form-control" id="kodeproduk" value="{{ isset($product) ? $product->kodeproduk : old('kodeproduk') }}" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Product Name</label>
                <input type="text" name="nama" class="form-control" id="nama" value="{{ isset($product) ? $product->nama : old('nama') }}" required>
            </div>
            <div class="mb-3">
                <label for="satuan" class="form-label">Unit</label>
                <input type="text" name="satuan" class="form-control" id="satuan" value="{{ isset($product) ? $product->satuan : old('satuan') }}" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Price</label>
                <input type="number" name="harga" class="form-control" id="harga" value="{{ isset($product) ? $product->harga : old('harga') }}" required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Image URL</label>
                <input type="url" name="gambar" class="form-control" id="gambar" value="{{ isset($product) ? $product->gambar : old('gambar') }}">
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update Product' : 'Add Product' }}</button>
        </form>
    </div>
@endsection
