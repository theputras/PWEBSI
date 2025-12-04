<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->string('nopol', 10)->primary();
            $table->string('namakendaraan', 100);
            $table->string('jeniskendaraan', 100);
            $table->string('namadriver', 40);
            $table->string('kontakdriver', 15)->nullable();
            $table->date('tahun')->nullable();
            $table->string('kapasitas', 10)->nullable();
            $table->string('foto', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
