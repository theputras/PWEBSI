<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

// abstract class Controller {
// }

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function helloFn() {
        echo "Hello World";
    }

    public function getDataTarget($id, $name, $unit) {
        echo $id;
        echo "<br>";
        echo $name;
        echo "<br>";
        echo $unit;
    }

    // pdf

    public function functionhello() {
        echo "hello word";
    }

    public function terimadataget($id, $nama, $satuan) {
        echo $id;
        echo "<br>";
        echo $nama;
        echo "<br>";
        echo $satuan;
    }

    public function Tampilformpost() {
        return view('viewkedua'); 
    }

    public function Terimadatapost(Request $request) {
        $a = $request->input('nilai1');
        $b = $request->input('nilai2');
        $c = $request->input('operator');

        if (!is_numeric($a) || !is_numeric($b)) {
            echo "Nilai input harus angka!";
            return;
        }

        echo $a;
        echo "<br>";
        echo $b;
        echo "<br>";
        echo $c;
        echo "<br><br>";

        $hasil = null;
        switch ($c) {
            case 'tambah':
                $hasil = $a + $b;
                break;
            case 'kurang':
                $hasil = $a - $b;
                break;
            case 'kali':
                $hasil = $a * $b;
                break;
            case 'bagi':
                if ($b == 0) {
                    echo "Error: Pembagian dengan nol!";
                    return;
                }
                $hasil = $a / $b;
                break;
            default:
                echo "Operator tidak valid!";
                return;
        }

        echo "Hasil operasi: " . $hasil;
    }

}