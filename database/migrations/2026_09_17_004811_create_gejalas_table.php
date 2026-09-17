<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gejalas', function (Blueprint $table) {
            $table->string('id_gejala', 10)->primary();
            $table->string('nama_gejala', 100);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gejalas');
    }
};
