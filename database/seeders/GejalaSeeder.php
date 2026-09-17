<?php

namespace Database\Seeders;

use App\Models\Gejala;
use Illuminate\Database\Seeder;

class GejalaSeeder extends Seeder
{
    public function run(): void
    {
        $gejala = [
            ['G01', 'Gatal'],
            ['G02', 'Kemerahan'],
            ['G03', 'Bersisik'],
            ['G04', 'Kulit Kering'],
            ['G05', 'Peradangan'],
            ['G06', 'Ruam'],
            ['G07', 'Nyeri'],
            ['G08', 'Lepuhan'],
            ['G09', 'Penebalan'],
            ['G10', 'Bercak Kulit'],
            ['G11', 'Perubahan Warna'],
            ['G12', 'Lesi Melingkar'],
            ['G13', 'Batas Lesi Tegas'],
            ['G14', 'Lokasi Lipatan'],
            ['G15', 'Lokasi Kulit Kepala'],
            ['G16', 'Kerak'],
            ['G17', 'Bernanah'],
            ['G18', 'Gatal Malam'],
            ['G19', 'Gatal Menuju Malam'],
            ['G20', 'Kulit Pecah-pecah'],
        ];
        foreach ($gejala as $g) {
            Gejala::updateOrCreate(['id_gejala' => $g[0]], ['nama_gejala' => $g[1]]);
        }
    }
}
