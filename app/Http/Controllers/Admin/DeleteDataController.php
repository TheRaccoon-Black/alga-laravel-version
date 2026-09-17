<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NaiveBayesService;
use Illuminate\Http\Request;

class DeleteDataController extends Controller
{
    public function index(NaiveBayesService $service)
    {
        $stat = [
            'kasus' => \Illuminate\Support\Facades\DB::table('data_kasus')->count(),
            'model' => \Illuminate\Support\Facades\DB::table('model_likelihood')->count(),
            'log'   => \Illuminate\Support\Facades\DB::table('konsultasi')->count(),
        ];
        return view('admin.delete', compact('stat'));
    }

    public function store(Request $request, NaiveBayesService $service)
    {
        $hapusModel = $request->has('hapus_model');
        $hapusTakTerpakai = $request->has('hapus_tak_terpakai');
        $hapusLog = $request->has('hapus_log');

        $result = $service->hapusDataset($hapusModel, $hapusTakTerpakai, $hapusLog);
        return back()->with('success', $result['pesan']);
    }
}
