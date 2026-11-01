<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    // Halaman materi yang dapat dilihat semua pengguna
    public function index()
    {
        $materis = Materi::latest()->get();

        return view('materi', compact('materis'));
    }

    // Halaman pengelolaan materi untuk Admin dan Guru
    public function kelola()
    {
        $this->cekPengelola();

        $materis = Materi::latest()->get();

        return view('materi.index', compact('materis'));
    }

    public function create()
    {
        $this->cekPengelola();

        return view('materi.create');
    }

    public function store(Request $request)
    {
        $this->cekPengelola();

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'tema' => 'nullable|string|max:255',
            'kelompok_usia' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'isi_materi' => 'nullable|string',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png|max:10240',
        ]);

        if ($request->hasFile('file_materi')) {
            $file = $request->file('file_materi');

            $data['file_materi'] = $file->store('materi', 'public');
            $data['jenis_file'] = $file->getClientOriginalExtension();
        }

        $data['user_id'] = auth()->id();

        Materi::create($data);

        return redirect()
            ->route('materi.kelola')
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(Materi $materi)
    {
        $this->cekPengelola();

        return view('materi.edit', compact('materi'));
    }

    public function update(Request $request, Materi $materi)
    {
        $this->cekPengelola();

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'tema' => 'nullable|string|max:255',
            'kelompok_usia' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'isi_materi' => 'nullable|string',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png|max:10240',
        ]);

        if ($request->hasFile('file_materi')) {
            if ($materi->file_materi) {
                Storage::disk('public')->delete($materi->file_materi);
            }

            $file = $request->file('file_materi');

            $data['file_materi'] = $file->store('materi', 'public');
            $data['jenis_file'] = $file->getClientOriginalExtension();
        }

        $materi->update($data);

        return redirect()
            ->route('materi.kelola')
            ->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        $this->cekPengelola();

        if ($materi->file_materi) {
            Storage::disk('public')->delete($materi->file_materi);
        }

        $materi->delete();

        return redirect()
            ->route('materi.kelola')
            ->with('success', 'Materi berhasil dihapus.');
    }

    // Hanya Administrator dan Pendidik yang boleh mengelola materi
    private function cekPengelola()
    {
        abort_unless(
            auth()->check()
            && in_array(auth()->user()->role, ['administrator', 'pendidik']),
            403,
            'Anda tidak memiliki hak akses untuk mengelola materi.'
        );
    }
}
