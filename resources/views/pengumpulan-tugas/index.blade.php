<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengumpulan Tugas Anak - TK PAUD Birrul Walidain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/dashboard-orang-tua') }}">
            <img src="{{ asset('images/logo1.jpeg') }}"
                 alt="Logo sekolah"
                 width="40" height="40"
                 class="rounded-circle"
                 onerror="this.style.display='none'">
            <span>TK PAUD Birrul Walidain</span>
        </a>

        <a href="{{ url('/dashboard-orang-tua') }}" class="btn btn-outline-light btn-sm">Kembali ke Dashboard Orang Tua</a>
    </div>
</nav>

<main class="container py-4">

    <div class="mb-4">
        <h2 class="fw-bold">Pengumpulan Tugas Anak</h2>
        <p class="text-secondary">
            Lihat tugas pembelajaran dan kirim hasil pekerjaan anak Anda.
        </p>
        <div class="alert alert-info">
            Nama siswa: <strong>{{ $siswa->nama }}</strong>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Daftar Tugas Pembelajaran</h5>
        </div>

        <div class="card-body">
            @forelse($tugas as $item)
                @php
                    $sudahDikumpulkan = $pengumpulan->firstWhere('tugas_id', $item->id);
                @endphp

                <div class="border rounded p-3 mb-3">
                    <div class="d-flex flex-wrap justify-content-between gap-2">
                        <div>
                            <h5>{{ $item->judul }}</h5>

                            <p class="text-secondary mb-2">
                                {{ $item->deskripsi ?: 'Tidak ada deskripsi tugas.' }}
                            </p>

                            <small class="text-muted">
                                Batas pengumpulan:
                                {{ $item->deadline ? \Carbon\Carbon::parse($item->deadline)->format('d-m-Y') : 'Belum ditentukan' }}
                            </small>

                            @if($item->file_materi)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/' . $item->file_materi) }}"
                                       target="_blank"
                                       rel="noopener">
                                        Lihat materi tugas
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div>
                            @if($sudahDikumpulkan)
                                <span class="badge text-bg-success">
                                    Sudah dikumpulkan
                                </span>
                                <div class="mt-2">
                                    <small>Status: {{ str_replace('_', ' ', ucfirst($sudahDikumpulkan->status)) }}</small>
                                </div>
                            @else
                                <a href="{{ route('pengumpulan-tugas.create', $item->id) }}"
                                   class="btn btn-primary">
                                    Kirim Tugas
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <h5>Belum Ada Tugas</h5>
                    <p class="text-secondary mb-0">
                        Belum ada tugas pembelajaran yang tersedia.
                    </p>
                </div>
            @endforelse
        </div>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>