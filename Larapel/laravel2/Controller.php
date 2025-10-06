<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

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
}
