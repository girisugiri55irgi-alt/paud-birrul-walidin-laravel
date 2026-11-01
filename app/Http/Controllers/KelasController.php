<?php
namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::latest()->get();

        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        $item = new Kelas();

        return view('kelas.form', compact('item'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kelas' => ['required', 'string', 'max:255'],
            'kelompok' => ['nullable', 'string', 'max:100'],
            'tahun_ajaran' => ['nullable', 'string', 'max:20'],
            'nama_guru' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);

        Kelas::create($data);

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = Kelas::findOrFail($id);

        return view('kelas.form', compact('item'));
    }

    public function update (Request $request, $id)
    {
        $item = Kelas::findOrFail($id);

        $data = $request->validate([
            'nama_kelas' => ['required', 'string', 'max:255'],
            'kelompok' => ['nullable', 'string', 'max:100'],
            'tahun_ajaran' => ['nullable', 'string', 'max:20'],
            'nama_guru' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $item->update($data);

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}