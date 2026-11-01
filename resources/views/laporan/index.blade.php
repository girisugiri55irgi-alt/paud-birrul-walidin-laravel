<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Laporan PAUD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f7fb;
            color: #20334d;
            font-family: Arial, sans-serif;
        }

        .dashboard-title {
            font-weight: 700;
            color: #153e70;
        }

        .summary-card {
            background: #fff;
            border: 1px solid #e5eaf2;
            border-radius: 13px;
            padding: 18px;
            height: 100%;
            box-shadow: 0 3px 12px rgba(20, 50, 90, .04);
        }

        .summary-label {
            font-size: 13px;
            color: #718096;
        }

        .summary-code {
            font-size: 25px;
            font-weight: 700;
            margin: 8px 0;
        }

        .progress {
            height: 6px;
            background: #e9eef5;
        }

        .dashboard-card {
            background: white;
            border: 1px solid #e5eaf2;
            border-radius: 14px;
            box-shadow: 0 3px 12px rgba(20, 50, 90, .04);
        }

        .chart-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            height: 350px;
            margin: auto;
        }

        .section-title {
            font-weight: 700;
            color: #153e70;
        }

        @media (max-width: 576px) {
            .chart-container {
                height: 290px;
            }
        }
    </style>
</head>

<body>
<div class="container-fluid px-3 px-lg-4 py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="dashboard-title mb-1">
                Dashboard Perkembangan Anak
            </h2>
            <div class="text-secondary">
                TK PAUD Birrul Walidin
            </div>
        </div>

        {{-- Tombol kembali sesuai dengan hak akses pengguna --}}
        @auth
            @if(auth()->user()->role === 'administrator')
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    ← Kembali ke Dashboard Administrator
                </a>
            @elseif(auth()->user()->role === 'pendidik')
                <a href="{{ route('pendidik.dashboard') }}" class="btn btn-secondary">
                    ← Kembali ke Dashboard Pendidik
                </a>
            @elseif(auth()->user()->role === 'orang_tua')
                <a href="{{ route('orangtua.dashboard') }}" class="btn btn-secondary">
                    ← Kembali ke Dashboard Orang Tua
                </a>
            @else
                <a href="{{ route('beranda') }}" class="btn btn-secondary">
                    ← Kembali
                </a>
            @endif
        @endauth
    </div>

    <div class="dashboard-card p-3 mb-4">
        <div class="row align-items-end g-3">
            <div class="col-md-6">
                <label for="siswa_id" class="form-label fw-semibold">
                    Pilih Anak
                </label>

                <form method="GET" action="{{ route('laporan.index') }}">
                    <select name="siswa_id"
                            id="siswa_id"
                            class="form-select"
                            onchange="this.form.submit()">

                        <option value="">Evaluasi terbaru semua anak</option>

                        @foreach($siswas as $siswa)
                            <option value="{{ $siswa->id }}"
                                @selected((string) request('siswa_id') === (string) $siswa->id)>
                                {{ $siswa->nama }} - {{ $siswa->kelas ?: 'Belum ada kelas' }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="col-md-6">
                <div class="text-secondary small">Tahun Ajaran</div>
                <div class="fw-semibold">
                    {{ $evaluasiTerpilih?->tahunAjaran?->nama_tahun_ajaran
                        ?? $tahunAktif?->nama_tahun_ajaran
                        ?? 'Belum tersedia' }}
                </div>

                @if($evaluasiTerpilih)
                    <div class="small text-secondary mt-1">
                        Anak: {{ $evaluasiTerpilih->siswa->nama ?? '-' }}
                        · Tanggal:
                        {{ $evaluasiTerpilih->tanggal_penilaian
                            ? \Carbon\Carbon::parse($evaluasiTerpilih->tanggal_penilaian)->format('d-m-Y')
                            : '-' }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <h5 class="section-title mb-3">Ringkasan Perkembangan</h5>

    <div class="row g-3 mb-4">
        @php
            $warna = ['primary', 'warning', 'success', 'info'];
        @endphp

        @foreach($ringkasan as $index => $item)
            @php
                $skor = $chartValues[$index] ?? 0;
                $persen = $skor * 25;
            @endphp

            <div class="col-6 col-xl-3">
                <div class="summary-card">
                    <div class="summary-label">
                        {{ $item['label'] }}
                    </div>

                    <div class="summary-code text-{{ $warna[$index] }}">
                        {{ $item['kode'] }}
                    </div>

                    <div class="small text-secondary mb-3">
                        {{ $item['keterangan'] }}
                    </div>

                    <div class="progress">
                        <div class="progress-bar bg-{{ $warna[$index] }}"
                             role="progressbar"
                             style="width: {{ $persen }}%">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="dashboard-card p-3 p-lg-4 mb-4">
        <div class="mb-3">
            <h5 class="section-title mb-1">
                Visualisasi Perkembangan
            </h5>
            <div class="small text-secondary">
                Diagram radar empat aspek perkembangan anak
            </div>
        </div>

        @if($evaluasiTerpilih)
            <div class="chart-container">
                <canvas id="radarChart"></canvas>
            </div>

            <div class="text-center small text-secondary mt-2">
                Skala visualisasi: BB = 1, MB = 2, BSH = 3, BSB = 4.
                Nilai 0 berarti belum ada kategori yang dikenali.
            </div>
        @else
            <div class="alert alert-info mb-0">
                Belum ada data evaluasi. Masukkan penilaian anak terlebih dahulu.
            </div>
        @endif
    </div>

    <div class="dashboard-card p-3 p-lg-4">
        <h5 class="section-title mb-3">Tabel Laporan Perkembangan Anak</h5>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No.</th>
                        <th>Nama Anak</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Tanggal Penilaian</th>
                        <th>Agama dan Moral</th>
                        <th>Kognitif</th>
                        <th>Motorik</th>
                        <th>Sosial-Emosional</th>
                        <th>Catatan Guru</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($evaluasis as $evaluasi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $evaluasi->siswa->nama ?? '-' }}</td>
                            <td>{{ $evaluasi->siswa->kelas ?? '-' }}</td>
                            <td>
                                {{ $evaluasi->tahunAjaran->nama_tahun_ajaran ?? '-' }}
                            </td>
                            <td>
                                {{ $evaluasi->tanggal_penilaian
                                    ? \Carbon\Carbon::parse($evaluasi->tanggal_penilaian)->format('d-m-Y')
                                    : '-' }}
                            </td>
                            <td>{{ $evaluasi->agama_moral ?: '-' }}</td>
                            <td>{{ $evaluasi->kognitif ?: '-' }}</td>
                            <td>{{ $evaluasi->motorik ?: '-' }}</td>
                            <td>{{ $evaluasi->sosial_emosional ?: '-' }}</td>
                            <td>{{ $evaluasi->catatan_guru ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">
                                Belum ada data evaluasi anak.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@if($evaluasiTerpilih)
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const labels = @json($chartLabels);
        const values = @json($chartValues);

        const ctx = document.getElementById('radarChart');

        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Perkembangan Anak',
                    data: values,
                    backgroundColor: 'rgba(37, 115, 220, 0.18)',
                    borderColor: '#2573dc',
                    borderWidth: 2,
                    pointBackgroundColor: '#2573dc',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        min: 0,
                        max: 4,
                        ticks: {
                            stepSize: 1,
                            backdropColor: 'transparent'
                        },
                        pointLabels: {
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const kategori = {
                                    0: 'Belum ada penilaian',
                                    1: 'BB',
                                    2: 'MB',
                                    3: 'BSH',
                                    4: 'BSB'
                                };

                                return kategori[context.raw] ?? 'Tidak diketahui';
                            }
                        }
                    }
                }
            }
        });
    </script>
@endif

</body>
</html>