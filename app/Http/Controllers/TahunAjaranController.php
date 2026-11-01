<?php
namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahunAjarans = TahunAjaran::orderByDesc('nama_tahun_ajaran')->get();

        return view('tahun-ajaran.index', compact('tahunAjarans'));
    }

    public function create()
    {
        $item = new TahunAjaran();

        return view('tahun-ajaran.form', compact('item'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_tahun_ajaran' => [
                'required', 'string', 'max:20',
                'unique:tahun_ajarans,nama_tahun_ajaran'
            ],
            'tanggal_mulai' => ['nullable', 'date'],
            'tanggal_selesai' => [
                'nullable', 'date', 'after_or_equal:tanggal_mulai'
            ],
            'aktif' => ['required', 'boolean'],
        ]);

        if ($data['aktif']) {
            TahunAjaran::query()->update(['aktif' => false]);
        }

        TahunAjaran::create($data);

        return redirect()->route('tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    public function edit(TahunAjaran $tahun_ajaran)
    {
        $item = $tahun_ajaran;

        return view('tahun-ajaran.form', compact('item'));
    }

    public function update(Request $request, TahunAjaran $tahun_ajaran)
    {
        $data = $request->validate([
            'nama_tahun_ajaran' => [
                'required', 'string', 'max:20',
                Rule::unique('tahun_ajarans', 'nama_tahun_ajaran')
                    ->ignore($tahun_ajaran->id),
            ],
            'tanggal_mulai' => ['nullable', 'date'],
            'tanggal_selesai' => [
                'nullable', 'date', 'after_or_equal:tanggal_mulai'
            ],
            'aktif' => ['required', 'boolean'],
        ]);

        if ($data['aktif']) {
            TahunAjaran::where('id', '!=', $tahun_ajaran->id)
                ->update(['aktif' => false]);
        }

        $tahun_ajaran->update($data);

        return redirect()->route('tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil diperbarui.');
    }

    public function destroy(TahunAjaran $tahun_ajaran)
    {
        $tahun_ajaran->delete();

        return redirect()->route('tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil dihapus.');
    }
}