<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->string('kodebr', 20)->primary(); // kode barang
            $table->string('nama', 200);
            $table->string('satuan', 20);
            $table->decimal('hargabeli', 15, 2);
            $table->decimal('hargajual', 15, 2);
            $table->decimal('diskon', 5, 2)->default(0);
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
