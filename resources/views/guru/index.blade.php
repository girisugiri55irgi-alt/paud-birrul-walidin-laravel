<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Guru - PAUD Birrul Walidin</title>

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
            box-shadow: 0 4px 18px rgba(13, 71, 161, .08);
        }

        .table thead th {
            background: #e3edff;
            color: #0d47a1;
            white-space: nowrap;
            vertical-align: middle;
        }

        .table td {
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

        .table-responsive {
            border-radius: 10px;
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

<!-- Navbar -->
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

    <!-- Judul dan tombol tambah -->
    <div class="d-flex flex-column flex-md-row justify-content-between
                align-items-md-center gap-3 mb-4">

        <div>
            <h2 class="page-title mb-1">Data Guru PAUD</h2>
            <p class="text-secondary mb-0">
                Pengelolaan data pendidik TK PAUD Birrul Walidin.
            </p>
        </div>

        <a href="{{ route('guru.create') }}"
           class="btn btn-primary px-4 py-2">
            + Tambah Guru
        </a>
    </div>

    <!-- Notifikasi berhasil -->
    @if (session('success'))
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

    <!-- Notifikasi kesalahan -->
    @if ($errors->any())
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

    <!-- Card daftar guru -->
    <div class="card">

        <div class="card-header bg-white border-0 px-4 pt-4">
            <div class="d-flex justify-content-between
                        align-items-center flex-wrap gap-2">

                <h5 class="fw-bold mb-0">Daftar Guru</h5>

                <span class="badge text-bg-primary">
                    Total: {{ $gurus->count() }} guru
                </span>

            </div>
        </div>

        <div class="card-body p-3 p-md-4">
            <div class="table-responsive">

                <table class="table table-bordered table-hover
                              align-middle mb-0">

                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>NIP</th>
                            <th>Nama Guru</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Jabatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse ($gurus as $guru)
                        <tr>

                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td>{{ $guru->nip ?: '-' }}</td>

                            <td class="fw-semibold">
                                {{ $guru->nama }}
                            </td>

                            <td>{{ $guru->email ?: '-' }}</td>

                            <td>{{ $guru->no_telp ?: '-' }}</td>

                            <td>{{ $guru->jabatan ?: '-' }}</td>

                            <td>
                                <div class="d-flex justify-content-center
                                            gap-2">

                                    <a href="{{ route('guru.edit', $guru) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('guru.destroy', $guru) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus data guru ini?')">

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
                                    Belum ada data guru.
                                </div>

                                <a href="{{ route('guru.create') }}"
                                   class="btn btn-primary btn-sm">
                                    Tambah Guru Pertama
                                </a>

                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center text-secondary small mt-4">
        © {{ date('Y') }} PAUD Birrul Walidin
        · Sistem Monitoring Perkembangan dan Evaluasi Belajar Anak
    </footer>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>