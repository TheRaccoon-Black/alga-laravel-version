<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NaiveBayesService;
use Illuminate\Http\Request;

class SplitDataController extends Controller
{
    public function index(NaiveBayesService $service)
    {
        $totalKasus = \Illuminate\Support\Facades\DB::table('data_kasus')->count();
        $sukses = false;
        $latih = $uji = 0;

        $req = request();
        if ($req->method() === 'POST' && $req->post('konfirmasi')) {
            $result = $service->splitData();
            $sukses = true;
            $latih = $result['latih'];
            $uji = $result['uji'];
        }

        return view('admin.split', compact('totalKasus', 'sukses', 'latih', 'uji'));
    }

    public function store(Request $request, NaiveBayesService $service)
    {
        $result = $service->splitData();
        $msg = "Pemisahan data selesai: {$result['latih']} data latih, {$result['uji']} data uji.";
        return back()->with('success', $msg);
    }
}
