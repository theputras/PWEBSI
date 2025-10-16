<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\models\Model1;  // week5
use App\Models\Model2;  // week5

class Controller extends BaseController
{
    public function fungsihello(){
        echo "Tahu Campur";
    }
    
    public function terimadataget($id,$nama,$satuan) {
        echo $id;
        echo "<br>";
        echo $nama;
        echo "<br>";
        echo $satuan;
        echo "<br>";
        echo "Selamat datang di website saya";
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
    
    public function konversiFahrenheitKeCelsius(Request $request) {
    $fahrenheit = $request->input('fahrenheit');
    if (!is_numeric($fahrenheit)) {
        return "Masukkan nilai angka untuk Fahrenheit!";
    }
    
    $celsius = ($fahrenheit - 32) * 5 / 9;
    return view('hasilKonversi', ['celsius' => $celsius, 'fahrenheit' => $fahrenheit]);
}

public function konversiMeterKeSentimeter(Request $request) {
    $meter = $request->input('meter');
    if (!is_numeric($meter)) {
        return "Masukkan nilai angka untuk Meter!";
    }
    
    $sentimeter = $meter * 100;
    return view('hasilKonversiMeter', [
    'sentimeter' => $sentimeter,
    'meter' => $meter
    ]);
}

public function hitungDiskon(Request $request) {
    $harga = $request->input('harga');
    $persenDiskon = $request->input('persenDiskon');
    
    if (!is_numeric($harga) || !is_numeric($persenDiskon)) {
        return "Masukkan angka yang valid untuk harga dan diskon!";
    }
    
    $diskon = ($harga * $persenDiskon) / 100;
    $hargaSetelahDiskon = $harga - $diskon;
    return view('hasilDiskon', ['hargaSetelahDiskon' => $hargaSetelahDiskon, 'harga' => $harga, 'persenDiskon' => $persenDiskon]);
}
public function hitungNilaiAkhir(Request $request) {
    $uts = $request->input('uts');
    $uas = $request->input('uas');
    $tugas = $request->input('tugas');
    
    if (!is_numeric($uts) || !is_numeric($uas) || !is_numeric($tugas)) {
        return "Masukkan nilai angka yang valid!";
    }
    
    $nilaiAkhir = ($uts * 0.3) + ($uas * 0.4) + ($tugas * 0.3);
    return view('hasilNilaiAkhir', ['nilaiAkhir' => $nilaiAkhir, 'uts' => $uts, 'uas' => $uas, 'tugas' => $tugas]);
}

    // week 5
    public function PenampilanControl()
    {
        // $xx = new Model1();
        // $xx->PenampilanModel();
        // echo '<br>';
        // $xx->ProsedureModel(20, 30);
        // echo '<br>';
        // echo $xx->FungsinyaModel(20, 30);
        // echo '<br>';
        $yy = new Model2();
        $yy->PenampilanModel();
        echo '<br>';
        $yy->ProsedureModel(20, 30);
        echo '<br>';
        echo $yy->FungsinyaModel(20, 30);
    }


}
