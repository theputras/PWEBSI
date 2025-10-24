<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

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
    
    public function showBladeForm()
    {
        return view('input_blade');
    }

    /**
     * Menerima data dari form, lalu menampilkannya di halaman output.
     */
    public function processBladeForm(Request $request)
    {
        // Validasi sederhana (opsional, tapi praktik yang baik)
        $validatedData = $request->validate([
            'tgl' => 'required|date',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telp' => 'required|numeric',
        ]);

        // Kirim data yang sudah divalidasi ke view output
        return view('output_blade', ['data' => $validatedData]);
    }

public function showJqueryForm()
    {
        return view('input_jquery');
    }

    /**
     * Menerima data dari URL (Query String), lalu menampilkannya.
     */
    public function processJqueryForm(Request $request)
    {
        // Data diambil langsung dari request GET (URL)
        $data = $request->all();

        return view('output_jquery', ['data' => $data]);
    }
    
    public function indexSegitiga()
    {
        return view('segitiga.input');
    }

    public function hitung(Request $request)
    {
        $request->validate([
            'sisi1' => 'required|numeric|min:1',
            'sisi2' => 'required|numeric|min:1',
            'sisi3' => 'required|numeric|min:1',
        ]);

        $keliling = $request->sisi1 + $request->sisi2 + $request->sisi3;

        return view('segitiga.hasil', compact('keliling'));
    }
    
        public function totalOrder(Request $request)
    {
        $items = $request->input('items', []);
        $order = new Order();
        $result = $order->calculateTotal($items);
        return response()->json($result);
    }
}
