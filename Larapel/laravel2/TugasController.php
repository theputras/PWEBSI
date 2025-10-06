<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TugasController extends Controller
{
    // 1. Hitung luas permukaan & volume balok/kubus
    public function hitungBangun($bangun, $p, $l = null, $t = null)
    {
        if ($bangun == "kubus") {
            $luas = 6 * ($p * $p);
            $volume = pow($p, 3);
            return "Kubus sisi $p<br>Luas Permukaan = $luas<br>Volume = $volume";
        } elseif ($bangun == "balok") {
            $luas = 2 * (($p * $l) + ($p * $t) + ($l * $t));
            $volume = $p * $l * $t;
            return "Balok p=$p, l=$l, t=$t<br>Luas Permukaan = $luas<br>Volume = $volume";
        } else {
            return "Bangun tidak dikenali (gunakan 'kubus' atau 'balok')";
        }
    }

    // 2. Data array
    public function tampilArray()
    {
        $buah = ["Apel", "Jeruk", "Mangga", "Pisang"];
        return view('array', compact('buah'));
    }

    // 3. Data karyawan
    public function tampilKaryawan()
    {
        $karyawan = [
            ["id"=>1,"nama"=>"Budi","jabatan"=>"Manager"],
            ["id"=>2,"nama"=>"Ani","jabatan"=>"Staff"],
            ["id"=>3,"nama"=>"Siti","jabatan"=>"HRD"]
        ];
        return view('karyawan', compact('karyawan'));
    }

    // 4. Data barang
    public function tampilBarang()
    {
        $barang = [
            ["id"=>101,"nama"=>"Laptop","harga"=>7000000],
            ["id"=>102,"nama"=>"Printer","harga"=>2000000],
            ["id"=>103,"nama"=>"Mouse","harga"=>150000]
        ];
        return view('barang', compact('barang'));
    }

    // 5. Data supplier
    public function tampilSupplier()
    {
        $supplier = [
            ["id"=>201,"nama"=>"PT Sumber Makmur","kota"=>"Jakarta"],
            ["id"=>202,"nama"=>"CV Abadi Jaya","kota"=>"Bandung"],
            ["id"=>203,"nama"=>"UD Sentosa","kota"=>"Surabaya"]
        ];
        return view('supplier', compact('supplier'));
    }
}
