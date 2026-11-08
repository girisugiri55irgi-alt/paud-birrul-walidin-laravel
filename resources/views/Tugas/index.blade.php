<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tugas Anak - TK PAUD Birrul Walidain</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #f0f5ff;
            color: #263238;
            font-family: Arial, sans-serif;
        }

        .navbar-biru,
        .header-biru {
            background: linear-gradient(135deg, #0d6efd, #084298);
        }

        .logo-sekolah {
            width: 46px;
            height: 46px;
            object-fit: contain;
            background: white;
            border-radius: 50%;
            padding: 3px;
        }

        .header-biru {
            color: white;
            padding: 35px 0;
        }

        .kartu-tugas {
            background: white;
            border: none;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .05);
            transition: transform .2s, box-shadow .2s;
        }

        .kartu-tugas:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(13, 110, 253, .12);
        }

        .ikon-tugas {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e7f1ff;
            color: #0d6efd;
            border-radius: 12px;
            font-size: 24px;
            flex-shrink: 0;
        }

        .judul-tugas {
            color: #084298;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .info-tanggal {
            background: #f5f8ff;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 13px;
        }

        .btn {
            border-radius: 9px;
        }

        .video-tugas {
            max-height: 240px;
            background: #111;
        }

        .area-kosong {
            background: white;
            border-radius: 16px;
            padding: 55px 20px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .04);
        }

        footer {
            color: #6c757d;
        }

        @media (max-width: 576px) {
            .header-biru {
                padding: 25px 0;
            }

            .judul-halaman {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>

{{-- Navigasi utama --}}
<nav class="navbar navbar-dark navbar-biru shadow-sm">
    <div class="container">
        <a href="{{ route('pendidik.dashboard') }}"
           class="navbar-brand d-flex align-items-center gap-2">

            <img src="{{ asset('images/logo1.jpeg') }}"
                 alt="Logo TK PAUD Birrul Walidain"
                 class="logo-sekolah">

            <span class="fw-bold">
                TK PAUD Birrul Walidain
            </span>
        </a>

        <a href="{{ route('pendidik.dashboard') }}"
           class="btn btn-light btn-sm">
            <i class="bi bi-house-door me-1"></i>
            dashboard
        </a>
    </div>
</nav>

{{-- Header halaman --}}
<header class="header-biru">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <div class="small mb-2 opacity-75">
                    HALAMAN PENGELOLAAN PEMBELAJARAN
                </div>

                <h1 class="judul-halaman fw-bold mb-2">
                    <i class="bi bi-journal-text me-2"></i>
                    Tugas Anak
                </h1>

                <p class="mb-0">
                    Kelola tugas dan kegiatan pembelajaran anak usia dini.
                </p>
            </div>

            <a href="{{ route('tugas.create') }}"
               class="btn btn-light fw-semibold px-3 py-2">
                <i class="bi bi-plus-circle me-1"></i>
                Tambah Tugas
            </a>
        </div>
    </div>
</header>

{{-- Konten utama --}}
<main class="container py-4">

    {{-- Notifikasi berhasil --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Notifikasi kesalahan --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>
                <i class="bi bi-exclamation-triangle me-1"></i>
                Periksa kembali data yang dimasukkan.
            </strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Informasi jumlah tugas --}}
    <div class="card kartu-tugas mb-4">
        <div class="card-body p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="ikon-tugas">
                    <i class="bi bi-collection"></i>
                </div>

                <div>
                    <div class="text-secondary small">
                        Total Tugas Tersimpan
                    </div>

                    <h3 class="fw-bold mb-0">
                        {{ $tugas->count() }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar tugas --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h4 class="fw-bold mb-1">Daftar Tugas Pembelajaran</h4>
            <p class="text-secondary mb-0 small">
                Daftar tugas yang telah dibuat.
            </p>
        </div>

        <span class="badge rounded-pill text-bg-primary px-3 py-2">
            {{ $tugas->count() }} tugas
        </span>
    </div>

    <div class="row g-4">

        @forelse ($tugas as $item)
            <div class="col-md-6 col-lg-4">

                <div class="card kartu-tugas h-100">
                    <div class="card-body p-4 d-flex flex-column">

                        {{-- Judul tugas --}}
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="ikon-tugas">
                                <i class="bi bi-journal-bookmark"></i>
                            </div>

                            <div class="flex-grow-1">
                                <h5 class="judul-tugas mb-1">
                                    {{ $item->judul }}
                                </h5>

                                <span class="badge rounded-pill text-bg-primary">
                                    Tugas Pembelajaran
                                </span>
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <p class="text-secondary mb-3"
                           style="white-space: pre-line; overflow-wrap: anywhere;">
                            {{ $item->deskripsi ?: 'Tidak ada deskripsi tugas.' }}
                        </p>

                        {{-- Tanggal --}}
                        <div class="info-tanggal mb-3">
                            <div class="mb-2">
                                <i class="bi bi-calendar-event text-primary me-2"></i>
                                <strong>Mulai:</strong>
                                {{ $item->tanggal_mulai?->format('d-m-Y') ?? '-' }}
                            </div>

                            <div>
                                <i class="bi bi-calendar-check text-primary me-2"></i>
                                <strong>Batas pengumpulan:</strong>
                                {{ $item->batas_pengumpulan?->format('d-m-Y') ?? '-' }}
                            </div>
                        </div>

                        {{-- Video tugas --}}
                        @if ($item->file_video)
                            <div class="mb-3">
                                <div class="fw-semibold small mb-2">
                                    <i class="bi bi-play-circle text-primary me-1"></i>
                                    Video tugas
                                </div>

                                <video controls
                                       preload="metadata"
                                       class="video-tugas w-100 rounded">
                                    <source src="{{ asset('storage/' . $item->file_video) }}">
                                    Browser Anda tidak mendukung pemutar video.
                                </video>
                            </div>
                        @endif

                        {{-- Tombol tindakan --}}
                        <div class="d-flex gap-2 mt-auto pt-3 border-top">
                            <a href="{{ route('tugas.edit', $item->id) }}"
                               class="btn btn-outline-primary btn-sm flex-grow-1">
                                <i class="bi bi-pencil-square me-1"></i>
                                Edit
                            </a>

                            <form action="{{ route('tugas.destroy', $item->id) }}"
                                  method="POST"
                                  class="flex-grow-1"
                                  onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-outline-danger btn-sm w-100">
                                    <i class="bi bi-trash me-1"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>

        @empty
            <div class="col-12">
                <div class="area-kosong">
                    <div class="ikon-tugas mx-auto mb-3"
                         style="width: 65px; height: 65px; font-size: 30px;">
                        <i class="bi bi-journal-x"></i>
                    </div>

                    <h5 class="fw-bold">Belum Ada Tugas</h5>

                    <p class="text-secondary">
                        Silakan tambahkan tugas pembelajaran pertama.
                    </p>

                    <a href="{{ route('tugas.create') }}"
                       class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i>
                        Tambah Tugas
                    </a>
                </div>
            </div>
        @endforelse

    </div>

    {{-- Tombol kembali --}}
    <div class="mt-4">
        @if(auth()->check() && auth()->user()->role === 'pendidik')
    <a href="{{ route('pendidik.dashboard') }}"
       class="btn btn-secondary">
        Kembali ke Dashboard Pendidik
    </a>
@elseif(auth()->check() && auth()->user()->role === 'administrator')
    <a href="{{ route('dashboard') }}"
       class="btn btn-secondary">
        Kembali ke Dashboard Administrator
    </a>
@else
    <a href="{{ route('beranda') }}"
       class="btn btn-secondary">
        Kembali ke Beranda
    </a>
@endif
    </div>

</main>

<footer class="text-center py-4">
    <small>
        &copy; {{ date('Y') }} TK PAUD Birrul Walidain
    </small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>