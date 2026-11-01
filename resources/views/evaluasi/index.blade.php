<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Evaluasi Anak - PAUD Birrul Walidain</title>

    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #f0f5ff;
            font-family: Arial, sans-serif;
            color: #243247;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #0d47a1, #1976d2);
        }

        .school-logo {
            width: 45px;
            height: 45px;
            object-fit: contain;
            background: white;
            border-radius: 50%;
            padding: 3px;
        }

        .page-title {
            color: #0d47a1;
            font-weight: 700;
        }

        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(13, 71, 161, 0.08);
        }

        .table thead th {
            background: #e3edff;
            color: #0d47a1;
            white-space: nowrap;
            vertical-align: middle;
        }

        .table tbody td {
            vertical-align: middle;
        }

        .btn-primary {
            background: #1565c0;
            border-color: #1565c0;
        }

        .btn-primary:hover {
            background: #0d47a1;
            border-color: #0d47a1;
        }

        .btn-detail {
            background: #0d6efd;
            color: white;
            border: none;
        }

        .btn-detail:hover {
            background: #0b5ed7;
            color: white;
        }

        .table-responsive {
            border-radius: 10px;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 6px;
            flex-wrap: wrap;
        }
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

<!-- NAVBAR -->
<nav class="navbar navbar-dark navbar-custom shadow-sm">
    <div class="container-fluid px-3 px-md-4">

        <a class="navbar-brand d-flex align-items-center gap-3"
           href="{{ $dashboardRoute }}">

            <img src="{{ asset('images/logo1.jpeg') }}"
                 alt="Logo PAUD Birrul Walidain"
                 class="school-logo"
                 onerror="this.style.display='none'">

            <span>
                <strong>PAUD Birrul Walidain</strong>
                <small class="d-block text-white-50">
                    Sistem Monitoring Perkembangan Anak
                </small>
            </span>
        </a>

        <a href="{{ $dashboardRoute }}"
           class="btn btn-light btn-sm text-primary fw-semibold">
            {{ $dashboardLabel }}
        </a>

    </div>
</nav>


<!-- KONTEN UTAMA -->
<main class="container-fluid px-3 px-md-4 py-4">

    <!-- JUDUL DAN TOMBOL TAMBAH -->
    <div class="d-flex flex-column flex-md-row justify-content-between
                align-items-md-center gap-3 mb-4">

        <div>
            <h2 class="page-title mb-1">Daftar Evaluasi Anak</h2>

            <p class="text-secondary mb-0">
                Monitoring perkembangan dan evaluasi belajar
                anak PAUD Birrul Walidain.
            </p>
        </div>

        @if(in_array($role, ['administrator', 'pendidik']))
            <a href="{{ route('evaluasi.create') }}"
               class="btn btn-primary px-4 py-2">
                + Tambah Evaluasi
            </a>
        @endif

    </div>


    <!-- NOTIFIKASI BERHASIL -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Tutup">
            </button>
        </div>
    @endif


    <!-- NOTIFIKASI KESALAHAN -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show"
             role="alert">

            <strong>Terjadi kesalahan:</strong>
            {{ $errors->first() }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Tutup">
            </button>
        </div>
    @endif


    <!-- TABEL EVALUASI -->
    <div class="card">

        <div class="card-header bg-white border-0 pt-4 px-4">

            <div class="d-flex justify-content-between
                        align-items-center flex-wrap gap-2">

                <h5 class="mb-0 fw-bold">Data Evaluasi Anak</h5>

                <span class="badge text-bg-primary">
                    Total: {{ $evaluasis->count() }} evaluasi
                </span>

            </div>

        </div>


        <div class="card-body p-3 p-md-4">

            <div class="table-responsive">

                <table class="table table-hover table-bordered
                              align-middle mb-0">

                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Anak</th>
                            <th>Kelas</th>
                            <th>Tahun Ajaran</th>
                            <th>Tanggal Penilaian</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>


                    <tbody>

                    @forelse($evaluasis as $evaluasi)

                        <tr>

                            <!-- NOMOR -->
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>


                            <!-- NAMA ANAK -->
                            <td class="fw-semibold">
                                {{ $evaluasi->siswa->nama ?? '-' }}
                            </td>


                            <!-- KELAS -->
                            <td>
                                <span class="badge"
                                      style="background:#e3edff;color:#0d47a1;">

                                    {{ $evaluasi->siswa->kelas ?? '-' }}

                                </span>
                            </td>


                            <!-- TAHUN AJARAN -->
                            <td>
                                {{ $evaluasi->tahunAjaran->nama_tahun_ajaran ?? '-' }}
                            </td>


                            <!-- TANGGAL PENILAIAN -->
                            <td>
                                @if($evaluasi->tanggal_penilaian)
                                    {{ \Carbon\Carbon::parse($evaluasi->tanggal_penilaian)->format('d-m-Y') }}
                                @else
                                    -
                                @endif
                            </td>


                            <!-- TOMBOL AKSI -->
                            <td>

                                <div class="action-buttons">

                                    <!-- DETAIL UNTUK SEMUA ROLE -->
                                    <a href="{{ route('evaluasi.show', $evaluasi->id) }}"
                                       class="btn btn-detail btn-sm">

                                        <i class="bi bi-eye"></i>
                                        Lihat Detail

                                    </a>


                                    <!-- EDIT KHUSUS ADMIN DAN PENDIDIK -->
                                    @if(in_array($role, ['administrator', 'pendidik']))

                                        <a href="{{ route('evaluasi.edit', $evaluasi->id) }}"
                                           class="btn btn-warning btn-sm">

                                            Edit

                                        </a>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center py-5">

                                <div class="text-secondary mb-2">
                                    <strong>Belum ada data evaluasi anak.</strong>
                                </div>

                                <p class="text-muted small">
                                    Data evaluasi akan ditampilkan setelah
                                    pendidik melakukan penilaian.
                                </p>

                                @if(in_array($role, ['administrator', 'pendidik']))

                                    <a href="{{ route('evaluasi.create') }}"
                                       class="btn btn-primary btn-sm">

                                        + Tambahkan Evaluasi Pertama

                                    </a>

                                @endif

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- FOOTER -->
    <footer class="text-center text-secondary small mt-4">

        © {{ date('Y') }} PAUD Birrul Walidain

        · Sistem Monitoring Perkembangan dan Evaluasi Belajar Anak

    </footer>

</main>


<!-- BOOTSTRAP JAVASCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>