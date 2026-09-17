<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('model_prior', function (Blueprint $table) {
            $table->string('id_penyakit', 10)->primary();
            $table->integer('jumlah_kasus');
            $table->double('prior');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('model_prior');
    }
};
