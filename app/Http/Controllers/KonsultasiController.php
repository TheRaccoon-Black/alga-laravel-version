<?php

namespace App\Http\Controllers;

use App\Services\NaiveBayesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            } else {
                $dipilih = $displayPost;
                $model = $service->buildModel();
                $post = $service->hitungPosterior($model, $dipilih);
                $penyakitList = $service->getPenyakitList();
                $nama = array_column($penyakitList, 'nama_penyakit', 'id_penyakit');

                $idTop = array_key_first($post);
                $top = $post[$idTop];
                DB::table('konsultasi')->insert([
                    'waktu' => now(),
                    'gejala_input' => json_encode($dipilih),
                    'hasil_utama' => $idTop,
                    'prob_utama' => $top,
                ]);
                session(['hasil_terakhir' => [
                    'gejala' => $dipilih,
                    'post'   => $post,
                    'nama'   => $nama,
                ]]);
            }
            return view('konsultasi.hasil', compact('dipilih', 'post', 'nama'));
        }

        return view('konsultasi.index', compact('gejalas'));
    }
}
