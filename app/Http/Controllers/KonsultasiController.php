<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Penyakit;
use App\Services\NaiveBayesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KonsultasiController extends Controller
{
    public function index(Request $request, NaiveBayesService $service)
    {
        $gejalas = $service->getGejalaList();

        if ($request->has('baru')) {
            session()->forget('hasil_terakhir');
        }

        $hasil = session('hasil_terakhir');
        $displayPost = $request->post('gejala');

        if (!empty($displayPost) || !empty($hasil)) {
            if (!empty($hasil)) {
                $dipilih = $hasil['gejala'];
                $post = $hasil['post'];
                $nama = $hasil['nama'];
                $detail = $hasil['detail'] ?? [];
                $explanation = $hasil['explanation'] ?? [];
            } else {
                $dipilih = $displayPost;
                $model = $service->buildModel();
                $post = $service->hitungPosterior($model, $dipilih);
                $penyakitList = $service->getPenyakitList();
                $nama = array_column($penyakitList, 'nama_penyakit', 'id_penyakit');

                // Ambil detail penyakit yang ada
                $detailRows = DB::table('penyakits')->whereNotNull('penyebab')->get()->keyBy('id_penyakit');
                $detail = [];
                foreach (array_keys($post) as $id) {
                    if ($detailRows->has($id)) {
                        $row = $detailRows->get($id);
                        $detail[$id] = [
                            'penyebab'  => $row->penyebab,
                            'ciri_ciri' => $row->ciri_ciri,
                            'treatment' => $row->treatment,
                            'obat'      => $row->obat,
                            'gambar'    => $row->gambar,
                        ];
                    }
                }

                $idTop = array_key_first($post);
                $top = $post[$idTop];
                $explanation = $service->getExplanation($model, $dipilih, $idTop);
                DB::table('konsultasi')->insert([
                    'waktu'      => now(),
                    'gejala_input' => json_encode($dipilih),
                    'hasil_utama'  => $idTop,
                    'prob_utama'   => $top,
                ]);
                session(['hasil_terakhir' => [
                    'gejala'      => $dipilih,
                    'post'        => $post,
                    'nama'        => $nama,
                    'detail'      => $detail,
                    'explanation' => $explanation,
                ]]);
            }
            return view('konsultasi.hasil', compact('dipilih', 'post', 'nama', 'detail', 'explanation'));
        }

        return view('konsultasi.index', compact('gejalas'));
    }

    public function riwayat()
    {
        $query = DB::table('konsultasi')
            ->orderByDesc('id_konsultasi');

        $riwayat = $query->paginate(15);

        $gejalaMap = Gejala::pluck('nama_gejala', 'id_gejala')->toArray();
        $penyakitMap = Penyakit::pluck('nama_penyakit', 'id_penyakit')->toArray();

        $gambarMap = DB::table('penyakits')->pluck('gambar', 'id_penyakit')->toArray();
        $riwayat->getCollection()->map(function ($r) use ($gejalaMap, $penyakitMap, $gambarMap) {
            $gejalaIds = is_string($r->gejala_input)
                ? json_decode($r->gejala_input, true)
                : $r->gejala_input;
            $r->gejala_nama = array_map(fn($id) => $gejalaMap[$id] ?? $id, (array)$gejalaIds);
            $r->penyakit_nama = $penyakitMap[$r->hasil_utama] ?? $r->hasil_utama;
            $r->prob_persen = round($r->prob_utama * 100, 1);
            $r->waktu_str = \Carbon\Carbon::parse($r->waktu)->format('d M Y, H:i');
            $r->gambar = $gambarMap[$r->hasil_utama] ?? null;
            return $r;
        });

        return view('konsultasi.riwayat', compact('riwayat'));
    }

    public function hapusSatuan($id)
    {
        DB::table('konsultasi')->where('id_konsultasi', $id)->delete();
        return redirect()->route('konsultasi.riwayat')->with('success', 'Riwayat berhasil dihapus.');
    }

    public function hapusSemua()
    {
        DB::table('konsultasi')->truncate();
        return redirect()->route('konsultasi.riwayat')->with('success', 'Semua riwayat berhasil dihapus.');
    }
}
