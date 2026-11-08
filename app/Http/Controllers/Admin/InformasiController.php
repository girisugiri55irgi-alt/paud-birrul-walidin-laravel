<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformasiController extends Controller
{
    public function index()
    {
        $informasis = Informasi::latest()->paginate(10);

        return view('admin.konten.informasi.index', compact('informasis'));
    }

    public function create()
    {
        return view('admin.konten.informasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal_publikasi' => 'nullable|date',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')
                ->store('informasi', 'public');
        }

        $validated['is_published'] = $request->boolean('is_published');
        $validated['user_id'] = auth()->id();

        Informasi::create($validated);

        return redirect()
            ->route('admin.konten.informasi.index')
            ->with('success', 'Informasi sekolah berhasil ditambahkan.');
    }

    public function show(Informasi $informasi)
    {
        return redirect()->route('admin.konten.informasi.edit', $informasi);
    }

    public function edit(Informasi $informasi)
    {
        return view('admin.konten.informasi.edit', compact('informasi'));
    }

    public function update(Request $request, Informasi $informasi)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal_publikasi' => 'nullable|date',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            if ($informasi->gambar) {
                Storage::disk('public')->delete($informasi->gambar);
            }

            $validated['gambar'] = $request->file('gambar')
                ->store('informasi', 'public');
        }

        $validated['is_published'] = $request->boolean('is_published');

        $informasi->update($validated);

        return redirect()
            ->route('admin.konten.informasi.index')
            ->with('success', 'Informasi sekolah berhasil diperbarui.');
    }

    public function destroy(Informasi $informasi)
    {
        if ($informasi->gambar) {
            Storage::disk('public')->delete($informasi->gambar);
        }

        $informasi->delete();

        return redirect()
            ->route('admin.konten.informasi.index')
            ->with('success', 'Informasi sekolah berhasil dihapus.');
    }
}