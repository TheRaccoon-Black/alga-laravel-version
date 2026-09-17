<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NaiveBayesService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(NaiveBayesService $service)
    {
        $nextKode = $service->cariSaranKode();
        $penyakitList = $service->getPenyakitList();
        $gejalaList = $service->getGejalaList();

        $riwayat = \Illuminate\Support\Facades\DB::table('data_kasus as k')
            ->join('penyakits as p', 'p.id_penyakit', '=', 'k.id_penyakit')
            ->select('k.id_kasus', 'k.kode_pasien', 'k.is_uji', 'p.nama_penyakit',
                \Illuminate\Support\Facades\DB::raw("(SELECT COUNT(*) FROM detail_kasus d WHERE d.id_kasus=k.id_kasus AND d.nilai=1) as jml"))
            ->orderByDesc('k.id_kasus')
            ->limit(20)
            ->get();

        return view('admin.dashboard', compact('nextKode', 'penyakitList', 'gejalaList', 'riwayat'));
    }

    public function store(Request $request, NaiveBayesService $service)
    {
        $kode = trim($request->input('kode_pasien', ''));
        $idP = trim($request->input('id_penyakit', ''));
        $gejala = $request->input('gejala', []);

        if ($kode === '' || $idP === '') {
            return back()->with('error', 'Kode pasien dan penyakit wajib diisi.');
        }
        if (count($gejala) < 1) {
            return back()->with('error', 'Pilih minimal satu gejala.');
        }

        $result = $service->tambahKasus($kode, $idP, $gejala);
        return back()->with('success', $result['pesan']);
    }

    public function destroy($id)
    {
        \Illuminate\Support\Facades\DB::table('detail_kasus')->where('id_kasus', $id)->delete();
        \Illuminate\Support\Facades\DB::table('data_kasus')->where('id_kasus', $id)->delete();
        return back()->with('success', "Kasus #{$id} dihapus.");
    }
}
