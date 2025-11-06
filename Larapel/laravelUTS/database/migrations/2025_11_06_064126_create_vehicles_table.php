<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
// Create Kendaraan Table
public function up()
{
    Schema::create('vehicles', function (Blueprint $table) {
        $table->id();
        $table->string('nopol', 20)->unique();
        $table->string('nama_kendaraan', 100);
        $table->string('jenis_kendaraan', 50);
        $table->string('kontakdriver', 50);
        $table->integer('tahun');
        $table->double('kapasitas');
        $table->string('foto', 255)->nullable();
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
