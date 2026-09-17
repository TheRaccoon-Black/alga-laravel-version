<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_kasus', function (Blueprint $table) {
            $table->id('id_kasus');
            $table->string('kode_pasien', 20)->nullable();
            $table->string('id_penyakit', 10);
            $table->boolean('is_uji')->default(false);
            $table->timestamps();
            $table->index('id_penyakit');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_kasus');
    }
};
