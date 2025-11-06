<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
// Create Produk Table
public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('kodeproduk', 20)->unique();
        $table->string('nama', 50);
        $table->string('satuan', 15);
        $table->double('harga');
        $table->string('gambar', 255);
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('products');
    }
}
