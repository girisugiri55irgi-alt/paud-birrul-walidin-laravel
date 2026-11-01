<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Presensi Harian - TK PAUD Birrul Walidin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a href="{{ auth()->user()->role === 'pendidik'
    ? route('pendidik.dashboard')
    : route('dashboard') }}" class="navbar-brand fw-bold">
            <i class="bi bi-calendar-check me-2"></i>
            Presensi Harian PAUD
        </a>

        <a href="{{ auth()->user()->role === 'pendidik'
    ? route('pendidik.dashboard')
    : route('dashboard') }}" class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left me-1"></i>
            Dashboard
        </a>
    </div>
</nav>

<main class="container py-4">

    <div class="mb-4">
        <h3 class="fw-bold">Presensi Harian Anak</h3>
        <p class="text-secondary mb-0">
            Catat kehadiran siswa TK PAUD Birrul Walidin.
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Presensi belum dapat diproses.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('presensi.index') }}"
                  class="row g-3 align-items-end">

                <div class="col-md-5">
                    <label for="tanggal" class="form-label fw-semibold">
                        Tanggal Presensi
                    </label>
                    <input type="date" name="tanggal" id="tanggal"
                           class="form-control"
                           value="{{ $tanggal }}" required>
                </div>

                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search me-1"></i>
                        Tampilkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <form method="POST" action="{{ route('presensi.store') }}">
        @csrf

        <input type="hidden" name="tanggal" value="{{ $tanggal }}">

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Daftar Siswa</h5>
                    <span class="badge text-bg-primary">
                        {{ $siswas->count() }} siswa
                    </span>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th class="ps-3">No.</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th style="min-width: 150px">Status</th>
                                <th style="min-width: 180px">Keterangan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($siswas as $siswa)
                                @php
                                    $catatan = $presensis->get($siswa->id);
                                    $statusSaatIni = old(
                                        'status.' . $siswa->id,
                                        $catatan?->status ?? 'Hadir'
                                    );
                                @endphp

                                <tr>
                                    <td class="ps-3">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>{{ $siswa->nis }}</td>

                                    <td class="fw-semibold">
                                        {{ $siswa->nama }}
                                    </td>

                                    <td>
                                        {{ $siswa->kelas ?: '-' }}
                                    </td>

                                    <td>
                                        <select
                                            name="status[{{ $siswa->id }}]"
                                            class="form-select form-select-sm"
                                            required>

                                            @foreach (['Hadir', 'Izin', 'Sakit', 'Alpa'] as $status)
                                                <option value="{{ $status }}"
                                                    @selected($statusSaatIni === $status)>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text"
                                            name="keterangan[{{ $siswa->id }}]"
                                            class="form-control form-control-sm"
                                            maxlength="1000"
                                            value="{{ old(
                                                'keterangan.' . $siswa->id,
                                                $catatan?->keterangan
                                            ) }}"
                                            placeholder="Opsional">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="text-center py-5 text-secondary">
                                        Belum ada data siswa.
                                        Tambahkan siswa terlebih dahulu.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($siswas->isNotEmpty())
                <div class="card-footer bg-white p-3 text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Simpan Presensi
                    </button>
                </div>
            @endif
        </div>
    </form>

    <div class="mt-3">
        <small class="text-secondary">
            <i class="bi bi-info-circle me-1"></i>
            Status awal siswa yang belum memiliki catatan adalah Hadir.
            Pastikan status disesuaikan dengan kondisi sebenarnya sebelum
            menyimpan.
        </small>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>