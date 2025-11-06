@extends('layouts.app')

@section('title', isset($vehicle) ? 'Edit Vehicle' : 'Create Vehicle')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center" style="color: var(--secondary-color);">{{ isset($vehicle) ? 'Edit Vehicle' : 'Create Vehicle' }}</h1>

        <form action="{{ isset($vehicle) ? route('vehicles.update', $vehicle->nopol) : route('vehicles.store') }}" method="POST">
            @csrf
            @if(isset($vehicle))
                @method('PUT')  <!-- Untuk update -->
            @endif

            <div class="mb-3">
                <label for="nopol" class="form-label">Vehicle Plate (Nopol)</label>
                <input type="text" name="nopol" class="form-control" id="nopol" value="{{ isset($vehicle) ? $vehicle->nopol : old('nopol') }}" required>
            </div>
            <div class="mb-3">
                <label for="nama_kendaraan" class="form-label">Vehicle Name</label>
                <input type="text" name="nama_kendaraan" class="form-control" id="nama_kendaraan" value="{{ isset($vehicle) ? $vehicle->nama_kendaraan : old('nama_kendaraan') }}" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kendaraan" class="form-label">Vehicle Type</label>
                <input type="text" name="jenis_kendaraan" class="form-control" id="jenis_kendaraan" value="{{ isset($vehicle) ? $vehicle->jenis_kendaraan : old('jenis_kendaraan') }}" required>
            </div>
            <div class="mb-3">
                <label for="kontakdriver" class="form-label">Driver Contact</label>
                <input type="text" name="kontakdriver" class="form-control" id="kontakdriver" value="{{ isset($vehicle) ? $vehicle->kontakdriver : old('kontakdriver') }}" required>
            </div>
            <div class="mb-3">
                <label for="tahun" class="form-label">Year</label>
                <input type="number" name="tahun" class="form-control" id="tahun" value="{{ isset($vehicle) ? $vehicle->tahun : old('tahun') }}" required>
            </div>
            <div class="mb-3">
                <label for="kapasitas" class="form-label">Capacity</label>
                <input type="number" name="kapasitas" class="form-control" id="kapasitas" value="{{ isset($vehicle) ? $vehicle->kapasitas : old('kapasitas') }}" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Photo URL</label>
                <input type="url" name="foto" class="form-control" id="foto" value="{{ isset($vehicle) ? $vehicle->foto : old('foto') }}">
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($vehicle) ? 'Update Vehicle' : 'Add Vehicle' }}</button>
        </form>
    </div>
@endsection
