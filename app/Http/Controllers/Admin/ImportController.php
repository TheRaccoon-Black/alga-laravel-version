<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NaiveBayesService;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index()
    {
        return view('admin.import');
    }

    public function store(Request $request, NaiveBayesService $service)
    {
        $file = $request->file('csv_file');
        if (!$file) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        $kosongkan = $request->has('kosongkan');
        $result = $service->importCSV($file->getPathname(), $kosongkan);

        $message = "Import selesai: {$result['berhasil']} kasus masuk, {$result['duplikat']} duplikat dilewati, {$result['dilewati']} baris tidak valid.";
        if (!empty($result['penyakitBaru'])) {
            $message .= "<br><b>Penyakit baru:</b> " . implode(', ', $result['penyakitBaru']);
        }

        return back()->with('success', $message);
    }
}
