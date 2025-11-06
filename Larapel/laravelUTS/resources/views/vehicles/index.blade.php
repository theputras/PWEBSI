@extends('layouts.app')

@section('title', 'Vehicle List')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center" style="color: var(--secondary-color);">Vehicle List</h1>

        <div class="mb-3">
            <a href="{{ route('vehicles.create') }}" class="btn btn-primary">Add New Vehicle</a>
        </div>

        <div class="card">
            <div class="card-header">
                Daftar Kendaraan
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Vehicle Plate</th>
                            <th>Vehicle Name</th>
                            <th>Vehicle Type</th>
                            <th>Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->nopol }}</td>
                            <td>{{ $vehicle->nama_kendaraan }}</td>
                            <td>{{ $vehicle->jenis_kendaraan }}</td>
                            <td>{{ $vehicle->tahun }}</td>
                            <td>
                                <a href="{{ route('vehicles.edit', $vehicle->nopol) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('vehicles.destroy', $vehicle->nopol) }}" method="POST" style="display:inline-block;">
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
