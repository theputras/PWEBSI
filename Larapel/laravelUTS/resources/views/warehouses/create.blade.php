@extends('layouts.app')

@section('title', 'Add New Warehouse')

@section('content')
    <div class="container">
        <h1 class="my-4" style="color: var(--secondary-color);">Add New Warehouse</h1>
        
        <form action="{{ route('warehouses.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Warehouse Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" class="form-control" id="location" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Warehouse</button>
        </form>
    </div>
@endsection
