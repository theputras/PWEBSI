<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    // Menampilkan daftar gudang
    public function index()
    {
        $warehouses = Warehouse::all(); // Mengambil semua gudang
        return view('warehouses.index', compact('warehouses')); // Menampilkan gudang di view index.blade.php
    }

    // Menampilkan form untuk membuat gudang baru
    public function create()
    {
        return view('warehouses.form'); // Form untuk membuat gudang baru
    }

    // Menyimpan gudang baru
    public function store(Request $request)
    {
        // Validasi input dan simpan data gudang
        $request->validate([
            'kodegudang' => 'required|unique:warehouses,kodegudang|max:20',
            'namagudang' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|string|max:50',
            'kapasitas' => 'required|numeric',
        ]);

        // Menyimpan gudang baru
        Warehouse::create($request->all()); // Menyimpan data yang sudah tervalidasi
        return redirect()->route('warehouses.index'); // Kembali ke halaman daftar gudang
    }

    // Menampilkan form untuk mengedit gudang
    public function edit(Warehouse $warehouse)
    {
        return view('warehouses.form', compact('warehouse')); // Passing data gudang untuk edit
    }

    // Mengupdate data gudang
    public function update(Request $request, Warehouse $warehouse)
    {
        // Validasi input dan update gudang
        $request->validate([
            'kodegudang' => 'required|max:20|unique:warehouses,kodegudang,' . $warehouse->id,
            'namagudang' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|string|max:50',
            'kapasitas' => 'required|numeric',
        ]);

        // Mengupdate data gudang
        $warehouse->update($request->all()); // Mengupdate data gudang yang ada
        return redirect()->route('warehouses.index'); // Kembali ke halaman daftar gudang
    }

    // Menghapus gudang
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete(); // Menghapus gudang
        return redirect()->route('warehouses.index'); // Kembali ke halaman daftar gudang
    }
}
