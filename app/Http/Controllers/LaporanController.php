<?php
namespace App\Http\Controllers;

use App\Models\Evaluasi;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $siswas = Siswa::orderBy('nama')->get();

        $evaluasis = Evaluasi::with(['siswa', 'tahunAjaran'])
            ->orderByDesc('tanggal_penilaian')
            ->get();

        $tahunAktif = TahunAjaran::orderByDesc('tanggal_mulai')
            ->first();

        $siswaId = $request->query('siswa_id');

        if ($siswaId && $siswas->contains('id', (int) $siswaId)) {
            $evaluasiTerpilih = Evaluasi::with(['siswa', 'tahunAjaran'])
                ->where('siswa_id', $siswaId)
                ->orderByDesc('tanggal_penilaian')
                ->first();
        } else {
            $evaluasiTerpilih = Evaluasi::with(['siswa', 'tahunAjaran'])
                ->orderByDesc('tanggal_penilaian')
                ->first();
        }

        $skala = [
            'BB' => 1,
            'MB' => 2,
            'BSH' => 3,
            'BSB' => 4,
        ];

        $kategori = [
            'agama_moral' => 'Agama dan Moral',
            'kognitif' => 'Kognitif',
            'motorik' => 'Motorik',
            'sosial_emosional' => 'Sosial-Emosional',
        ];

        $chartLabels = array_values($kategori);
        $chartValues = [];
        $ringkasan = [];

        foreach ($kategori as $kolom => $label) {
            $nilai = strtoupper(trim(
                (string) ($evaluasiTerpilih?->{$kolom} ?? '')
            ));

            $kode = preg_match('/\b(BB|MB|BSH|BSB)\b/', $nilai, $match)
                ? $match[1]
                : null;

            $chartValues[] = $skala[$kode] ?? 0;

            $keterangan = [
                'BB' => 'Belum Berkembang',
                'MB' => 'Mulai Berkembang',
                'BSH' => 'Berkembang Sesuai Harapan',
                'BSB' => 'Berkembang Sangat Baik',
            ];

            $ringkasan[] = [
                'label' => $label,
                'kode' => $kode ?? 'Belum dinilai',
                'keterangan' => $keterangan[$kode] ?? 'Belum ada kategori penilaian',
            ];
        }

        return view('laporan.index', compact(
            'siswas',
            'evaluasis',
            'tahunAktif',
            'evaluasiTerpilih',
            'chartLabels',
            'chartValues',
            'ringkasan'
        ));
    }
}