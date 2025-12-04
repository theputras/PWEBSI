<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gudang', function (Blueprint $table) {
            $table->string('kodegudang', 20)->primary();
            $table->string('namagudang', 100);
            $table->string('alamat', 200);
            $table->string('kontak', 50)->nullable();
            $table->double('kapasitas', 12, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gudang');
    }
};
