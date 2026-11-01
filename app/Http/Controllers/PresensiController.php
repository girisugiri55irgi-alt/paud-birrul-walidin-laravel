<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PresensiController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(
            in_array(auth()->user()->role, ['pendidik', 'administrator']),
            403,
            'Anda tidak memiliki akses ke presensi.'
        );

        $request->validate([
            'tanggal' => ['nullable', 'date'],
        ]);

        $tanggal = $request->input('tanggal', now()->toDateString());

        $siswas = Siswa::orderBy('nama')->get();

        $presensis = Presensi::whereDate('tanggal', $tanggal)
            ->get()
            ->keyBy('siswa_id');

        return view('presensi.index', compact(
            'tanggal',
            'siswas',
            'presensis'
        ));
    }

    public function store(Request $request)
    {
        abort_unless(
            in_array(auth()->user()->role, ['pendidik', 'administrator']),
            403,
            'Anda tidak memiliki akses untuk menyimpan presensi.'
        );

        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'status' => ['required', 'array'],
            'status.*' => [
                'required',
                Rule::in(['Hadir', 'Izin', 'Sakit', 'Alpa']),
            ],
            'keterangan' => ['nullable', 'array'],
            'keterangan.*' => ['nullable', 'string', 'max:1000'],
        ]);

        $siswaIds = Siswa::whereIn(
            'id',
            array_keys($validated['status'])
        )->pluck('id')->all();

        if (count($siswaIds) !== count($validated['status'])) {
            return back()
                ->withErrors(['status' => 'Data siswa tidak valid.'])
                ->withInput();
        }

        DB::transaction(function () use ($validated, $siswaIds) {
            foreach ($siswaIds as $siswaId) {
                Presensi::updateOrCreate(
                    [
                        'siswa_id' => $siswaId,
                        'tanggal' => $validated['tanggal'],
                    ],
                    [
                        'status' => $validated['status'][$siswaId],
                        'keterangan' => $validated['keterangan'][$siswaId] ?? null,
                    ]
                );
            }
        });

        return redirect()
            ->route('presensi.index', [
                'tanggal' => $validated['tanggal'],
            ])
            ->with('success', 'Presensi harian berhasil disimpan.');
    }
}