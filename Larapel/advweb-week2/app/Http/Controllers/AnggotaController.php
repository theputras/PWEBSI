<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class AnggotaController extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function tampil() {
        echo "ini anggota controller lain ";
    }
}