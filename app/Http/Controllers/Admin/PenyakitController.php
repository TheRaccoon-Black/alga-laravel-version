<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PenyakitController extends Controller
{
    public function index()
    {
        $penyakit = Penyakit::orderBy('id_penyakit')->get();
        return view('admin.penyakit.index', compact('penyakit'));
    }

    public function store(Request $request)
    {
        $rules = [
            'id_penyakit' => 'required|string|max:10|unique:penyakits,id_penyakit',
            'nama_penyakit' => 'required|string|max:100',
            'penyebab' => 'nullable|string',
            'ciri_ciri' => 'nullable|string',
            'treatment' => 'nullable|string',
            'obat' => 'nullable|string',
        ];
        if ($request->hasFile('gambar')) {
            $rules['gambar'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048';
        }

        $request->validate($rules);

        $data = $request->only(['id_penyakit', 'nama_penyakit', 'penyebab', 'ciri_ciri', 'treatment', 'obat']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('penyakit', 'public');
        }

        Penyakit::create($data);

        return redirect()->route('admin.penyakit.index')
            ->with('success', 'Penyakit berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $penyakit = Penyakit::where('id_penyakit', $id)->firstOrFail();

        $rules = [
            'nama_penyakit' => 'required|string|max:100',
            'penyebab' => 'nullable|string',
            'ciri_ciri' => 'nullable|string',
            'treatment' => 'nullable|string',
            'obat' => 'nullable|string',
        ];
        if ($request->hasFile('gambar')) {
            $rules['gambar'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048';
        }

        $request->validate($rules);

        $data = $request->only(['nama_penyakit', 'penyebab', 'ciri_ciri', 'treatment', 'obat']);
        if ($request->hasFile('gambar')) {
            if ($penyakit->gambar) {
                Storage::disk('public')->delete($penyakit->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('penyakit', 'public');
        }

        $penyakit->update($data);

        return redirect()->route('admin.penyakit.index')
            ->with('success', 'Penyakit berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penyakit = Penyakit::where('id_penyakit', $id)->firstOrFail();

        $kasusCount = DB::table('data_kasus')->where('id_penyakit', $id)->count();
        if ($kasusCount > 0) {
            return redirect()->route('admin.penyakit.index')
                ->with('error', "Penyakit tidak dapat dihapus karena masih memiliki {$kasusCount} data kasus.");
        }

        $penyakit->delete();

        return redirect()->route('admin.penyakit.index')
            ->with('success', 'Penyakit berhasil dihapus.');
    }
}
