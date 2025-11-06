@extends('layouts.app')

@section('title', 'Warehouse List')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center" style="color: var(--secondary-color);">Warehouse List</h1>

        <div class="mb-3">
            <a href="{{ route('warehouses.create') }}" class="btn btn-primary">Add New Warehouse</a>
        </div>

        <div class="card">
            <div class="card-header">
                Daftar Gudang
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Warehouse Code</th>
                            <th>Warehouse Name</th>
                            <th>Location</th>
                            <th>Kontak</th>
                            <th>kapasitas</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($warehouses as $warehouse)
                        <tr>
                            <td>{{ $warehouse->kodegudang }}</td>
                            <td>{{ $warehouse->namagudang }}</td>
                            <td>{{ $warehouse->alamat }}</td>
                            <td>{{ $warehouse->kontak }}</td>
                            <td>{{ $warehouse->kapasitas }}</td>
                            <td>
                                <a href="{{ route('warehouses.edit', $warehouse->kodegudang) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('warehouses.destroy', $warehouse->kodegudang) }}" method="POST" style="display:inline-block;">
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
        </div>
    </div>
@endsection
