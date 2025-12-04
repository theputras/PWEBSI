<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detailkirim', function (Blueprint $table) {
            $table->string('kodekirim', 20);
            $table->string('kodeproduk', 20);
            $table->double('qty', 12, 2)->default(0);

            $table->primary(['kodekirim', 'kodeproduk']);

            $table
                ->foreign('kodekirim')
                ->references('kodekirim')
                ->on('masterkirim')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table
                ->foreign('kodeproduk')
                ->references('kodeproduk')
                ->on('produk')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('detailkirim', function (Blueprint $table) {
            $table->dropForeign(['kodekirim']);
            $table->dropForeign(['kodeproduk']);
        });
        Schema::dropIfExists('detailkirim');
    }
};
