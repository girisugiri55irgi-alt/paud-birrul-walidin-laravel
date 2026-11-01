<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    // Menampilkan daftar evaluasi
    public function index()
    {
        $user = auth()->user();

        $query = Evaluasi::with(['siswa', 'tahunAjaran'])
            ->latest();

        if ($user->role === 'orang_tua') {

            // Orang tua hanya melihat evaluasi anak yang terhubung
            $siswa = $user->siswa;

            if (!$siswa) {
                $evaluasis = collect();
            } else {
                $evaluasis = $query
                    ->where('siswa_id', $siswa->id)
                    ->get();
            }

        } else {
            // Administrator dan pendidik melihat seluruh evaluasi
            $evaluasis = $query->get();
        }

        return view('evaluasi.index', compact('evaluasis'));
    }


    // Menampilkan form tambah evaluasi
    public function create()
    {
        $user = auth()->user();

        // Hanya administrator dan pendidik yang boleh menambah
        if (!in_array($user->role, ['administrator', 'pendidik'])) {
            abort(403, 'Anda tidak memiliki izin menambah evaluasi.');
        }

        $siswas = Siswa::orderBy('nama')->get();

        $tahunAjarans = TahunAjaran::orderBy(
            'tanggal_mulai',
            'desc'
        )->get();

        return view(
            'evaluasi.create',
            compact('siswas', 'tahunAjarans')
        );
    }


    // Menyimpan evaluasi baru
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!in_array($user->role, ['administrator', 'pendidik'])) {
            abort(403, 'Anda tidak memiliki izin menyimpan evaluasi.');
        }

        $data = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'tanggal_penilaian' => 'required|date',
            'agama_moral' => 'nullable|string',
            'kognitif' => 'nullable|string',
            'motorik' => 'nullable|string',
            'sosial_emosional' => 'nullable|string',
            'catatan_guru' => 'nullable|string',
        ]);

        Evaluasi::create($data);

        return redirect()
            ->route('evaluasi.index')
            ->with('success', 'Evaluasi anak berhasil disimpan.');
    }


    // Menampilkan detail evaluasi
    public function show(Evaluasi $evaluasi)
    {
        $user = auth()->user();

        // Memuat data siswa dan tahun ajaran
        $evaluasi->load(['siswa', 'tahunAjaran']);

        // Orang tua hanya boleh melihat evaluasi anaknya sendiri
        if ($user->role === 'orang_tua') {

            $siswa = $user->siswa;

            if (!$siswa || $evaluasi->siswa_id != $siswa->id) {
                abort(403, 'Anda tidak memiliki akses melihat evaluasi ini.');
            }
        }

        return view('evaluasi.show', compact('evaluasi'));
    }


    // Menampilkan form edit evaluasi
    public function edit(Evaluasi $evaluasi)
    {
        $user = auth()->user();

        if (!in_array($user->role, ['administrator', 'pendidik'])) {
            abort(403, 'Anda tidak memiliki izin mengedit evaluasi.');
        }

        $siswas = Siswa::orderBy('nama')->get();

        $tahunAjarans = TahunAjaran::orderBy(
            'tanggal_mulai',
            'desc'
        )->get();

        return view(
            'evaluasi.edit',
            compact('evaluasi', 'siswas', 'tahunAjarans')
        );
    }


    // Memproses perubahan evaluasi
    public function update(Request $request, Evaluasi $evaluasi)
    {
        $user = auth()->user();

        if (!in_array($user->role, ['administrator', 'pendidik'])) {
            abort(403, 'Anda tidak memiliki izin memperbarui evaluasi.');
        }

        $data = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'tanggal_penilaian' => 'required|date',
            'agama_moral' => 'nullable|string',
            'kognitif' => 'nullable|string',
            'motorik' => 'nullable|string',
            'sosial_emosional' => 'nullable|string',
            'catatan_guru' => 'nullable|string',
        ]);

        $evaluasi->update($data);

        return redirect()
            ->route('evaluasi.index')
            ->with('success', 'Evaluasi anak berhasil diperbarui.');
    }
}