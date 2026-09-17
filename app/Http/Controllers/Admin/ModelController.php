<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ModelController extends Controller
{
    public function index()
    {
        $priors = DB::table('model_prior')
            ->orderBy('id_penyakit')
            ->get();

        $penyakitMap = DB::table('penyakits')->pluck('nama_penyakit', 'id_penyakit')->toArray();
        $gejalaMap = DB::table('gejalas')->pluck('nama_gejala', 'id_gejala')->toArray();

        $likelihoods = DB::table('model_likelihood')
            ->orderBy('id_penyakit')
            ->orderBy('id_gejala')
            ->get();

        return view('admin.model', compact('priors', 'likelihoods', 'penyakitMap', 'gejalaMap'));
    }
}
