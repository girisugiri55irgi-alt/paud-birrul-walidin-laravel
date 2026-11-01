 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Evaluasi Anak - PAUD Birrul Walidain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f5ff; font-family: Arial, sans-serif; color: #243247; }
        .navbar-custom { background: linear-gradient(135deg, #0d47a1, #1976d2); }
        .school-logo { width: 45px; height: 45px; object-fit: contain; background: white; border-radius: 50%; padding: 3px; }
        .page-title { color: #0d47a1; font-weight: 700; }
        .card { border: none; border-radius: 14px; box-shadow: 0 4px 18px rgba(13,71,161,.08); }
        .section-title { color: #0d47a1; font-weight: 700; }
        .label-data { color: #718096; font-size: 13px; }
        .value-data { font-weight: 600; }
        .evaluation-box { background: #f7faff; border: 1px solid #e1ebfa; border-radius: 10px; padding: 16px; height: 100%; }
    </style>
</head>
<body>

@php
    $role = auth()->user()->role;

    if ($role === 'pendidik') {
        $dashboardRoute = route('pendidik.dashboard');
        $dashboardLabel = '← Dashboard Guru';
    } elseif ($role === 'orang_tua') {
        $dashboardRoute = route('orangtua.dashboard');
        $dashboardLabel = '← Dashboard Orang Tua';
    } else {
        $dashboardRoute = route('dashboard');
        $dashboardLabel = '← Dashboard Admin';
    }
@endphp

<nav class="navbar navbar-dark navbar-custom shadow-sm">
    <div class="container-fluid px-3 px-md-4">
        <a class="navbar-brand d-flex align-items-center gap-3" href="{{ $dashboardRoute }}">
            <img src="{{ asset('images/logo1.jpeg') }}" class="school-logo" alt="Logo Sekolah">
            <span>
                <strong>PAUD Birrul Walidain</strong>
                <small class="d-block text-white-50">Sistem Monitoring Perkembangan Anak</small>
            </span>
        </a>
        <a href="{{ route('evaluasi.index') }}" class="btn btn-light btn-sm text-primary fw-semibold">
            ← Kembali ke Daftar Evaluasi
        </a>
    </div>
</nav>

<main class="container py-4">

    <div class="mb-4">
        <h2 class="page-title mb-1">Detail Evaluasi Anak</h2>
        <p class="text-secondary mb-0">Informasi hasil pemantauan perkembangan dan belajar anak.</p>
    </div>

    <div class="card mb-4">
        <div class="card-body p-4">
            <h5 class="section-title mb-3">Identitas Anak</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="label-data">Nama Anak</div>
                    <div class="value-data">{{ $evaluasi->siswa->nama ?? '-' }}</div>
                </div>
                <div class="col-md-6">
                    <div class="label-data">Kelas</div>
                    <div class="value-data">{{ $evaluasi->siswa->kelas ?? '-' }}</div>
                </div>
                <div class="col-md-6">
                    <div class="label-data">Tahun Ajaran</div>
                    <div class="value-data">{{ $evaluasi->tahunAjaran->nama_tahun_ajaran ?? '-' }}</div>
                </div>
                <div class="col-md-6">
                    <div class="label-data">Tanggal Penilaian</div>
                    <div class="value-data">
                        {{ $evaluasi->tanggal_penilaian ? \Carbon\Carbon::parse($evaluasi->tanggal_penilaian)->format('d-m-Y') : '-' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body p-4">
            <h5 class="section-title mb-3">Hasil Evaluasi Perkembangan</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="evaluation-box">
                        <h6 class="fw-bold">Agama dan Moral</h6>
                        <p class="mb-0">{{ $evaluasi->agama_moral ?: 'Belum ada catatan evaluasi.' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="evaluation-box">
                        <h6 class="fw-bold">Kognitif</h6>
                        <p class="mb-0">{{ $evaluasi->kognitif ?: 'Belum ada catatan evaluasi.' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="evaluation-box">
                        <h6 class="fw-bold">Motorik</h6>
                        <p class="mb-0">{{ $evaluasi->motorik ?: 'Belum ada catatan evaluasi.' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="evaluation-box">
                        <h6 class="fw-bold">Sosial Emosional</h6>
                        <p class="mb-0">{{ $evaluasi->sosial_emosional ?: 'Belum ada catatan evaluasi.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body p-4">
            <h5 class="section-title mb-3">Catatan Pendidik</h5>
            <p class="mb-0">{{ $evaluasi->catatan_guru ?: 'Belum ada catatan dari pendidik.' }}</p>
        </div>
    </div>

    @if(in_array($role, ['administrator', 'pendidik']))
        <div class="text-end mb-4">
            <a href="{{ route('evaluasi.edit', $evaluasi->id) }}" class="btn btn-warning px-4">
                Edit Evaluasi
            </a>
        </div>
    @endif

    <footer class="text-center text-secondary small py-3">
        © {{ date('Y') }} PAUD Birrul Walidain
    </footer>
</main>
</body>
</html>