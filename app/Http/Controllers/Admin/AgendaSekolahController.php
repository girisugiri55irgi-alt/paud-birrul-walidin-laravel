<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgendaSekolah;
use Illuminate\Http\Request;

class AgendaSekolahController extends Controller
{
    public function index()
    {
        $agendas = AgendaSekolah::latest('tanggal_mulai')
            ->paginate(10);

        return view('admin.konten.agenda.index', compact('agendas'));
    }

    public function create()
    {
        return view('admin.konten.agenda.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'nullable|string|max:255',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $validated['user_id'] = auth()->id();

        AgendaSekolah::create($validated);

        return redirect()
            ->route('admin.konten.agenda.index')
            ->with('success', 'Kegiatan sekolah berhasil ditambahkan.');
    }

    public function show(AgendaSekolah $agenda)
    {
        return redirect()->route('admin.konten.agenda.edit', $agenda);
    }

    public function edit(AgendaSekolah $agenda)
    {
        return view('admin.konten.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, AgendaSekolah $agenda)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'nullable|string|max:255',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        $agenda->update($validated);

        return redirect()
            ->route('admin.konten.agenda.index')
            ->with('success', 'Kegiatan sekolah berhasil diperbarui.');
    }

    public function destroy(AgendaSekolah $agenda)
    {
        $agenda->delete();

        return redirect()
            ->route('admin.konten.agenda.index')
            ->with('success', 'Kegiatan sekolah berhasil dihapus.');
    }
}