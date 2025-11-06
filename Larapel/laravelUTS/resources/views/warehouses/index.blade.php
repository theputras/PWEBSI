@extends('layouts.app')

@section('title', 'Warehouse List')

@section('content')
    <div class="container">
        <h1 class="my-4" style="color: var(--secondary-color);">Warehouse List</h1>
        <a href="{{ route('warehouses.create') }}" class="btn btn-primary mb-3">Add New Warehouse</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($warehouses as $warehouse)
                <tr>
                    <td>{{ $warehouse->name }}</td>
                    <td>{{ $warehouse->location }}</td>
                    <td>
                        <a href="{{ route('warehouses.edit', $warehouse->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
