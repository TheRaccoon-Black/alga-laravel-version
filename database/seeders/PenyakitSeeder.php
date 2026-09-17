<?php

namespace Database\Seeders;

use App\Models\Penyakit;
use Illuminate\Database\Seeder;

class PenyakitSeeder extends Seeder
{
    public function run(): void
    {
        $penyakit = [
            ['PK01', 'Dermatitis Kontak'],
            ['PK02', 'Dermatitis Seboroik'],
            ['PK03', 'Dermatitis Atopik'],
            ['PK04', 'Tinea Cruris'],
            ['PK05', 'Liken Simplek Kronik'],
            ['PK06', 'Psoriasis'],
            ['PK07', 'Tinea Corporis'],
            ['PK08', 'Skabies'],
            ['PK09', 'Panu'],
            ['PK10', 'Herpes Zoster'],
            ['PK11', 'Vitiligo'],
            ['PK12', 'Impetigo'],
        ];
        foreach ($penyakit as $p) {
            Penyakit::updateOrCreate(['id_penyakit' => $p[0]], ['nama_penyakit' => $p[1]]);
        }
    }
}
