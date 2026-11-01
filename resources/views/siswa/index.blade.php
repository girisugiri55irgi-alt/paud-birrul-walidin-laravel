<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Siswa - PAUD Birrul Walidin</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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

        .badge-kelas {
            background: #e3edff;
            color: #0d47a1;
        }

        .table-responsive {
            border-radius: 10px;
        }
    </style>
</head>
<body>

{{-- Navbar menyesuaikan role pengguna --}}
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
        $dashboardLabel = '← Dashboard Administrator';
    }
@endphp

<nav class="navbar navbar-dark navbar-custom shadow-sm">
    <div class="container-fluid px-3 px-md-4">

        <a class="navbar-brand d-flex align-items-center gap-3"
           href="{{ $dashboardRoute }}">

            <img src="{{ asset('images/logo1.jpeg') }}"
                 alt="Logo PAUD Birrul Walidin"
                 class="school-logo"
                 onerror="this.style.display='none'">

            <span>
                <strong>PAUD Birrul Walidin</strong>
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

<!-- Konten -->
<main class="container-fluid px-3 px-md-4 py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between
                align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="page-title mb-1">Data Siswa PAUD</h2>
            <p class="text-secondary mb-0">
                Pengelolaan data anak didik PAUD Birrul Walidin.
            </p>
        </div>

        <a href="{{ route('siswa.create') }}"
           class="btn btn-primary px-4 py-2">
            + Tambah Siswa
        </a>
    </div>

    <!-- Notifikasi berhasil -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show"
             role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <!-- Notifikasi kesalahan -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show"
             role="alert">
            <strong>Terjadi kesalahan:</strong>
            {{ $errors->first() }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <!-- Tabel siswa -->
    <div class="card">
        <div class="card-header bg-white border-0 pt-4 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Daftar Siswa</h5>
                <span class="badge text-bg-primary">
                    Total: {{ $siswas->count() }} siswa
                </span>
            </div>
        </div>

        <div class="card-body p-3 p-md-4">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>Kelas</th>
                            <th>Nama Orang Tua</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse ($siswas as $siswa)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td>{{ $siswa->nis }}</td>

                            <td class="fw-semibold">
                                {{ $siswa->nama }}
                            </td>

                            <td>
                                @if ($siswa->jenis_kelamin == 'Laki-laki')
                                    <span class="badge text-bg-info">
                                        Laki-laki
                                    </span>
                                @elseif ($siswa->jenis_kelamin == 'Perempuan')
                                    <span class="badge text-bg-danger">
                                        Perempuan
                                    </span>
                                @else
                                    {{ $siswa->jenis_kelamin }}
                                @endif
                            </td>

                            <td>
                                <span class="badge badge-kelas">
                                    {{ $siswa->kelas ?: '-' }}
                                </span>
                            </td>

                            <td>{{ $siswa->nama_orang_tua ?: '-' }}</td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('siswa.edit', $siswa) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('siswa.destroy', $siswa) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-secondary mb-2">
                                    Belum ada data siswa.
                                </div>
                                <a href="{{ route('siswa.create') }}"
                                   class="btn btn-primary btn-sm">
                                    Tambahkan Siswa Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="text-center text-secondary small mt-4">
        © {{ date('Y') }} PAUD Birrul Walidin
        · Sistem Monitoring Perkembangan dan Evaluasi Belajar Anak
    </footer>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>