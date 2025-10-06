<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class SoalLatihanController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // 1. Membuat website Perhitungan luas permukaan dan volume bangun balok, kubus
    public function perhitunganLuas($panjang, $lebar, $tinggi)
    {
        $p = (float) $panjang;
        $l = (float) $lebar;
        $t = (float) $tinggi;

        echo "Panjang: {$p} unit<br>";
        echo "Lebar: {$l} unit<br>";
        echo "Tinggi: {$t} unit<br><br>";

        $luasPermukaanBalok = 2 * (($p * $l) + ($p * $t) + ($l * $t));
        $volumeBalok = $p * $l * $t;

        echo "Luas permukaan balok: {$luasPermukaanBalok} unit<sup>2</sup><br>";
        echo "Volume balok: {$volumeBalok} unit<sup>3</sup><br>";
    }

    // 2. Membuat website Menampilkan data array
    public function tampilkanArray()
    {
        $data = [1, 2, 3, 4, 'a', 'b', 'c', 'd'];
        echo '<h3>Data Array</h3>';
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    // 3. Membuat website Menampilkan data Karyawan
    public function tampilkanKaryawan()
    {
        $karyawans = [
            ['nama' => 'Budi', 'jabatan' => 'Manager', 'gaji' => 8000000],
            ['nama' => 'Siti', 'jabatan' => 'Staff', 'gaji' => 5000000],
        ];
        echo '<h3>Data Karyawan</h3><ul>';
        foreach ($karyawans as $karyawan) {
            echo "<li>Nama: {$karyawan['nama']}, Jabatan: {$karyawan['jabatan']}, Gaji: Rp.{$karyawan['gaji']}</li>";
        }
        echo '</ul>';
    }

    // 4. Membuat website Menampilkan data Barang
    public function tampilkanBarang()
    {
        $barangs = [
            ['nama' => 'Pensil', 'stok' => 100, 'harga' => 2000],
            ['nama' => 'Buku', 'stok' => 50, 'harga' => 5000],
        ];
        echo '<h3>Data Barang</h3><ul>';
        foreach ($barangs as $barang) {
            echo "<li>{$barang['nama']} - Stok: {$barang['stok']}, Harga: Rp.{$barang['harga']}</li>";
        }
        echo '</ul>';
    }

    // 5. Membuat website Menampilkan data Supplier
    public function tampilkanSupplier()
    {
        $suppliers = [
            ['nama' => 'PT. Sumber Makmur', 'kota' => 'Bandung', 'telepon' => '02212345'],
            ['nama' => 'CV. Jaya Abadi', 'kota' => 'Jakarta', 'telepon' => '02156789'],
        ];
        echo '<h3>Data Supplier</h3><ul>';
        foreach ($suppliers as $supplier) {
            echo "<li>{$supplier['nama']} (Kota: {$supplier['kota']}), Telp: {$supplier['telepon']}</li>";
        }
        echo '</ul>';
    }
}
