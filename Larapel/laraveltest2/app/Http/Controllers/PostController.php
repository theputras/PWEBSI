<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return 'ini adalah halaamn postingan';
    }
    
    public function show($n1, $n2, $n3)
    {
        echo "Nilai 1: $n1 <br> Nilai 2: $n2 <br> Nilai 3: $n3";
    }
}
