<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('model_likelihood', function (Blueprint $table) {
            $table->string('id_penyakit', 10);
            $table->string('id_gejala', 10);
            $table->integer('f');
            $table->integer('x');
            $table->double('p_ada');
            $table->primary(['id_penyakit', 'id_gejala']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('model_likelihood');
    }
};
