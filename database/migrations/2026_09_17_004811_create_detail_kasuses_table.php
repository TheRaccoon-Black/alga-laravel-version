<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_kasus', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kasus');
            $table->string('id_gejala', 10);
            $table->boolean('nilai')->default(false);
            $table->primary(['id_kasus', 'id_gejala']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_kasus');
    }
};
