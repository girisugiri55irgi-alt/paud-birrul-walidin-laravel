<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin SPMB - TK PAUD Birrul Walidain</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background-color: #f3f6fa;
            color: #263238;
        }

        .navbar-custom {
            background-color: #0d6efd;
        }

        .content-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.07);
        }

        .table thead th {
            background-color: #eaf2ff;
            color: #24456b;
            white-space: nowrap;
            vertical-align: middle;
        }

        .table tbody td {
            vertical-align: middle;
        }

        .search-box {
            width: 300px;
            max-width: 100%;
        }

        .school-logo {
            width: 42px;
            height: 42px;
            object-fit: cover;
            border-radius: 50%;
        }

        .action-buttons {
            min-width: 190px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark navbar-custom">
    <div class="container-fluid px-3 px-lg-4">

        <a class="navbar-brand d-flex align-items-center"
           href="{{ url('/dashboard') }}">

            <img src="{{ asset('images/logo1.jpeg') }}"
                 alt="Logo Sekolah"
                 class="school-logo me-2">

            <span>TK PAUD Birrul Walidain</span>
        </a>

        <a href="{{ url('/dashboard') }}"
           class="btn btn-light btn-sm">
            &larr; Kembali ke Dashboard
        </a>

    </div>
</nav>

<div class="container-fluid px-3 px-lg-4 py-4">

    <div class="mb-4">
        <h2 class="fw-bold text-primary">Admin SPMB</h2>
        <p class="text-muted mb-0">
            Penerimaan Murid Baru TK PAUD Birrul Walidain
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Ringkasan --}}
    <div class="row g-3 mb-4">

        <div class="col-sm-6 col-lg-4">
            <div class="card content-card h-100">
                <div class="card-body">
                    <div class="text-muted small">Total Pendaftar</div>
                    <div class="fs-2 fw-bold text-primary">
                        {{ $pendaftars->total() }}
                    </div>
                    <div class="small text-muted">
                        Seluruh pendaftar SPMB
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card content-card h-100">
                <div class="card-body">
                    <div class="text-muted small">Halaman Saat Ini</div>
                    <div class="fs-2 fw-bold text-primary">
                        {{ $pendaftars->currentPage() }}
                    </div>
                    <div class="small text-muted">
                        Dari {{ $pendaftars->lastPage() }} halaman
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card content-card">
        <div class="card-body p-3 p-lg-4">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">

                <h5 class="fw-bold mb-0">Daftar Pendaftar SPMB</h5>

                <form action="{{ url('/admin/spmb') }}"
                      method="GET"
                      class="d-flex flex-wrap gap-2">

                    <input
                        type="text"
                        name="q"
                        class="form-control search-box"
                        placeholder="Cari nomor atau nama..."
                        value="{{ request('q') }}">

                    <button type="submit" class="btn btn-primary">
                        Cari
                    </button>

                    <a href="{{ url('/admin/spmb') }}"
                       class="btn btn-outline-secondary">
                        Reset
                    </a>
                </form>

            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nomor Pendaftaran</th>
                            <th>Nama Calon Murid</th>
                            <th>Nama Orang Tua</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pendaftars as $item)
                            <tr>
                                <td class="text-center">
                                    {{ $pendaftars->firstItem() + $loop->index }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $item->nomor_pendaftaran }}
                                </td>

                                <td>{{ $item->nama_calon }}</td>

                                <td>{{ $item->nama_orang_tua }}</td>

                                <td class="text-center">
                                    @if ($item->status === 'diterima')
                                        <span class="badge text-bg-success">
                                            Diterima
                                        </span>
                                    @elseif ($item->status === 'tidak_diterima')
                                        <span class="badge text-bg-danger">
                                            Tidak Diterima
                                        </span>
                                    @else
                                        <span class="badge text-bg-warning">
                                            Menunggu Seleksi
                                        </span>
                                    @endif
                                </td>

                                {{-- Tombol detail dan hapus --}}
                                <td class="text-center action-buttons">
                                    <div class="d-flex justify-content-center flex-wrap gap-2">

                                        <a href="{{ url('/admin/spmb/' . $item->id) }}"
                                           class="btn btn-sm btn-primary">
                                            Detail / Ubah Status
                                        </a>

                                        <form
                                            action="{{ route('admin.spmb.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus pendaftar {{ $item->nama_calon }} dengan nomor {{ $item->nomor_pendaftaran }}? Data yang dihapus tidak dapat dikembalikan.');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6"
                                    class="text-center py-4 text-muted">
                                    Belum ada data pendaftar atau data tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            {{-- Informasi dan navigasi halaman --}}
            @if ($pendaftars->total() > 0)
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-3">

                    <small class="text-muted">
                        Menampilkan {{ $pendaftars->firstItem() }}
                        sampai {{ $pendaftars->lastItem() }}
                        dari {{ $pendaftars->total() }} pendaftar
                    </small>

                    <div>
                        {{ $pendaftars->links() }}
                    </div>

                </div>
            @endif

        </div>
    </div>

    <div class="text-center text-muted small mt-4">
        TK PAUD Birrul Walidain &copy; {{ date('Y') }}
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>