<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penyakits', function (Blueprint $table) {
            $table->text('penyebab')->nullable()->after('nama_penyakit');
            $table->text('ciri_ciri')->nullable()->after('penyebab');
            $table->text('treatment')->nullable()->after('ciri_ciri');
            $table->text('obat')->nullable()->after('treatment');
        });
    }

    public function down(): void
    {
        Schema::table('penyakits', function (Blueprint $table) {
            $table->dropColumn(['penyebab', 'ciri_ciri', 'treatment', 'obat']);
        });
    }
};
