<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Orang Tua - TK PAUD Birrul Walidain</title>

    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f0f5ff;
            color: #243247;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, #0d47a1, #1976d2);
        }

        .hero {
            background: linear-gradient(120deg, #0d47a1, #2196f3);
            color: white;
            border-radius: 18px;
            padding: 28px;
        }

        .panel {
            background: white;
            border: 0;
            border-radius: 15px;
            box-shadow: 0 4px 18px rgba(13, 71, 161, .07);
        }

        .school-logo {
            width: 42px;
            height: 42px;
            object-fit: contain;
            border-radius: 50%;
            background: white;
            padding: 3px;
            margin-right: 10px;
        }

        .btn-outline-success {
            color: #1565c0;
            border-color: #1565c0;
        }

        .btn-outline-success:hover {
            background: #1565c0;
            border-color: #1565c0;
            color: white;
        }

        .table thead th {
            background: #e3edff;
            color: #0d47a1;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .section-title {
            font-weight: 700;
            color: #0d47a1;
        }

        .table th {
            white-space: nowrap;
        }

        .chart-container {
            position: relative;
            width: 100%;
            max-width: 650px;
            height: 420px;
            margin: 0 auto;
        }

        @media (max-width: 576px) {
            .chart-container {
                height: 340px;
            }

            .hero {
                padding: 22px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark">
    <div class="container">
        <a href="{{ route('orangtua.dashboard') }}" class="navbar-brand fw-bold d-flex align-items-center">
            <img src="{{ asset('images/logo1.jpeg') }}" alt="Logo TK PAUD Birrul Walidain" class="school-logo"
                 onerror="this.style.display='none'">
            <span>TK PAUD Birrul Walidain<br><small class="fw-normal">Portal Orang Tua/Wali</small></span>
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-light btn-sm" type="submit"><i class="bi bi-box-arrow-right me-1"></i>Keluar</button>
        </form>
    </div>
</nav>

<div class="container py-4 py-lg-5">

    <div class="hero mb-4">
        <h2 class="fw-bold">Dashboard Orang Tua</h2>
        <p class="mb-0">
            Selamat datang, {{ auth()->user()->name }}.
            Pantau perkembangan dan kegiatan belajar anak Anda di sini.
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (!$siswa)

        <div class="alert alert-warning panel p-4">
            <h5 class="fw-bold">Data anak belum terhubung</h5>
            <p class="mb-0">
                Akun orang tua ini belum terhubung dengan data siswa.
                Silakan hubungi administrator sekolah untuk memeriksa
                hubungan akun orang tua dengan data anak.
            </p>
        </div>

    @else

        <!-- IDENTITAS ANAK -->
        <div class="panel p-4 mb-4">
            <h5 class="section-title mb-3">Identitas Anak</h5>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="text-secondary small">Nama anak</div>
                    <div class="fw-bold">{{ $siswa->nama }}</div>
                </div>

                <div class="col-md-4">
                    <div class="text-secondary small">NIS</div>
                    <div class="fw-bold">{{ $siswa->nis ?: '-' }}</div>
                </div>

                <div class="col-md-4">
                    <div class="text-secondary small">Kelas</div>
                    <div class="fw-bold">{{ $siswa->kelas ?: '-' }}</div>
                </div>

                <div class="col-md-4">
                    <div class="text-secondary small">Tanggal lahir</div>
                    <div class="fw-bold">
                        {{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d-m-Y') : '-' }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="text-secondary small">Nama orang tua</div>
                    <div class="fw-bold">
                        {{ $siswa->nama_orang_tua ?: auth()->user()->name }}
                    </div>
                </div>
            </div>
        </div>

        <!-- RINGKASAN EVALUASI -->
        <div class="row g-3 mb-4">

            <div class="col-md-4">
                <div class="panel p-4 h-100">
                    <div class="text-secondary">Jumlah evaluasi</div>
                    <div class="stat-number text-success">
                        {{ $evaluasis->count() }}
                    </div>
                    <small class="text-secondary">
                        Catatan penilaian yang tersedia
                    </small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel p-4 h-100">
                    <div class="text-secondary">Evaluasi terbaru</div>
                    <div class="stat-number">
                        {{ $evaluasis->last()?->tanggal_penilaian?->format('d-m-Y') ?? '-' }}
                    </div>
                    <small class="text-secondary">
                        Tanggal penilaian terakhir
                    </small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel p-4 h-100">
                    <div class="text-secondary">Tahun ajaran</div>
                    <div class="stat-number">
                        {{ $evaluasis->last()?->tahunAjaran?->nama ?? '-' }}
                    </div>
                    <small class="text-secondary">
                        Berdasarkan data evaluasi
                    </small>
                </div>
            </div>

        </div>

        <!-- GRAFIK RADAR -->
        <div class="panel p-4 mb-4">
            <h5 class="section-title mb-2">
                Grafik Radar Perkembangan Anak
            </h5>

            <p class="text-secondary small">
                Grafik menggunakan hasil evaluasi terbaru pada setiap aspek.
                BB = 1, MB = 2, BSH = 3, dan BSB = 4.
            </p>

            @if ($evaluasis->isEmpty())

                <div class="alert alert-info mb-0">
                    Belum ada evaluasi untuk anak ini. Grafik radar akan
                    muncul setelah pendidik memasukkan data penilaian.
                </div>

            @else

                <div class="chart-container">
                    <canvas id="grafikPerkembangan"></canvas>
                </div>

                <div class="text-center text-secondary small mt-2">
                    Semakin jauh titik dari pusat grafik, semakin tinggi
                    nilai kategori penilaiannya.
                </div>

            @endif
        </div>

        <!-- LAPORAN EVALUASI -->
        <div class="panel p-4 mb-4">
            <h5 class="section-title mb-3">Laporan Evaluasi Belajar</h5>

            @if ($evaluasis->isEmpty())

                <p class="text-secondary mb-0">
                    Belum ada laporan evaluasi yang tersedia.
                </p>

            @else

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Tahun Ajaran</th>
                                <th>Agama &amp; Moral</th>
                                <th>Kognitif</th>
                                <th>Motorik</th>
                                <th>Sosial Emosional</th>
                                <th>Catatan Guru</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($evaluasis->sortByDesc('tanggal_penilaian') as $evaluasi)
                                <tr>
                                    <td>
                                        {{ $evaluasi->tanggal_penilaian?->format('d-m-Y') ?? '-' }}
                                    </td>
                                    <td>{{ $evaluasi->tahunAjaran?->nama ?? '-' }}</td>
                                    <td>{{ $evaluasi->agama_moral ?: '-' }}</td>
                                    <td>{{ $evaluasi->kognitif ?: '-' }}</td>
                                    <td>{{ $evaluasi->motorik ?: '-' }}</td>
                                    <td>{{ $evaluasi->sosial_emosional ?: '-' }}</td>
                                    <td>{{ $evaluasi->catatan_guru ?: '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            @endif
        </div>

    @endif

    <!-- MENU ORANG TUA -->
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="panel p-4 h-100">
                <h5 class="section-title">Materi Pembelajaran</h5>
                <p class="text-secondary">
                    Lihat materi yang disediakan sekolah.
                </p>
                <a href="{{ route('materi') }}"
                   class="btn btn-outline-success">
                    Lihat Materi
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel p-4 h-100">
                <h5 class="section-title">Tugas Anak</h5>
                <p class="text-secondary">
                    Lihat daftar tugas pembelajaran.
                </p>
                <a href="{{ route('pengumpulan-tugas.index') }}"
                   class="btn btn-outline-success">
                    Lihat Tugas
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel p-4 h-100">
                <h5 class="section-title">Laporan Evaluasi</h5>
                <p class="text-secondary">
                    Buka halaman laporan evaluasi anak.
                </p>
                <a href="{{ route('evaluasi.index') }}"
                   class="btn btn-outline-success">
                    Lihat Evaluasi
                </a>
            </div>
        </div>

    </div>

    <footer class="text-center text-secondary small py-3">
        &copy; {{ date('Y') }} TK PAUD Birrul Walidain
    </footer>

</div>

<!-- CHART.JS: GRAFIK RADAR -->
@if (isset($grafikEvaluasi) && $evaluasis->isNotEmpty())

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const dataGrafik = @json($grafikEvaluasi);

    // Mengambil nilai terakhir yang tersedia untuk setiap aspek.
    function nilaiTerakhir(nilai) {
        if (!Array.isArray(nilai)) {
            return null;
        }

        for (let i = nilai.length - 1; i >= 0; i--) {
            if (
                nilai[i] !== null &&
                nilai[i] !== '' &&
                Number.isFinite(Number(nilai[i]))
            ) {
                return Number(nilai[i]);
            }
        }

        return null;
    }

    const elemenGrafik = document.getElementById('grafikPerkembangan');

    if (elemenGrafik) {
        new Chart(elemenGrafik, {
            type: 'radar',

            data: {
                labels: [
                    'Kognitif',
                    'Motorik',
                    'Sosial Emosional',
                    'Agama & Moral'
                ],

                datasets: [{
                    label: 'Perkembangan Anak',
                    data: [
                        nilaiTerakhir(dataGrafik.kognitif),
                        nilaiTerakhir(dataGrafik.motorik),
                        nilaiTerakhir(dataGrafik.sosial_emosional),
                        nilaiTerakhir(dataGrafik.agama_moral)
                    ],

                    backgroundColor: 'rgba(54, 162, 235, 0.20)',
                    borderColor: 'rgb(54, 162, 235)',
                    pointBackgroundColor: 'rgb(54, 162, 235)',
                    pointBorderColor: '#ffffff',
                    pointHoverBackgroundColor: '#ffffff',
                    pointHoverBorderColor: 'rgb(54, 162, 235)',
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    spanGaps: true
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                scales: {
                    r: {
                        beginAtZero: true,
                        min: 0,
                        max: 4,

                        ticks: {
                            stepSize: 1,
                            backdropColor: 'transparent',
                            callback: function(value) {
                                return ({
                                    1: 'BB',
                                    2: 'MB',
                                    3: 'BSH',
                                    4: 'BSB'
                                })[value] ?? value;
                            }
                        },

                        pointLabels: {
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            color: '#26324a'
                        },

                        grid: {
                            color: 'rgba(13, 71, 161, 0.12)'
                        },

                        angleLines: {
                            color: 'rgba(13, 71, 161, 0.18)'
                        }
                    }
                },

                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    },

                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const namaKategori = {
                                    1: 'BB',
                                    2: 'MB',
                                    3: 'BSH',
                                    4: 'BSB'
                                };

                                const nilai = context.raw;

                                if (nilai === null || nilai === undefined) {
                                    return context.label + ': Belum dinilai';
                                }

                                return context.label + ': ' +
                                    (namaKategori[nilai] ?? nilai);
                            }
                        }
                    }
                }
            }
        });
    }
</script>

@endif

</body>
</html>