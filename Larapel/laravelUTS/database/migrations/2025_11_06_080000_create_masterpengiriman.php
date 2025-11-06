<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // INI TABEL MASTER (Info Pengiriman)
        Schema::create('masterkiriman', function (Blueprint $table) {
            // 1. Nama kolom diperbaiki (pakai 'n')
            $table->string('kodepengiriman', 20)->primary();
            
            // 2. Kolom-kolom MASTER yang hilang ditambahkan
            $table->date('tglpengiriman');
            $table->string('nopol', 10);
            $table->string('driver', 50);
            $table->integer('totalqty');
            $table->timestamps();

            // 3. Foreign key ke tabel vehicles (Opsional tapi bagus)
            $table->foreign('nopol')->references('nopol')->on('vehicles');
        });
    }

    public function down()
    {
        Schema::dropIfExists('masterkiriman');
    }
};