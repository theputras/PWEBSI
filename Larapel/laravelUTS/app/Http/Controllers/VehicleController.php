<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // Menampilkan daftar kendaraan
    public function index()
    {
        $vehicles = Vehicle::all(); // Mengambil semua kendaraan
        return view('vehicles.index', compact('vehicles')); // Menampilkan kendaraan di view index.blade.php
    }

    // Menampilkan form untuk membuat kendaraan baru
    public function create()
    {
        return view('vehicles.form'); // Form untuk membuat kendaraan baru
    }

    // Menyimpan kendaraan baru
    public function store(Request $request)
    {
        // Validasi input dan simpan data kendaraan
        $request->validate([
            'nopol' => 'required|unique:vehicles,nopol|max:20',
            'nama_kendaraan' => 'required|string|max:100',
            'jenis_kendaraan' => 'required|string|max:50',
            'kontakdriver' => 'required|string|max:50',
            'tahun' => 'required|integer',
            'kapasitas' => 'required|numeric',
            'foto' => 'nullable|url', // Validasi foto jika diberikan
        ]);

        // Menyimpan kendaraan baru
        Vehicle::create($request->all()); // Menyimpan data yang sudah tervalidasi
        return redirect()->route('vehicles.index'); // Kembali ke halaman daftar kendaraan
    }

    // Menampilkan form untuk mengedit kendaraan
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.form', compact('vehicle')); // Passing data kendaraan untuk edit
    }

    // Mengupdate data kendaraan
    public function update(Request $request, Vehicle $vehicle)
    {
        // Validasi input dan update kendaraan
        $request->validate([
            'nopol' => 'required|max:20|unique:vehicles,nopol,' . $vehicle->id,
            'nama_kendaraan' => 'required|string|max:100',
            'jenis_kendaraan' => 'required|string|max:50',
            'kontakdriver' => 'required|string|max:50',
            'tahun' => 'required|integer',
            'kapasitas' => 'required|numeric',
            'foto' => 'nullable|url', // Validasi foto jika diberikan
        ]);

        // Mengupdate data kendaraan
        $vehicle->update($request->all()); // Mengupdate data kendaraan yang ada
        return redirect()->route('vehicles.index'); // Kembali ke halaman daftar kendaraan
    }

    // Menghapus kendaraan
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete(); // Menghapus kendaraan
        return redirect()->route('vehicles.index'); // Kembali ke halaman daftar kendaraan
    }
}
