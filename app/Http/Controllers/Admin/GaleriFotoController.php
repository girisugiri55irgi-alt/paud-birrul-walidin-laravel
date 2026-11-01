<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriFotoController extends Controller
{
    public function index()
    {
        $galeris = GaleriFoto::latest()->paginate(10);

        return view('admin.konten.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.konten.galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_published' => 'nullable|boolean',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['foto'] = $request->file('foto')
            ->store('galeri', 'public');

        $validated['is_published'] = $request->boolean('is_published');
        $validated['urutan'] = $request->input('urutan', 0);
        $validated['user_id'] = auth()->id();

        GaleriFoto::create($validated);

        return redirect()
            ->route('admin.konten.galeri.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function show(GaleriFoto $galeri)
    {
        return redirect()->route('admin.konten.galeri.edit', $galeri);
    }

    public function edit(GaleriFoto $galeri)
    {
        return view('admin.konten.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, GaleriFoto $galeri)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_published' => 'nullable|boolean',
            'urutan' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            if ($galeri->foto) {
                Storage::disk('public')->delete($galeri->foto);
            }

            $validated['foto'] = $request->file('foto')
                ->store('galeri', 'public');
        }

        $validated['is_published'] = $request->boolean('is_published');
        $validated['urutan'] = $request->input('urutan', 0);

        $galeri->update($validated);

        return redirect()
            ->route('admin.konten.galeri.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(GaleriFoto $galeri)
    {
        if ($galeri->foto) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect()
            ->route('admin.konten.galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}