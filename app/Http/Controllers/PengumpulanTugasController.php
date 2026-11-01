<?php

namespace App\Http\Controllers;

use App\Models\PengumpulanTugas;
use App\Models\Siswa;
use App\Models\Tugas;
use Illuminate\Http\Request;

class PengumpulanTugasController extends Controller
{
    private function cekOrangTua(): void
    {
        abort_unless(
            auth()->check() &&
            auth()->user()->role === 'orang_tua',
            403,
            'Fitur ini hanya untuk akun orang tua.'
        );
    }

    private function siswaOrangTua(): Siswa
    {
        $siswa = Siswa::where('user_id', auth()->id())->first();

        abort_if(
            !$siswa,
            403,
            'Akun orang tua belum dihubungkan dengan data siswa. Silakan hubungi administrator.'
        );

        return $siswa;
    }

    public function index()
    {
        $this->cekOrangTua();

        $siswa = $this->siswaOrangTua();

        $tugas = Tugas::orderByDesc('created_at')->get();

        $pengumpulan = PengumpulanTugas::where(
            'siswa_id',
            $siswa->id
        )->with('tugas')->latest()->get();

        return view(
            'pengumpulan-tugas.index',
            compact('siswa', 'tugas', 'pengumpulan')
        );
    }

    public function create(Tugas $tugas)
    {
        $this->cekOrangTua();

        $siswa = $this->siswaOrangTua();

        $sudahMengumpulkan = PengumpulanTugas::where(
            'tugas_id',
            $tugas->id
        )->where('siswa_id', $siswa->id)->exists();

        abort_if(
            $sudahMengumpulkan,
            403,
            'Tugas ini sudah dikumpulkan oleh akun Anda.'
        );

        return view(
            'pengumpulan-tugas.create',
            compact('siswa', 'tugas')
        );
    }

    public function store(Request $request, Tugas $tugas)
    {
        $this->cekOrangTua();

        $siswa = $this->siswaOrangTua();

        $sudahMengumpulkan = PengumpulanTugas::where(
            'tugas_id',
            $tugas->id
        )->where('siswa_id', $siswa->id)->exists();

        abort_if(
            $sudahMengumpulkan,
            403,
            'Tugas ini sudah dikumpulkan oleh akun Anda.'
        );

        $data = $request->validate([
            'jawaban' => 'nullable|string|max:10000',
            'file_jawaban' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        if (
            empty($data['jawaban']) &&
            !$request->hasFile('file_jawaban')
        ) {
            return back()
                ->withErrors([
                    'jawaban' => 'Isi jawaban atau unggah berkas tugas terlebih dahulu.',
                ])
                ->withInput();
        }

        if ($request->hasFile('file_jawaban')) {
            $data['file_jawaban'] = $request
                ->file('file_jawaban')
                ->store('pengumpulan-tugas', 'public');
        }

        $data['tugas_id'] = $tugas->id;
        $data['user_id'] = auth()->id();
        $data['siswa_id'] = $siswa->id;
        $data['status'] = 'menunggu';
        $data['dikumpulkan_pada'] = now();

        PengumpulanTugas::create($data);

        return redirect()
            ->route('pengumpulan-tugas.index')
            ->with('success', 'Tugas anak berhasil dikumpulkan.');
    }
}