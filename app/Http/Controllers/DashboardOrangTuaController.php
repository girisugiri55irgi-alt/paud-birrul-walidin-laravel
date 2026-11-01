<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use Illuminate\Http\Request;

class DashboardOrangTuaController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Hanya mengambil anak yang terhubung dengan akun orang tua.
        $siswa = $user->siswa;

        $evaluasis = collect();

        if ($siswa) {
            $evaluasis = Evaluasi::with('tahunAjaran')
                ->where('siswa_id', $siswa->id)
                ->orderBy('tanggal_penilaian')
                ->get();
        }

        // Skala visual kategori perkembangan PAUD.
        // Nilai asli tetap disimpan dan ditampilkan apa adanya.
        $skalaKategori = [
            'BB' => 1,
            'MB' => 2,
            'BSH' => 3,
            'BSB' => 4,
        ];

        $ubahKeSkala = function ($nilai) use ($skalaKategori) {
            if ($nilai === null || trim((string) $nilai) === '') {
                return null;
            }

            $teks = strtoupper(trim((string) $nilai));

            if (isset($skalaKategori[$teks])) {
                return $skalaKategori[$teks];
            }

            // Jika penilaian berupa angka, gunakan angka tersebut.
            if (is_numeric($teks)) {
                return (float) $teks;
            }

            // Kategori yang belum dikenal tidak digambarkan sebagai angka.
            return null;
        };

        $grafikEvaluasi = [
            'labels' => $evaluasis->map(function ($evaluasi) {
                return $evaluasi->tanggal_penilaian
                    ? $evaluasi->tanggal_penilaian->format('d/m/Y')
                    : '-';
            })->values(),

            'kognitif' => $evaluasis->map(
                fn ($e) => $ubahNilai = $ubahKeSkala($e->kognitif)
            )->values(),

            'motorik' => $evaluasis->map(
                fn ($e) => $ubahNilai = $ubahKeSkala($e->motorik)
            )->values(),

            'sosial_emosional' => $evaluasis->map(
                fn ($e) => $ubahNilai = $ubahKeSkala($e->sosial_emosional)
            )->values(),

            'agama_moral' => $evaluasis->map(
                fn ($e) => $ubahNilai = $ubahKeSkala($e->agama_moral)
            )->values(),
        ];

        return view('dashboard-orangtua', compact(
            'siswa',
            'evaluasis',
            'grafikEvaluasi'
        ));
    }
}