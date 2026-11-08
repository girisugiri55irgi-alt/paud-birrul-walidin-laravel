<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Materi Pembelajaran - PAUD Birrul Walidain</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('beranda') }}">
            PAUD Birrul Walidain
        </a>

        <div class="ms-auto d-flex gap-2">
            @auth
                @if(in_array(auth()->user()->role, ['administrator', 'pendidik']))
                    <a href="{{ route('materi.kelola') }}"
                       class="btn btn-warning btn-sm">
                        Kelola Materi
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-light btn-sm">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>

<div class="container py-5">

    <h1 class="mb-2">Materi Pembelajaran</h1>

    <p class="text-muted mb-4">
        Materi belajar anak PAUD Birrul Walidain.
    </p>

    <div class="row g-4">

        @forelse($materis as $materi)

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">

                        <span class="badge bg-primary mb-2">
                            {{ $materi->tema ?: 'Pembelajaran PAUD' }}
                        </span>

                        <h5 class="card-title">
                            {{ $materi->judul }}
                        </h5>

                        <p class="text-muted small">
                            Kelompok usia:
                            {{ $materi->kelompok_usia ?: 'Semua kelompok' }}
                        </p>

                        @if($materi->deskripsi)
                            <p>{{ $materi->deskripsi }}</p>
                        @endif

                        @if($materi->isi_materi)
                            <details class="mb-3">
                                <summary class="text-primary">
                                    Baca isi materi
                                </summary>

                                <div class="mt-2">
                                    {!! nl2br(e($materi->isi_materi)) !!}
                                </div>
                            </details>
                        @endif

                        @if($materi->file_materi)
                            <a href="{{ asset('storage/' . $materi->file_materi) }}"
                               target="_blank"
                               rel="noopener"
                               class="btn btn-outline-primary btn-sm">
                                Buka / Unduh File
                            </a>
                        @endif

                    </div>
                </div>
            </div>

        @empty

            <div class="col-12">
                <div class="alert alert-info">
                    Belum ada materi pembelajaran yang ditambahkan.
                </div>
            </div>

        @endforelse

    </div>

    {{-- Tombol kembali sesuai jenis pengguna --}}
    @auth

        @if(auth()->user()->role === 'pendidik')

            <a href="{{ route('pendidik.dashboard') }}"
               class="btn btn-secondary mt-4">
                Kembali ke Dashboard Pendidik
            </a>

        @elseif(auth()->user()->role === 'orang_tua')

            <a href="{{ route('orangtua.dashboard') }}"
               class="btn btn-secondary mt-4">
                Kembali ke Dashboard Orang Tua
            </a>

        @elseif(auth()->user()->role === 'administrator')

            <a href="{{ route('dashboard') }}"
               class="btn btn-secondary mt-4">
                Kembali ke Dashboard Administrator
            </a>

        @else

            <a href="{{ route('beranda') }}"
               class="btn btn-secondary mt-4">
                Kembali ke Beranda
            </a>

        @endif

    @else

        <a href="{{ route('beranda') }}"
           class="btn btn-secondary mt-4">
            Kembali ke Beranda
        </a>

    @endauth

</div>

</body>
</html>