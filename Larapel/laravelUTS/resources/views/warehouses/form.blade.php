@extends('layouts.app')

@section('title', isset($warehouse) ? 'Edit Warehouse' : 'Create Warehouse')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center" style="color: var(--secondary-color);">{{ isset($warehouse) ? 'Edit Warehouse' : 'Create Warehouse' }}</h1>

        <form action="{{ isset($warehouse) ? route('warehouses.update', $warehouse->kodegudang) : route('warehouses.store') }}" method="POST">
            @csrf
            @if(isset($warehouse))
                @method('PUT')  <!-- Untuk update -->
            @endif

            <div class="mb-3">
                <label for="kodegudang" class="form-label">Warehouse Code</label>
                <input type="text" name="kodegudang" class="form-control" id="kodegudang" value="{{ isset($warehouse) ? $warehouse->kodegudang : old('kodegudang') }}" required>
            </div>
            <div class="mb-3">
                <label for="namagudang" class="form-label">Warehouse Name</label>
                <input type="text" name="namagudang" class="form-control" id="namagudang" value="{{ isset($warehouse) ? $warehouse->namagudang : old('namagudang') }}" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Address</label>
                <input type="text" name="alamat" class="form-control" id="alamat" value="{{ isset($warehouse) ? $warehouse->alamat : old('alamat') }}" required>
            </div>
            <div class="mb-3">
                <label for="kontak" class="form-label">Contact</label>
                <input type="text" name="kontak" class="form-control" id="kontak" value="{{ isset($warehouse) ? $warehouse->kontak : old('kontak') }}" required>
            </div>
            <div class="mb-3">
                <label for="kapasitas" class="form-label">Capacity</label>
                <input type="number" name="kapasitas" class="form-control" id="kapasitas" value="{{ isset($warehouse) ? $warehouse->kapasitas : old('kapasitas') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($warehouse) ? 'Update Warehouse' : 'Add Warehouse' }}</button>
        </form>
    </div>
@endsection
