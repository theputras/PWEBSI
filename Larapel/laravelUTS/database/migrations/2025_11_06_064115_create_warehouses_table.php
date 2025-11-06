<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousesTable extends Migration
{
// Create Gudang Table
public function up()
{
    Schema::create('warehouses', function (Blueprint $table) {
        $table->id();
        $table->string('kodegudang', 20)->unique();
        $table->string('namagudang', 100);
        $table->string('alamat', 255);
        $table->string('kontak', 50);
        $table->double('kapasitas');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('warehouses');
    }
}
