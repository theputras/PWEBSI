<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // INI TABEL DETAIL (Daftar Produk)
        Schema::create('detailkirim', function (Blueprint $table) {
            // 1. Foreign key ke masterkiriman (pakai 'n')
            $table->string('kodepengiriman', 20);
            
            // 2. Foreign key ke products
            $table->string('kodeproduk', 20);
            
            // 3. Kolom detail
            $table->integer('qty');

            // Kunci utama gabungan
            $table->primary(['kodepengiriman', 'kodeproduk']);

            // Constraints
            $table->foreign('kodepengiriman')->references('kodepengiriman')->on('masterkiriman')->onDelete('cascade');
            $table->foreign('kodeproduk')->references('kodeproduk')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detailkirim');
    }
};