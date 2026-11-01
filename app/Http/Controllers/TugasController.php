<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    private function cekPengelola(): void
    {
        abort_unless(
            auth()->check() &&
            in_array(auth()->user()->role, ['administrator', 'pendidik']),
            403,
            'Anda tidak memiliki izin untuk mengelola tugas.'
        );
    }

    public function index()
    {
        $this->cekPengelola();

        $tugas = Tugas::latest()->get();

        return view('tugas.index', compact('tugas'));
    }

    public function create()
    {
        $this->cekPengelola();

        return view('tugas.create');
    }

    public function store(Request $request)
    {
        $this->cekPengelola();

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'nullable|date',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,mp4,webm,mov,avi,jpg,jpeg,png|max:51200',
        ]);

        if ($request->hasFile('file_materi')) {
            $data['file_materi'] = $request->file('file_materi')
                ->store('materi-tugas', 'public');
        }

        Tugas::create($data);

        return redirect()
            ->route('tugas.index')
            ->with('success', 'Tugas berhasil ditambahkan.');
    }

public function edit(Tugas $tugas)
{
    $this->cekPengelola();

    return view('tugas.edit', compact('tugas'));
}

    public function update(Request $request, Tugas $tugas)
    {
        $this->cekPengelola();

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'nullable|date',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,mp4,webm,mov,avi,jpg,jpeg,png|max:51200',
        ]);

        if ($request->hasFile('file_materi')) {
            if ($tugas->file_materi) {
                Storage::disk('public')->delete($tugas->file_materi);
            }

            $data['file_materi'] = $request->file('file_materi')
                ->store('materi-tugas', 'public');
        }

        $tugas->update($data);

        return redirect()
            ->route('tugas.index')
            ->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Tugas $tugas)
    {
        $this->cekPengelola();

        if ($tugas->file_materi) {
            Storage::disk('public')->delete($tugas->file_materi);
        }

        $tugas->delete();

        return redirect()
            ->route('tugas.index')
            ->with('success', 'Tugas berhasil dihapus.');
    }
}