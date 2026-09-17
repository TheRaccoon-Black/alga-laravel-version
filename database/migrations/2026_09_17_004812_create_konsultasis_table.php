<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id('id_konsultasi');
            $table->timestamp('waktu')->useCurrent();
            $table->text('gejala_input');
            $table->string('hasil_utama', 10);
            $table->double('prob_utama');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konsultasi');
    }
};
