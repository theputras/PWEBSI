@extends('layouts.app')

@section('title', 'Vehicle List')

@section('content')
    <div class="container">
        <h1 class="my-4" style="color: var(--secondary-color);">Vehicle List</h1>
        <a href="{{ route('vehicles.create') }}" class="btn btn-primary mb-3">Add New Vehicle</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Capacity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->name }}</td>
                    <td>{{ $vehicle->type }}</td>
                    <td>{{ $vehicle->capacity }} kg</td>
                    <td>
                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" style="display:inline-block;">
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
