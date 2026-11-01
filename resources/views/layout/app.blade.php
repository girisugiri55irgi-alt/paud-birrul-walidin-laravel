
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'TK PAUD Birrul Walidin')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --warna-utama: #6374f4;
            --warna-utama-gelap: #4658df;
            --warna-latar: #f5f8f7;
            --warna-teks: #34466a;
        }

        body {
            background: var(--warna-latar);
            color: var(--warna-teks);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        .navbar-utama {
            background: var(--warna-utama);
            min-height: 70px;
        }

        .navbar-utama .navbar-brand {
            color: white;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .logo-sekolah {
            width: 46px;
            height: 46px;
            object-fit: contain;
            border-radius: 50%;
            background: white;
            padding: 2px;
        }

        .navbar-utama .nav-link,
        .navbar-utama .navbar-text {
            color: white;
        }

        .navbar-utama .nav-link:hover {
            color: #e5e9ff;
        }

        .navbar-kedua {
            background: white;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
        }

        .navbar-kedua .nav-link {
            color: #7b8490;
            padding: 17px 14px;
        }

        .navbar-kedua .nav-link:hover,
        .navbar-kedua .nav-link.active {
            color: var(--warna-utama-gelap);
        }

        .konten-utama {
            max-width: 1140px;
            margin: 24px auto;
            padding-left: 15px;
            padding-right: 15px;
        }

        .kartu {
            background: white;
            border: 0;
            border-radius: 4px;
            box-shadow: 0 3px 12px rgba(30, 50, 70, .045);
        }

        .kartu-header {
            padding: 18px 24px;
            border-bottom: 1px solid #f0f1f4;
            font-weight: 700;
            color: #687583;
        }

        .kartu-body {
            padding: 24px;
        }

        .btn-sekolah {
            background: var(--warna-utama-gelap);
            border-color: var(--warna-utama-gelap);
            color: white;
        }

        .btn-sekolah:hover {
            background: #3547ce;
            border-color: #3547ce;
            color: white;
        }

        .form-control, .form-select {
            min-height: 42px;
            border-color: #dfe3ff;
            border-radius: 4px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--warna-utama);
            box-shadow: 0 0 0 .2rem rgba(99,116,244,.12);
        }

        .kartu-menu {
            height: 100%;
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .kartu-menu:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(30,50,70,.09);
        }

        .ikon-menu {
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #edf0ff;
            color: var(--warna-utama-gelap);
            font-size: 22px;
        }

        footer {
            color: #7b8490;
            padding: 24px 12px;
            text-align: center;
        }

        @media (max-width: 576px) {
            .navbar-utama .navbar-brand {
                font-size: 13px;
                letter-spacing: 1px;
            }

            .logo-sekolah {
                width: 36px;
                height: 36px;
            }

            .kartu-body {
                padding: 18px;
            }

            .navbar-kedua .nav-link {
                padding: 10px 8px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- NAVBAR ATAS -->
    <nav class="navbar navbar-expand-lg navbar-utama">
        <div class="container-fluid px-lg-4">

            <a class="navbar-brand d-flex align-items-center gap-2"
               href="{{ url('/') }}">

                <img src="{{ asset('images/logo.png') }}"
                     class="logo-sekolah"
                     alt="Logo sekolah"
                     onerror="this.style.display='none'">

                <span>TK PAUD BIRRUL WALIDIN</span>
            </a>

            <button class="navbar-toggler border-light"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#menuAtas"
                    aria-controls="menuAtas"
                    aria-expanded="false"
                    aria-label="Buka menu">
                <span class="navbar-toggler-icon"
                      style="filter: brightness(0) invert(1)"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuAtas">
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="bi bi-person-circle me-1"></i>
                                {{ Auth::user()->name ?? 'Akun Saya' }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ url('/logout') }}">
                                @csrf
                                <button class="btn btn-light btn-sm ms-lg-2"
                                        type="submit">
                                    <i class="bi bi-box-arrow-right me-1"></i>
                                    Keluar
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('login') }}">
                                <i class="bi bi-person-circle me-1"></i>
                                Login Masuk
                            </a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>

    <!-- NAVBAR KEDUA -->
    <nav class="navbar navbar-expand navbar-kedua">
        <div class="container-fluid px-lg-5">
            <div class="navbar-nav flex-row flex-wrap">

                <a class="nav-link" href="{{ url('/') }}">
                    <i class="bi bi-house-door-fill me-2"></i>Home
                </a>

                <a class="nav-link" href="{{ url('/spmb') }}">
                    <i class="bi bi-person-plus-fill me-2"></i>Daftar Sekarang
                </a>

                <a class="nav-link" href="{{ url('/spmb/cek-status') }}">
                    <i class="bi bi-people-fill me-2"></i>Cek Pendaftaran
                </a>

                <a class="nav-link" href="{{ url('/spmb/cek-status') }}">
                    <i class="bi bi-megaphone-fill me-2"></i>Pengumuman
                </a>

                @auth
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                @endauth

            </div>
        </div>
    </nav>

    <!-- ISI SETIAP HALAMAN -->
    <main class="konten-utama">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close"
                        data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Mohon periksa kembali data Anda.</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} TK PAUD Birrul Walidin.
        Website Monitoring Perkembangan dan Evaluasi Belajar Anak Usia Dini.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
