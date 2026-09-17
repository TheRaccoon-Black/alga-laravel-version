<?php

namespace App\Services;

use App\Models\Gejala;
use App\Models\ModelLikelihood;
use App\Models\ModelPrior;
use Illuminate\Support\Facades\DB;

class NaiveBayesService
{
    public function getGejalaList(): array
    {
        return Gejala::orderBy('id_gejala')->get(['id_gejala', 'nama_gejala'])->toArray();
    }

    public function getPenyakitList(): array
    {
        return \App\Models\Penyakit::orderBy('id_penyakit')->get(['id_penyakit', 'nama_penyakit'])->toArray();
    }

    public function buildModel(): array
    {
        $gejalas = array_column($this->getGejalaList(), 'id_gejala');
        $priors = ModelPrior::pluck('prior', 'id_penyakit')->toArray();
        $likelihoods = ModelLikelihood::select('id_penyakit', 'id_gejala', 'p_ada')->get();

        $p = [];
        foreach ($likelihoods as $row) {
            $p[$row->id_penyakit][$row->id_gejala] = (float) $row->p_ada;
        }

        return ['gejala' => $gejalas, 'prior' => $priors, 'p' => $p];
    }

    public function hitungPosterior(array $model, array $aktif): array
    {
        $post = [];
        foreach ($model['prior'] as $idP => $pK) {
            $prob = $pK;
            foreach ($model['gejala'] as $idG) {
                $pG = $model['p'][$idP][$idG] ?? 0.5;
                $prob *= in_array($idG, $aktif, true) ? $pG : (1 - $pG);
            }
            $post[$idP] = $prob;
        }
        $total = array_sum($post) ?: 1;
        foreach ($post as &$v) $v /= $total;
        arsort($post);
        return $post;
    }

    public function getActiveSymptoms(int $idKasus): array
    {
        return DB::table('detail_kasus')
            ->where('id_kasus', $idKasus)
            ->where('nilai', 1)
            ->pluck('id_gejala')
            ->toArray();
    }

    public function getStats(): array
    {
        return [
            'penyakit' => \App\Models\Penyakit::count(),
            'gejala'   => Gejala::count(),
            'kasus'    => DB::table('data_kasus')->count(),
            'latih'    => DB::table('data_kasus')->where('is_uji', 0)->count(),
            'uji'      => DB::table('data_kasus')->where('is_uji', 1)->count(),
            'model'    => ModelLikelihood::count(),
            'konsul'   => DB::table('konsultasi')->count(),
        ];
    }

    public function splitData(): array
    {
        DB::table('data_kasus')->update(['is_uji' => 0]);

        $penyakitList = DB::table('data_kasus')->select('id_penyakit')->distinct()->get();
        $latih = 0;
        $uji = 0;

        foreach ($penyakitList as $p) {
            $ids = DB::table('data_kasus')
                ->where('id_penyakit', $p->id_penyakit)
                ->inRandomOrder()
                ->pluck('id_kasus')
                ->toArray();

            $nUji = (int) floor(count($ids) * 0.2);
            foreach (array_slice($ids, 0, $nUji) as $id) {
                DB::table('data_kasus')->where('id_kasus', $id)->update(['is_uji' => 1]);
                $uji++;
            }
            $latih += count($ids) - $nUji;
        }

        return ['latih' => $latih, 'uji' => $uji];
    }

    public function trainModel(): array
    {
        DB::table('model_prior')->truncate();
        DB::table('model_likelihood')->truncate();

        $totalLatih = DB::table('data_kasus')->where('is_uji', 0)->count();
        if ($totalLatih === 0) {
            return ['success' => false, 'pesan' => 'Belum ada data latih.'];
        }

        $priorData = DB::table('data_kasus')
            ->where('is_uji', 0)
            ->select('id_penyakit', DB::raw('COUNT(*) as x'))
            ->groupBy('id_penyakit')
            ->get();

        foreach ($priorData as $row) {
            ModelPrior::updateOrCreate(
                ['id_penyakit' => $row->id_penyakit],
                ['jumlah_kasus' => (int) $row->x, 'prior' => round($row->x / $totalLatih, 6)]
            );
        }

        $likelihoodData = DB::table('detail_kasus as d')
            ->join('data_kasus as k', 'k.id_kasus', '=', 'd.id_kasus')
            ->where('k.is_uji', 0)
            ->select('k.id_penyakit', 'd.id_gejala', DB::raw('SUM(d.nilai) as f'), DB::raw('COUNT(*) as x'))
            ->groupBy('k.id_penyakit', 'd.id_gejala')
            ->get();

        $jmlLikelihood = 0;
        foreach ($likelihoodData as $row) {
            $f = (int) $row->f;
            $x = (int) $row->x;
            $pAda = ($f + 1) / ($x + 2);
            ModelLikelihood::updateOrCreate(
                ['id_penyakit' => $row->id_penyakit, 'id_gejala' => $row->id_gejala],
                ['f' => $f, 'x' => $x, 'p_ada' => $pAda]
            );
            $jmlLikelihood++;
        }

        return ['success' => true, 'pesan' => "Pelatihan selesai. Model tersimpan: {$totalLatih} data latih, {$jmlLikelihood} parameter likelihood."];
    }

    public function evaluate(): array
    {
        $model = $this->buildModel();
        $kelas = array_column($this->getPenyakitList(), 'id_penyakit');

        $uji = DB::table('data_kasus')->where('is_uji', 1)->get(['id_kasus', 'id_penyakit'])->toArray();
        $C = [];
        foreach ($kelas as $a) {
            foreach ($kelas as $p) {
                $C[$a][$p] = 0;
            }
        }

        foreach ($uji as $k) {
            $aktif = $this->getActiveSymptoms((int) $k->id_kasus);
            $post = $this->hitungPosterior($model, $aktif);
            $prediksi = array_key_first($post);
            $C[$k->id_penyakit][$prediksi]++;
        }

        $total = count($uji);
        $benar = 0;
        foreach ($kelas as $k) $benar += $C[$k][$k];
        $akurasiUji = $total ? round($benar / $total * 100, 2) : 0;

        $latih = DB::table('data_kasus')->where('is_uji', 0)->get(['id_kasus', 'id_penyakit'])->toArray();
        $benarL = 0;
        foreach ($latih as $k) {
            $aktif = $this->getActiveSymptoms((int) $k->id_kasus);
            $post = $this->hitungPosterior($model, $aktif);
            if (array_key_first($post) === $k->id_penyakit) $benarL++;
        }
        $akurasiLatih = count($latih) ? round($benarL / count($latih) * 100, 2) : 0;

        $M = [];
        foreach ($kelas as $k) {
            $TP = $C[$k][$k];
            $FP = 0;
            foreach ($kelas as $a) if ($a !== $k) $FP += $C[$a][$k];
            $FN = array_sum($C[$k]) - $TP;
            $P  = ($TP + $FP) ? $TP / ($TP + $FP) : 0;
            $R  = ($TP + $FN) ? $TP / ($TP + $FN) : 0;
            $M[$k] = ['P' => $P, 'R' => $R, 'F1' => ($P + $R) ? 2 * $P * $R / ($P + $R) : 0];
        }
        $macro = fn($i) => count($kelas) ? array_sum(array_column($M, $i)) / count($kelas) : 0;

        $nama = array_column($this->getPenyakitList(), 'nama_penyakit', 'id_penyakit');

        return compact('C', 'total', 'benar', 'benarL', 'akurasiUji', 'akurasiLatih', 'M', 'macro', 'nama', 'kelas', 'latih');
    }

    public function importCSV(string $filePath, bool $kosongkan = false): array
    {
        if ($kosongkan) {
            DB::table('detail_kasus')->truncate();
            DB::table('data_kasus')->truncate();
        }

        $petaNama = [
            'liken simplek kronik'  => 'Liken Simplek Kronik',
            'liken simpleks kronik' => 'Liken Simplek Kronik',
        ];

        $urutanGejala = ['G01','G02','G03','G04','G05','G06','G07','G08','G09','G10',
                         'G11','G12','G13','G14','G15','G16','G17','G18','G19','G20'];

        $h = fopen($filePath, 'r');
        if (!$h) {
            return ['berhasil' => 0, 'dilewati' => 0, 'duplikat' => 0, 'penyakitBaru' => [], 'error' => 'Cannot open file'];
        }

        // Single-pass: detect delimiter from first line, process remaining rows
        $cek = (string) fgets($h);
        rewind($h);
        $delimiter = (substr_count($cek, ';') > substr_count($cek, ',')) ? ';' : ',';

        $berhasil = 0;
        $dilewati = 0;
        $duplikat = 0;
        $penyakitBaru = [];

        while (($row = fgetcsv($h, 0, $delimiter)) !== false) {
            $row = array_map(fn($v) => trim((string) $v), $row);
            $row[0] = preg_replace('/^\xEF\xBB\xBF/', '', $row[0] ?? '');

            if (array_filter($row) === []) continue;
            if (count($row) !== 25) { $dilewati++; continue; }
            if (!preg_match('/^P\d+$/i', $row[0] ?? '')) continue;

            $kodePasien = $row[0];
            $namaP = $petaNama[strtolower($row[24])] ?? $row[24];

            if ($kodePasien === '' || $namaP === '') { $dilewati++; continue; }

            if (DB::table('data_kasus')->where('kode_pasien', $kodePasien)->exists()) {
                $duplikat++;
                continue;
            }

            $penyakit = DB::table('penyakits')->whereRaw('LOWER(nama_penyakit)=LOWER(?)', [$namaP])->first();
            if ($penyakit) {
                $idP = $penyakit->id_penyakit;
            } else {
                $c = DB::table('penyakits')->count() + 1;
                $idP = 'PK' . str_pad($c, 2, '0', STR_PAD_LEFT);
                DB::table('penyakits')->insert(['id_penyakit' => $idP, 'nama_penyakit' => $namaP]);
                $penyakitBaru[] = $namaP;
            }

            $idK = DB::table('data_kasus')->insertGetId([
                'kode_pasien' => $kodePasien,
                'id_penyakit' => $idP,
                'is_uji' => 0,
            ]);

            foreach ($urutanGejala as $i => $idG) {
                $nilai = (int) $row[4 + $i];
                DB::table('detail_kasus')->insert([
                    'id_kasus' => $idK,
                    'id_gejala' => $idG,
                    'nilai' => $nilai,
                ]);
            }
            $berhasil++;
        }
        fclose($h);

        return [
            'berhasil' => $berhasil,
            'dilewati' => $dilewati,
            'duplikat' => $duplikat,
            'penyakitBaru' => $penyakitBaru,
        ];
    }

    public function tambahKasus(string $kodePasien, string $idPenyakit, array $gejalaAktif): array
    {
        $exists = DB::table('data_kasus')->where('kode_pasien', $kodePasien)->exists();
        if ($exists) return ['success' => false, 'pesan' => "Kode pasien '{$kodePasien}' sudah ada."];

        $idK = DB::table('data_kasus')->insertGetId([
            'kode_pasien' => $kodePasien,
            'id_penyakit' => $idPenyakit,
            'is_uji' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $semuaGejala = $this->getGejalaList();
        foreach ($semuaGejala as $g) {
            $v = in_array($g['id_gejala'], $gejalaAktif, true) ? 1 : 0;
            DB::table('detail_kasus')->insert([
                'id_kasus' => $idK,
                'id_gejala' => $g['id_gejala'],
                'nilai' => $v,
            ]);
        }

        return ['success' => true, 'pesan' => "Kasus {$kodePasien} berhasil ditambahkan (" . count($gejalaAktif) . " gejala aktif)."];
    }

    public function hapusDataset(bool $hapusModel = true, bool $hapusTakTerpakai = true, bool $hapusLog = false): array
    {
        $nKasus = DB::table('data_kasus')->count();

        DB::table('detail_kasus')->truncate();
        DB::table('data_kasus')->truncate();
        $pesan = "{$nKasus} kasus telah dihapus.";

        if ($hapusModel) {
            DB::table('model_prior')->truncate();
            DB::table('model_likelihood')->truncate();
            $pesan .= " Model terlatih ikut dihapus.";
        }
        if ($hapusTakTerpakai) {
            $tidakTerpakai = DB::table('penyakits as p')
                ->leftJoin('data_kasus as k', 'k.id_penyakit', '=', 'p.id_penyakit')
                ->select('p.id_penyakit')
                ->groupBy('p.id_penyakit')
                ->havingRaw('COUNT(k.id_kasus) = 0')
                ->pluck('id_penyakit')
                ->toArray();
            if ($tidakTerpakai) {
                DB::table('penyakits')->whereIn('id_penyakit', $tidakTerpakai)->delete();
                $pesan .= " " . count($tidakTerpakai) . " penyakit kosong dihapus.";
            }
        }
        if ($hapusLog) {
            DB::table('konsultasi')->truncate();
            $pesan .= " Log konsultasi dibersihkan.";
        }

        return ['pesan' => $pesan];
    }

    public function cariSaranKode(): string
    {
        $max = DB::table('data_kasus')
            ->where('kode_pasien', 'like', 'P%')
            ->selectRaw("MAX(CAST(SUBSTRING(kode_pasien,2) AS UNSIGNED)) as m")
            ->value('m');
        $next = (int) ($max ?? 0) + 1;
        return 'P' . str_pad($next, 3, '0', STR_PAD_LEFT);
    }
}
