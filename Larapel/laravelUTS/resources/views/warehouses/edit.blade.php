@extends('layouts.app')

@section('title', 'Edit Warehouse')

@section('content')
    <div class="container">
        <h1 class="my-4" style="color: var(--secondary-color);">Edit Warehouse</h1>
        
        <form action="{{ route('warehouses.update', $warehouse->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Warehouse Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $warehouse->name }}" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" class="form-control" id="location" value="{{ $warehouse->location }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Warehouse</button>
        </form>
    </div>
@endsection
