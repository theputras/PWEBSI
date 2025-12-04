<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('masterkirim', function (Blueprint $table) {
            $table->string('kodekirim', 20)->primary();
            $table->date('tglkirim');
            $table->string('nopol', 10);
            $table->double('totalqty', 12, 2)->default(0);

            $table
                ->foreign('nopol')
                ->references('nopol')
                ->on('kendaraan')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('masterkirim', function (Blueprint $table) {
            $table->dropForeign(['nopol']);
        });
        Schema::dropIfExists('masterkirim');
    }
};
