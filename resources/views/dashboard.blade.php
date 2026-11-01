<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Administrator - PAUD Birrul Walidain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --blue:#0d47a1;
            --blue2:#1976d2;
            --pale:#e3f2fd;
            --page:#f0f6ff;
            --ink:#334155;
        }

        * { box-sizing:border-box; }

        body {
            margin:0;
            background:var(--page);
            color:var(--ink);
            font-family:Arial,sans-serif;
        }

        .topbar {
            min-height:66px;
            background:linear-gradient(90deg,var(--blue),var(--blue2));
            box-shadow:0 2px 10px #0d47a126;
        }

        .brand {
            display:flex;
            align-items:center;
            gap:10px;
            color:#fff;
            text-decoration:none;
            font-weight:700;
        }

        .brand img {
            width:42px;
            height:42px;
            border-radius:50%;
            background:#fff;
            object-fit:contain;
            padding:3px;
        }

        .top-label { color:#fff; font-size:14px; }

        .layout {
            display:flex;
            align-items:stretch;
            min-height:calc(100vh - 66px);
        }

        .sidebar {
            width:245px;
            flex:0 0 245px;
            background:#fff;
            border-right:1px solid #d5e4f8;
            padding:18px 12px;
        }

        .sidebar-heading {
            padding:8px 12px;
            margin-top:8px;
            color:#64748b;
            font-size:11px;
            font-weight:700;
            text-transform:uppercase;
            letter-spacing:.08em;
        }

        .side-link {
            display:flex;
            align-items:center;
            gap:11px;
            padding:11px 12px;
            margin-bottom:4px;
            color:#334155;
            text-decoration:none;
            border-radius:8px;
            font-size:14px;
        }

        .side-link i {
            width:18px;
            color:var(--blue);
            font-size:16px;
        }

        .side-link:hover,
        .side-link.active {
            background:var(--pale);
            color:var(--blue);
            font-weight:700;
        }

        .main-content {
            min-width:0;
            flex:1;
            padding:26px;
        }

        .page-heading {
            color:var(--blue);
            font-weight:700;
            font-size:25px;
            margin:0;
        }

        .welcome {
            background:linear-gradient(120deg,#d9ecff,#fafdff);
            border:1px solid #c4def8;
            border-radius:13px;
            padding:22px 24px;
        }

        .welcome h2 {
            color:var(--blue);
            font-size:23px;
            font-weight:700;
        }

        .panel {
            background:#fff;
            border:1px solid #dce8f7;
            border-radius:12px;
            box-shadow:0 4px 15px rgba(13,71,161,.05);
        }

        .panel-title {
            color:var(--blue);
            font-weight:700;
            font-size:17px;
        }

        .stat-card {
            background:#fff;
            border:1px solid #dce8f7;
            border-radius:12px;
            padding:17px;
            height:100%;
            box-shadow:0 3px 12px rgba(13,71,161,.04);
        }

        .stat-label {
            color:#64748b;
            font-size:13px;
        }

        .stat-number {
            color:var(--blue);
            font-size:29px;
            font-weight:700;
            margin-top:7px;
        }

        .stat-icon {
            display:grid;
            place-items:center;
            width:40px;
            height:40px;
            border-radius:10px;
            background:var(--pale);
            color:var(--blue);
            font-size:20px;
        }

        .menu-item {
            height:100%;
            display:flex;
            flex-direction:column;
            padding:19px;
            transition:.18s ease;
        }

        .menu-item:hover {
            border-color:#9fc7f4;
            box-shadow:0 7px 20px rgba(13,71,161,.1);
            transform:translateY(-2px);
        }

        .menu-icon {
            width:42px;
            height:42px;
            display:grid;
            place-items:center;
            border-radius:10px;
            background:var(--pale);
            color:var(--blue);
            font-size:21px;
            margin-bottom:13px;
        }

        .menu-item h3 {
            color:var(--blue);
            font-size:16px;
            font-weight:700;
        }

        .menu-item p {
            color:#64748b;
            font-size:13px;
            line-height:1.55;
            flex:1;
        }

        .btn-school {
            background:#1565c0;
            border:1px solid #1565c0;
            color:#fff;
            border-radius:7px;
            padding:9px 12px;
            text-decoration:none;
            display:inline-block;
            text-align:center;
            font-size:13px;
        }

        .btn-school:hover {
            background:#0d47a1;
            border-color:#0d47a1;
            color:#fff;
        }

        .table thead th {
            background:#e3f2fd;
            color:var(--blue);
            font-size:13px;
            white-space:nowrap;
        }

        .footer {
            text-align:center;
            color:#64748b;
            font-size:12px;
            padding:24px 0 8px;
        }

        @media(max-width:767.98px) {
            .layout { display:block; }

            .sidebar {
                width:100%;
                padding:10px;
                border-right:0;
                border-bottom:1px solid #d5e4f8;
            }

            .sidebar-links {
                display:flex;
                overflow-x:auto;
                gap:5px;
            }

            .sidebar-heading { display:none; }

            .side-link {
                white-space:nowrap;
                margin:0;
                padding:9px 11px;
            }

            .main-content { padding:18px 13px; }

            .top-label { display:none; }
        }
    </style>
</head>

<body>

<nav class="topbar navbar navbar-dark">
    <div class="container-fluid px-3 px-lg-4">

        <a class="brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo1.jpeg') }}" alt="Logo TK PAUD Birrul Walidain">
            <span>TK PAUD Birrul Walidain</span>
        </a>

        <div class="d-flex align-items-center gap-3">
            <span class="top-label">
                <i class="bi bi-person-circle me-1"></i>
                {{ auth()->user()->name ?? auth()->user()->email }} | Administrator
            </span>

            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-light btn-sm text-primary fw-semibold">
                    <i class="bi bi-box-arrow-right me-1"></i>Keluar
                </button>
            </form>
        </div>

    </div>
</nav>

<div class="layout">

    <aside class="sidebar">

        <div class="sidebar-heading">Menu Utama</div>

        <nav class="sidebar-links">

            <a class="side-link active" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2"></i>Dashboard
            </a>

            <a class="side-link" href="{{ url('/admin/spmb') }}">
                <i class="bi bi-person-plus"></i>Pendaftaran SPMB
            </a>

            <a class="side-link" href="{{ url('/siswa') }}">
                <i class="bi bi-people"></i>Data Siswa
            </a>

            <a class="side-link" href="{{ url('/guru') }}">
                <i class="bi bi-person-workspace"></i>Data Guru
            </a>

            <a class="side-link" href="{{ url('/kelas') }}">
                <i class="bi bi-building"></i>Data Kelas
            </a>

            <a class="side-link" href="{{ url('/tahun-ajaran') }}">
                <i class="bi bi-calendar3"></i>Tahun Ajaran
            </a>

            <a class="side-link" href="{{ url('/evaluasi') }}">
                <i class="bi bi-clipboard2-check"></i>Evaluasi Anak
            </a>

            <a class="side-link" href="{{ url('/laporan') }}">
                <i class="bi bi-file-earmark-bar-graph"></i>Rekap Laporan
            </a>

            <div class="sidebar-heading">Pembelajaran</div>

            <a class="side-link" href="{{ url('/kelola-materi') }}">
                <i class="bi bi-journal-text"></i>Kelola Materi
            </a>

            <a class="side-link" href="{{ url('/tugas') }}">
                <i class="bi bi-list-task"></i>Kelola Tugas
            </a>

            <div class="sidebar-heading">Konten Website</div>

            <a class="side-link" href="{{ route('admin.konten.galeri.index') }}">
                <i class="bi bi-images"></i>Galeri Foto
            </a>

            <a class="side-link" href="{{ route('admin.konten.video.index') }}">
                <i class="bi bi-camera-video"></i>Video Kegiatan
            </a>

            <a class="side-link" href="{{ route('admin.konten.informasi.index') }}">
                <i class="bi bi-megaphone"></i>Informasi Sekolah
            </a>

            <a class="side-link" href="{{ route('admin.konten.agenda.index') }}">
                <i class="bi bi-calendar-event"></i>Agenda Sekolah
            </a>

        </nav>

        <div class="small text-secondary px-2 mt-4">
            Sistem Monitoring Perkembangan dan Evaluasi Belajar Anak Usia Dini.
        </div>

    </aside>

    <main class="main-content">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">

            <div>
                <h1 class="page-heading">Admin | Halaman Admin</h1>
                <div class="text-secondary small mt-1">
                    Pengelolaan akun, data master, dan laporan sekolah
                </div>
            </div>

            <span class="badge rounded-pill text-bg-primary px-3 py-2">
                <i class="bi bi-shield-lock me-1"></i>Administrator
            </span>

        </div>

        <section class="welcome mb-4">
            <h2 class="mb-2">Selamat datang di halaman administrator</h2>
            <p class="mb-0">
                Kelola data sekolah dan pantau proses penerimaan murid baru melalui menu di samping.
                Gunakan menu yang tersedia untuk membuka data yang ingin dikelola.
            </p>
        </section>

        <!-- STATISTIK SPMB -->
        <section class="mb-4">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">

                <h2 class="panel-title mb-0">
                    <i class="bi bi-bar-chart-line me-2"></i>Statistik Penerimaan Murid Baru
                </h2>

                <a href="{{ url('/admin/spmb') }}" class="btn-school">
                    <i class="bi bi-arrow-up-right-square me-1"></i>Kelola Pendaftar
                </a>

            </div>

            <div class="row g-3">

                <div class="col-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <span class="stat-label">Total Pendaftar</span>
                            <span class="stat-icon"><i class="bi bi-people"></i></span>
                        </div>
                        <div class="stat-number">
                            {{ $spmbStats['total'] ?? \App\Models\PendaftaranSpmb::count() }}
                        </div>
                    </div>
                </div>

                <div class="col-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <span class="stat-label">Menunggu Seleksi</span>
                            <span class="stat-icon"><i class="bi bi-hourglass-split"></i></span>
                        </div>
                        <div class="stat-number">
                            {{ $spmbStats['menunggu'] ?? \App\Models\PendaftaranSpmb::where('status', 'menunggu')->count() }}
                        </div>
                    </div>
                </div>

                <div class="col-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <span class="stat-label">Diterima</span>
                            <span class="stat-icon"><i class="bi bi-check-circle"></i></span>
                        </div>
                        <div class="stat-number">
                            {{ $spmbStats['diterima'] ?? \App\Models\PendaftaranSpmb::where('status', 'diterima')->count() }}
                        </div>
                    </div>
                </div>

                <div class="col-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <span class="stat-label">Tidak Diterima</span>
                            <span class="stat-icon"><i class="bi bi-x-circle"></i></span>
                        </div>
                        <div class="stat-number">
                            {{ $spmbStats['tidak_diterima'] ?? \App\Models\PendaftaranSpmb::where('status', 'tidak_diterima')->count() }}
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- DATA MASTER -->
        <section class="mb-4">

            <h2 class="panel-title mb-1">Pengelolaan Akun dan Data Master</h2>

            <p class="text-secondary small mb-3">
                Pilih salah satu menu untuk mengelola data PAUD Birrul Walidain.
            </p>

            <div class="row g-3">

                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="panel menu-item">
                        <div class="menu-icon"><i class="bi bi-person-plus"></i></div>
                        <h3>Penerimaan Murid Baru</h3>
                        <p>Melihat data pendaftar, memeriksa pendaftaran, dan memperbarui hasil seleksi.</p>
                        <a class="btn-school mt-auto" href="{{ url('/admin/spmb') }}">Buka SPMB <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="panel menu-item">
                        <div class="menu-icon"><i class="bi bi-people"></i></div>
                        <h3>Data Siswa</h3>
                        <p>Menambah, melihat, mengubah, dan menghapus data siswa.</p>
                        <a class="btn-school mt-auto" href="{{ url('/siswa') }}">Buka Data Siswa <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="panel menu-item">
                        <div class="menu-icon"><i class="bi bi-person-workspace"></i></div>
                        <h3>Data Guru</h3>
                        <p>Mengelola data pendidik dan informasi guru.</p>
                        <a class="btn-school mt-auto" href="{{ url('/guru') }}">Buka Data Guru <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="panel menu-item">
                        <div class="menu-icon"><i class="bi bi-building"></i></div>
                        <h3>Data Kelas</h3>
                        <p>Mengelola kelas, kelompok belajar, dan informasi kelas.</p>
                        <a class="btn-school mt-auto" href="{{ url('/kelas') }}">Buka Data Kelas <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="panel menu-item">
                        <div class="menu-icon"><i class="bi bi-calendar3"></i></div>
                        <h3>Tahun Ajaran</h3>
                        <p>Mengatur tahun ajaran yang digunakan dalam pengelolaan sekolah.</p>
                        <a class="btn-school mt-auto" href="{{ url('/tahun-ajaran') }}">Buka Tahun Ajaran <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="panel menu-item">
                        <div class="menu-icon"><i class="bi bi-journal-check"></i></div>
                        <h3>Evaluasi Anak</h3>
                        <p>Melihat dan mengelola penilaian perkembangan anak.</p>
                        <a class="btn-school mt-auto" href="{{ url('/evaluasi') }}">Buka Evaluasi <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="panel menu-item">
                        <div class="menu-icon"><i class="bi bi-journal-text"></i></div>
                        <h3>Kelola Materi</h3>
                        <p>Mengelola materi pembelajaran yang tersedia di aplikasi.</p>
                        <a class="btn-school mt-auto" href="{{ url('/kelola-materi') }}">Buka Materi <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="panel menu-item">
                        <div class="menu-icon"><i class="bi bi-list-task"></i></div>
                        <h3>Kelola Tugas</h3>
                        <p>Mengelola tugas pembelajaran yang digunakan dalam kegiatan belajar.</p>
                        <a class="btn-school mt-auto" href="{{ url('/tugas') }}">Buka Tugas <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="panel menu-item">
                        <div class="menu-icon"><i class="bi bi-file-earmark-bar-graph"></i></div>
                        <h3>Rekap Laporan</h3>
                        <p>Membuka laporan perkembangan dan evaluasi anak.</p>
                        <a class="btn-school mt-auto" href="{{ url('/laporan') }}">Buka Laporan <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>

            </div>
        </section>

        <!-- KONTEN WEBSITE BARU -->
        <section class="mb-4">

            <hr class="my-4">

            <h2 class="panel-title mb-1">
                <i class="bi bi-globe me-2"></i>Pengelolaan Konten Website
            </h2>

            <p class="text-secondary small mb-3">
                Kelola informasi dan dokumentasi yang akan ditampilkan pada halaman depan website sekolah.
            </p>

            <div class="row g-3">

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="panel menu-item">
                        <div class="menu-icon"><i class="bi bi-images"></i></div>
                        <h3>Galeri Foto</h3>
                        <p>Mengunggah dan mengelola foto kegiatan sekolah.</p>
                        <a class="btn-school mt-auto" href="{{ route('admin.konten.galeri.index') }}">
                            Kelola Galeri <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="panel menu-item">
                        <div class="menu-icon"><i class="bi bi-camera-video"></i></div>
                        <h3>Video Kegiatan</h3>
                        <p>Mengelola tautan video kegiatan sekolah.</p>
                        <a class="btn-school mt-auto" href="{{ route('admin.konten.video.index') }}">
                            Kelola Video <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="panel menu-item">
                        <div class="menu-icon"><i class="bi bi-megaphone"></i></div>
                        <h3>Informasi Sekolah</h3>
                        <p>Mengelola berita dan pengumuman sekolah.</p>
                        <a class="btn-school mt-auto" href="{{ route('admin.konten.informasi.index') }}">
                            Kelola Informasi <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="panel menu-item">
                        <div class="menu-icon"><i class="bi bi-calendar-event"></i></div>
                        <h3>Agenda Sekolah</h3>
                        <p>Mengelola jadwal kegiatan dan acara sekolah.</p>
                        <a class="btn-school mt-auto" href="{{ route('admin.konten.agenda.index') }}">
                            Kelola Agenda <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <footer class="footer">
            &copy; {{ date('Y') }} TK PAUD Birrul Walidain ·
            Sistem Monitoring Perkembangan dan Evaluasi Belajar Anak Usia Dini
        </footer>

    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>