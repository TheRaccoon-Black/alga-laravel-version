<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NaiveBayesService;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index(NaiveBayesService $service)
    {
        $statModel = \Illuminate\Support\Facades\DB::table('model_likelihood')->count();
        $statKasus = \Illuminate\Support\Facades\DB::table('data_kasus')->where('is_uji', 0)->count();
        $sukses = false;
        $pesan = '';

        if (request()->method() === 'POST' && request()->post('konfirmasi')) {
            $result = $service->trainModel();
            $sukses = $result['success'];
            $pesan = $result['pesan'];
        }

        return view('admin.training', compact('statModel', 'statKasus', 'sukses', 'pesan'));
    }

    public function store(Request $request, NaiveBayesService $service)
    {
        $result = $service->trainModel();
        if ($result['success']) {
            return redirect()->route('admin.evaluation.index')->with('success', $result['pesan']);
        }
        return back()->with('error', $result['pesan']);
    }
}
