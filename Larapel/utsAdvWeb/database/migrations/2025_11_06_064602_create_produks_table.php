<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->string('kodeproduk', 20)->primary();
            $table->string('nama', 200);
            $table->string('satuan', 15);
            $table->double('harga', 12, 2)->default(0);
            $table->string('gambar', 255)->nullable();
            $table->string('kodegudang', 20);

            $table
                ->foreign('kodegudang')
                ->references('kodegudang')
                ->on('gudang')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropForeign(['kodegudang']);
        });
        Schema::dropIfExists('produk');
    }
};
