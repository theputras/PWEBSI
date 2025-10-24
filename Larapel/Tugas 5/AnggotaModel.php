<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AnggotaModel extends Model
{
    public function Readbarang()
    {
        return DB::table('barang')->get();
    }

    public function Simpanbarang($x)
    {
        DB::table('barang')->insert([
            'kodebr' => $x->kode,
            'nama' => $x->nama,
            'satuan' => $x->satuan,
            'hargabeli' => $x->beli,
            'hargajual' => $x->jual,
            'diskon' => $x->diskon
        ]);
    }

    public function Hapusbarang($kodebr)
    {
        DB::table('barang')->where('kodebr', $kodebr)->delete();
    }

    public function Editbarang($kodebr)
    {
        return DB::table('barang')->where('kodebr', $kodebr)->get();
    }

    public function Edittbarang($x)
    {
        DB::table('barang')->where('kodebr', $x->kode)->update([
            'nama' => $x->nama,
            'satuan' => $x->satuan,
            'hargabeli' => $x->beli,
            'hargajual' => $x->jual,
            'diskon' => $x->diskon
        ]);
    }

    public function Caribarang($cari)
    {
        return DB::table('barang')->where('kodebr', $cari)->get();
    }
}
