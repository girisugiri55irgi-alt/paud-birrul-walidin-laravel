<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Pendidik - TK PAUD Birrul Walidain</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    <style>
        :root {
            --primary: #0d6efd;
            --sidebar-width: 260px;
        }

        body {
            margin: 0;
            background: #f4f7fb;
            color: #263238;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #0d6efd, #084298);
            color: white;
            padding: 22px 15px;
            overflow-y: auto;
            z-index: 1000;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 8px 22px;
            border-bottom: 1px solid rgba(255,255,255,.2);
        }

        .brand img {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            object-fit: cover;
            background: white;
        }

        .brand-title {
            font-weight: 700;
            font-size: 14px;
            line-height: 1.4;
        }

        .menu-label {
            margin: 22px 10px 8px;
            color: #d8e7ff;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #eaf2ff;
            padding: 12px 13px;
            border-radius: 9px;
            margin-bottom: 5px;
            font-size: 14px;
            text-decoration: none;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #084298;
            background: white;
        }

        .sidebar .nav-link i {
            font-size: 18px;
            width: 22px;
        }

        .main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .topbar {
            background: white;
            padding: 17px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 12px rgba(0,0,0,.04);
        }

        .content {
            padding: 28px;
        }

        .welcome-card {
            background: linear-gradient(120deg, #0d6efd, #4e9cff);
            color: white;
            padding: 28px;
            border-radius: 16px;
            margin-bottom: 25px;
        }

        .welcome-card h2 {
            font-weight: 700;
        }

        .stat-card {
            background: white;
            border: none;
            border-radius: 14px;
            padding: 22px;
            height: 100%;
            box-shadow: 0 4px 16px rgba(0,0,0,.04);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8f1ff;
            color: #0d6efd;
            font-size: 23px;
            margin-bottom: 15px;
        }

        .section-card {
            background: white;
            border: none;
            border-radius: 14px;
            padding: 22px;
            height: 100%;
            box-shadow: 0 4px 16px rgba(0,0,0,.04);
        }

        .quick-link {
            display: flex;
            align-items: center;
            gap: 14px;
            color: #263238;
            text-decoration: none;
            padding: 14px 0;
            border-bottom: 1px solid #edf0f5;
        }

        .quick-link:last-child {
            border-bottom: none;
        }

        .quick-link:hover {
            color: #0d6efd;
        }

        .quick-link i {
            color: #0d6efd;
            font-size: 21px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e8f1ff;
            color: #0d6efd;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
        }

        footer {
            padding: 20px 28px;
            color: #788391;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
            }

            .topbar {
                padding: 15px;
            }

            .content {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <div class="brand">
        <img src="{{ asset('images/logo1.jpeg') }}"
             alt="Logo sekolah"
             onerror="this.style.display='none'">

        <div class="brand-title">
            TK PAUD<br>
            Birrul Walidain
            <div class="small fw-normal mt-1">Portal Pendidik</div>
        </div>
    </div>

    <div class="menu-label">Menu Utama</div>

    <a href="{{ route('pendidik.dashboard') }}"
       class="nav-link active">
        <i class="bi bi-grid-1x2-fill"></i>
        Dashboard
    </a>

    <a href="{{ route('siswa.index') }}" class="nav-link">
        <i class="bi bi-people-fill"></i>
        Data Siswa
    </a>

    <a href="{{ route('kelas.index') }}" class="nav-link">
        <i class="bi bi-building"></i>
        Data Kelas
    </a>

    <div class="menu-label">Pembelajaran</div>

    <a href="{{ route('presensi.index') }}" class="nav-link">
    <i class="bi bi-calendar-check-fill"></i>
    Presensi Harian
</a>

    <a href="{{ route('evaluasi.index') }}" class="nav-link">
        <i class="bi bi-clipboard2-check-fill"></i>
        Evaluasi Perkembangan
    </a>

    <a href="{{ route('materi') }}" class="nav-link">
        <i class="bi bi-journal-bookmark-fill"></i>
        Materi Pembelajaran
    </a>

    <a href="{{ route('tugas.index') }}" class="nav-link">
        <i class="bi bi-pencil-square"></i>
        Tugas Pembelajaran
    </a>

    <a href="{{ route('laporan.index') }}" class="nav-link">
        <i class="bi bi-file-earmark-bar-graph-fill"></i>
        Laporan Perkembangan
    </a>

    <div class="menu-label">Akun</div>

    <a href="#" class="nav-link"
   onclick="alert('Fitur ganti password sedang disiapkan.'); return false;">
    <i class="bi bi-shield-lock-fill"></i>
    Ganti Password
</a>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
                class="nav-link border-0 w-100 text-start"
                style="background:transparent">
            <i class="bi bi-box-arrow-right"></i>
            Keluar
        </button>
    </form>
</aside>

<main class="main">

    <header class="topbar">
        <div>
            <h5 class="mb-1 fw-bold">Dashboard Pendidik</h5>
            <small class="text-muted">
                Monitoring Perkembangan dan Evaluasi Belajar Anak
            </small>
        </div>

        <div class="profile">
            <div class="profile-icon">
                <i class="bi bi-person-fill"></i>
            </div>
            <div>
                <div class="fw-semibold">
                    {{ auth()->user()->name }}
                </div>
                <small class="text-muted">Pendidik</small>
            </div>
        </div>
    </header>

    <div class="content">

        <section class="welcome-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <p class="mb-2">Selamat datang kembali,</p>
                    <h2>{{ auth()->user()->name }}</h2>
                    <p class="mb-0">
                        Mari pantau perkembangan, pembelajaran, dan pencapaian
                        setiap anak bersama TK PAUD Birrul Walidain.
                    </p>
                </div>

                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <i class="bi bi-mortarboard"
                       style="font-size:85px;opacity:.85"></i>
                </div>
            </div>
        </section>

        <div class="row g-3 mb-4">

            <div class="col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="text-muted small">Data Siswa</div>
                    <h4 class="fw-bold mt-2 mb-2">Kelola Siswa</h4>
                    <a href="{{ route('siswa.index') }}"
                       class="small text-decoration-none">
                        Buka data siswa <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-clipboard2-check-fill"></i>
                    </div>
                    <div class="text-muted small">Evaluasi</div>
                    <h4 class="fw-bold mt-2 mb-2">Penilaian Anak</h4>
                    <a href="{{ route('evaluasi.index') }}"
                       class="small text-decoration-none">
                        Buka evaluasi <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-journal-bookmark-fill"></i>
                    </div>
                    <div class="text-muted small">Materi</div>
                    <h4 class="fw-bold mt-2 mb-2">Pembelajaran</h4>
                    <a href="{{ route('materi') }}"
                       class="small text-decoration-none">
                        Buka materi <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-file-earmark-text-fill"></i>
                    </div>
                    <div class="text-muted small">Laporan</div>
                    <h4 class="fw-bold mt-2 mb-2">Hasil Perkembangan</h4>
                    <a href="{{ route('laporan.index') }}"
                       class="small text-decoration-none">
                        Buka laporan <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="row g-4">

            <div class="col-lg-7">
                <div class="section-card">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-lightning-charge-fill text-primary me-2"></i>
                        Akses Cepat
                    </h5>

                    <a href="{{ route('evaluasi.create') }}"
                       class="quick-link">
                        <i class="bi bi-plus-circle-fill"></i>
                        <div>
                            <div class="fw-semibold">Tambah Evaluasi Anak</div>
                            <small class="text-muted">
                                Catat hasil pengamatan perkembangan anak
                            </small>
                        </div>
                        <i class="bi bi-chevron-right ms-auto"></i>
                    </a>

                    <a href="{{ route('siswa.index') }}"
                       class="quick-link">
                        <i class="bi bi-person-lines-fill"></i>
                        <div>
                            <div class="fw-semibold">Lihat Data Siswa</div>
                            <small class="text-muted">
                                Periksa daftar siswa yang terdaftar
                            </small>
                        </div>
                        <i class="bi bi-chevron-right ms-auto"></i>
                    </a>

                    <a href="{{ route('tugas.index') }}"
                       class="quick-link">
                        <i class="bi bi-journal-check"></i>
                        <div>
                            <div class="fw-semibold">Tugas Pembelajaran</div>
                            <small class="text-muted">
                                Buka dan kelola tugas pembelajaran
                            </small>
                        </div>
                        <i class="bi bi-chevron-right ms-auto"></i>
                    </a>

                    <a href="{{ route('laporan.index') }}"
                       class="quick-link">
                        <i class="bi bi-file-earmark-bar-graph"></i>
                        <div>
                            <div class="fw-semibold">Laporan Perkembangan Anak</div>
                            <small class="text-muted">
                                Lihat halaman laporan perkembangan
                            </small>
                        </div>
                        <i class="bi bi-chevron-right ms-auto"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="section-card">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-person-vcard-fill text-primary me-2"></i>
                        Informasi Akun
                    </h5>

                    <div class="mb-3">
                        <small class="text-muted">Nama Pendidik</small>
                        <div class="fw-semibold">
                            {{ auth()->user()->name }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Email Login</small>
                        <div class="fw-semibold">
                            {{ auth()->user()->email }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Peran Pengguna</small>
                        <div>
                            <span class="badge bg-primary">Pendidik</span>
                        </div>
                    </div>

                    <hr>

                    <button type="button"
        class="btn btn-outline-primary w-100"
        onclick="alert('Fitur ganti password sedang disiapkan.');">
    <i class="bi bi-key-fill me-2"></i>
    Ganti Password
</button>
                </div>
            </div>

        </div>

    </div>

    <footer>
        &copy; {{ date('Y') }} TK PAUD Birrul Walidain.
        Sistem Monitoring Perkembangan dan Evaluasi Belajar Anak Usia Dini.
    </footer>

</main>

</body>
</html>