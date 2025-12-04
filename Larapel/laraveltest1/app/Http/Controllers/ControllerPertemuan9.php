<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;
 
class ControllerPertemuan9 extends BaseController
{
    public function tugas90()
    {
        $b = DB::table('barang')->get();
            
        foreach ($b as $bb)
        {
            echo $bb->nama . "<br>";  
        }
    }    
    public function tugasDiskon()
    {
        $b = DB::table('barang')
        ->where('diskon', '>=', 20)
        ->get();
            
        foreach ($b as $bb)
        {
            echo $bb->nama . " " . $bb-> diskon . "<br>";  
        }
    }    
    public function tugasSelect()
    {
       $b = DB::table('barang')
    ->select('nama', 'hargabeli as harga_beli')
    ->get();
            
 foreach ($b as $bb)
    {
        // Menampilkan nama dan harga beli
        // Karena kita menggunakan alias 'harga_beli', kita panggil properti itu
        echo "<li>Nama: " . $bb->nama . " | Harga Beli: Rp" . number_format($bb->harga_beli, 0, ',', '.') . "</li>";
    }

    echo "</ul>";
    }
}