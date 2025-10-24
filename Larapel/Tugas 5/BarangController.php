<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaModel;

class BarangController extends Controller
{
    public function readbarang()
    {
        $xx = new AnggotaModel();
        $barang = $xx->Readbarang();
        return view('databarang', ['barang' => $barang]);
    }

    public function tambahbarang()
    {
        return view('tambahbarang');
    }

    public function simpanbarang(Request $x)
    {
        $x->validate([
            'kode' => 'required|min:3|max:20',
            'nama' => 'required|min:3|max:200',
            'satuan' => 'required|min:3|max:20',
            'beli' => 'required|numeric',
            'jual' => 'required|numeric',
            'diskon' => 'required|numeric'
        ]);

        $xx = new AnggotaModel();
        $xx->Simpanbarang($x);
        return redirect('/barang')->with('success', 'Barang berhasil disimpan!');
    }

    public function hapusbarang($kodebr)
    {
        $xx = new AnggotaModel();
        $xx->Hapusbarang($kodebr);
        return redirect('/barang')->with('success', 'Barang berhasil dihapus!');
    }

    public function editbarang($kodebr)
    {
        $xx = new AnggotaModel();
        $barang = $xx->Editbarang($kodebr);
        return view('editbarang', ['barang' => $barang]);
    }

    public function edittbarang(Request $x)
    {
        $xx = new AnggotaModel();
        $xx->Edittbarang($x);
        return redirect('/barang')->with('success', 'Barang berhasil diupdate!');
    }

    public function caribarang($cari)
    {
        $xx = new AnggotaModel();
        $barang = $xx->Caribarang($cari);
        return view('databarang', ['barang' => $barang]);
    }
}
