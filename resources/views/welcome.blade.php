<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TK PAUD Birrul Walidain</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --biru: #6374f4;
            --biru-gelap: #4658df;
            --latar: #f5f8f7;
            --teks: #34466a;
        }

        * {
            box-sizing: border-box;
        }

        /* BACKGROUND FOTO HALAMAN UTAMA */
       body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    color: var(--teks);
    font-size: 14px;

    background-color: #eaf0ff;

    background-image:
        linear-gradient(
            rgba(35, 65, 135, 0.35),
            rgba(35, 65, 135, 0.35)
        ),
        url('/images/background-paud.jpeg');

    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
}
        .navbar-utama {
            background: var(--biru);
            min-height: 70px;
        }

        .navbar-utama .navbar-brand {
            color: white;
            font-size: 20px;
            font-weight: bold;
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

        .navbar-utama .nav-link {
            color: white;
        }

        .navbar-utama .nav-link:hover {
            color: #e5e9ff;
        }

        .navbar-kedua {
            background: white;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .04);
        }

        .navbar-kedua .nav-link {
            color: #7b8490;
            padding: 17px 14px;
            white-space: nowrap;
        }

        .navbar-kedua .nav-link:hover {
            color: var(--biru-gelap);
        }

        .konten {
            max-width: 1140px;
            margin: 24px auto;
            padding: 0 15px;
        }

        /* KARTU UTAMA */
        .kartu {
            background: rgba(255, 255, 255, 0.96);
            border: 0;
            border-radius: 10px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .12);
            height: 100%;
        }

        .kartu-header {
            padding: 18px 24px;
            border-bottom: 1px solid #f0f1f4;
            color: #687583;
            font-size: 17px;
            font-weight: bold;
        }

        .kartu-body {
            padding: 24px;
        }

        /* BANNER SELAMAT DATANG */
        .banner {
            background: rgba(255, 255, 255, 0.94);
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .12);
            margin-bottom: 30px;
            backdrop-filter: blur(5px);
        }

        .banner h1 {
            font-size: clamp(22px, 3vw, 30px);
            color: var(--teks);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .btn-sekolah {
            background: var(--biru-gelap);
            border-color: var(--biru-gelap);
            color: white;
            border-radius: 4px;
            padding: 10px 18px;
        }

        .btn-sekolah:hover {
            background: #3547ce;
            border-color: #3547ce;
            color: white;
        }

        .btn-outline-sekolah {
            color: var(--biru-gelap);
            background: white;
            border: 1px solid var(--biru-gelap);
            border-radius: 4px;
            padding: 10px 18px;
        }

        .btn-outline-sekolah:hover {
            background: #eef0ff;
            color: var(--biru-gelap);
        }

        .ikon-menu {
            min-width: 46px;
            width: 46px;
            height: 46px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background: #e5edff;
            color: #7889ff;
            font-size: 23px;
        }

        .kartu-fitur {
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .kartu-fitur:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(30, 50, 70, .09);
        }

        .kartu-fitur h5 a {
            color: var(--biru-gelap);
            text-decoration: none;
        }

        .kartu-fitur h5 a:hover {
            text-decoration: underline;
        }

        .judul-bagian {
            color: white;
            font-weight: 700;
            margin-bottom: 6px;
            text-shadow: 0 2px 5px rgba(0,0,0,.35);
        }

        .garis-bagian {
            width: 55px;
            height: 4px;
            background: var(--biru);
            border-radius: 5px;
            margin-bottom: 22px;
        }

        .kartu-konten {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .10);
            height: 100%;
        }

        .foto-galeri {
            width: 100%;
            height: 210px;
            object-fit: cover;
        }

        .kartu-konten-body {
            padding: 18px;
        }

        .video-frame {
            width: 100%;
            aspect-ratio: 16 / 9;
            border: 0;
        }

        .tanggal-agenda {
            background: #e8ecff;
            color: var(--biru-gelap);
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            min-width: 65px;
            font-weight: bold;
        }

        .kosong-konten {
            background: white;
            padding: 25px;
            border-radius: 6px;
            text-align: center;
            color: #8993a1;
        }

        footer {
            background: white;
            color: #7b8490;
            padding: 22px 12px;
            text-align: center;
            margin-top: 35px;
            border-top: 1px solid #edf0f2;
        }

        /* TAMPILAN HP */
        @media (max-width: 768px) {

            body {
                background-attachment: scroll;
                background-position: center center;
            }

            .navbar-utama .navbar-brand {
                font-size: 14px;
                letter-spacing: 1px;
            }

            .logo-sekolah {
                width: 36px;
                height: 36px;
            }

            .navbar-kedua .nav-link {
                padding: 10px 9px;
                font-size: 12px;
            }

            .kartu-body {
                padding: 18px;
            }

            .banner {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR ATAS -->
    <nav class="navbar navbar-expand-lg navbar-utama">
        <div class="container-fluid px-lg-4">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                <img src="{{ asset('images/logo1.jpeg') }}"
                     class="logo-sekolah"
                     alt="Logo sekolah"
                     onerror="this.style.display='none'">
                <span>TK PAUD BIRRUL WALIDAIN</span>
            </a>

            <button class="navbar-toggler border-light"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#menuAtas"
                    aria-controls="menuAtas"
                    aria-expanded="false"
                    aria-label="Buka menu">
                <span class="navbar-toggler-icon" style="filter: brightness(0) invert(1)"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuAtas">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-person-circle fs-5 me-1"></i>
                            Login Masuk
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- NAVBAR KEDUA -->
    <nav class="navbar navbar-expand navbar-kedua">
        <div class="container-fluid px-lg-5">
            <div class="navbar-nav flex-row flex-wrap">
                <a class="nav-link" href="#beranda"><i class="bi bi-house-door-fill me-2"></i>Home</a>
                <a class="nav-link" href="#spmb"><i class="bi bi-arrow-repeat me-2"></i>Daftar Sekarang</a>
                <a class="nav-link" href="{{ route('spmb.cek') }}"><i class="bi bi-people-fill me-2"></i>Data Sudah Daftar</a>
                <a class="nav-link" href="{{ route('spmb.cek') }}"><i class="bi bi-megaphone-fill me-2"></i>Pengumuman</a>
                <a class="nav-link" href="#galeri"><i class="bi bi-images me-2"></i>Galeri</a>
                <a class="nav-link" href="#video"><i class="bi bi-camera-video me-2"></i>Video</a>
                <a class="nav-link" href="#informasi"><i class="bi bi-info-circle me-2"></i>Informasi</a>
                <a class="nav-link" href="#agenda"><i class="bi bi-calendar-event me-2"></i>Agenda</a>
            </div>
        </div>
    </nav>

    <main class="konten">

        <!-- BANNER -->
        <section class="banner" id="beranda">
            <div class="row align-items-center g-3">
                <div class="col-lg-9">
                    <h1>Selamat Datang di TK PAUD Birrul Walidain</h1>
                    <p class="text-secondary mb-0">
                        Mendampingi tumbuh kembang anak melalui pembelajaran
                        menyenangkan, pemantauan perkembangan, dan evaluasi
                        belajar yang dapat diakses oleh orang tua.
                    </p>
                </div>
                <div class="col-lg-3 text-lg-end">
                    <a href="{{ route('spmb.index') }}" class="btn btn-sekolah">
                        DAFTAR SEKARANG
                    </a>
                </div>
            </div>
        </section>

        <!-- PROFIL DAN PENDAFTARAN -->
        <div class="row g-4">

            <div class="col-lg-6" id="profil">
                <section class="kartu">
                    <div class="kartu-header">
                        <i class="bi bi-mortarboard-fill me-2"></i>
                        PROFIL SEKOLAH
                    </div>

                    <div class="kartu-body">
                        <h5 class="fw-semibold">TK PAUD Birrul Walidain</h5>
                        <p class="text-secondary">
                            Berkomitmen mendukung perkembangan anak usia dini
                            melalui pendidikan, kegiatan belajar, serta
                            pemantauan perkembangan yang berkelanjutan.
                        </p>
                        <hr>

                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="ikon-menu"><i class="bi bi-book-half"></i></div>
                            <div>
                                <h6 class="mb-1">Pembelajaran Anak</h6>
                                <p class="text-secondary mb-0">Informasi materi dan kegiatan belajar.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="ikon-menu"><i class="bi bi-graph-up-arrow"></i></div>
                            <div>
                                <h6 class="mb-1">Monitoring Perkembangan</h6>
                                <p class="text-secondary mb-0">Pemantauan perkembangan setiap anak.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="ikon-menu"><i class="bi bi-people-fill"></i></div>
                            <div>
                                <h6 class="mb-1">Kerja Sama Orang Tua</h6>
                                <p class="text-secondary mb-0">Mendukung komunikasi orang tua dan pendidik.</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-lg-6" id="spmb">
                <section class="kartu">
                    <div class="kartu-header">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        INFORMASI DAN PENDAFTARAN
                    </div>

                    <div class="kartu-body">
                        <div class="d-flex align-items-center gap-3 pb-3 mb-3 border-bottom">
                            <div class="ikon-menu"><i class="bi bi-file-earmark-text"></i></div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Persyaratan Pendaftaran</h6>
                                <p class="text-secondary mb-0">
                                    Siapkan data calon murid dan orang tua sebelum mengisi formulir.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 pb-3 mb-3 border-bottom">
                            <div class="ikon-menu"><i class="bi bi-pencil-square"></i></div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Pendaftaran Murid Baru</h6>
                                <p class="text-secondary mb-0">Isi formulir pendaftaran secara online.</p>
                                <a href="{{ route('spmb.index') }}" class="btn btn-sekolah btn-sm mt-2">Daftar Sekarang</a>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="ikon-menu"><i class="bi bi-search"></i></div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Cek Status dan Pengumuman</h6>
                                <p class="text-secondary mb-0">
                                    Periksa hasil seleksi menggunakan nomor pendaftaran.
                                </p>
                                <a href="{{ route('spmb.cek') }}" class="btn btn-outline-sekolah btn-sm mt-2">
                                    Cek Status Pendaftaran
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <!-- LAYANAN WEBSITE -->
        <section class="mt-5" id="layanan">
            <h3 class="h4 fw-semibold mb-1 text-white">Layanan Website</h3>
            <p class="text-white">Pilih layanan sesuai kebutuhan Anda.</p>

            <div class="row g-3 mt-1">
                <div class="col-md-6 col-lg-4">
                    <div class="kartu kartu-fitur p-4">
                        <div class="ikon-menu mb-3"><i class="bi bi-journal-text"></i></div>
                        <h5 class="h6 fw-bold"><a href="{{ route('materi') }}">Materi Pembelajaran</a></h5>
                        <p class="text-secondary mb-0">Informasi materi dan kegiatan belajar anak.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="kartu kartu-fitur p-4">
                        <div class="ikon-menu mb-3"><i class="bi bi-pencil-square"></i></div>
                        <h5 class="h6 fw-bold">
                            <a href="{{ route('login', ['tujuan' => 'tugas']) }}">Tugas Anak</a>
                        </h5>
                        <p class="text-secondary mb-0">Informasi tugas dan kegiatan belajar yang diberikan pendidik.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="kartu kartu-fitur p-4">
                        <div class="ikon-menu mb-3"><i class="bi bi-clipboard-check"></i></div>
                        <h5 class="h6 fw-bold">
                            <a href="{{ route('login', ['tujuan' => 'evaluasi']) }}">Evaluasi Perkembangan</a>
                        </h5>
                        <p class="text-secondary mb-0">Pemantauan aspek kognitif, motorik, sosial-emosional, agama, dan moral.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="kartu kartu-fitur p-4">
                        <div class="ikon-menu mb-3"><i class="bi bi-people"></i></div>
                        <h5 class="h6 fw-bold"><a href="{{ route('login') }}">Orang Tua</a></h5>
                        <p class="text-secondary mb-0">Masuk untuk melihat laporan perkembangan anak sesuai hak akses.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="kartu kartu-fitur p-4">
                        <div class="ikon-menu mb-3"><i class="bi bi-person-badge"></i></div>
                        <h5 class="h6 fw-bold"><a href="{{ route('login') }}">Pendidik</a></h5>
                        <p class="text-secondary mb-0">Akses layanan pembelajaran dan evaluasi melalui akun pendidik.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="kartu kartu-fitur p-4">
                        <div class="ikon-menu mb-3"><i class="bi bi-speedometer2"></i></div>
                        <h5 class="h6 fw-bold"><a href="{{ route('login') }}">Dashboard Pengguna</a></h5>
                        <p class="text-secondary mb-0">Login untuk membuka dashboard sesuai peran pengguna.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- GALERI FOTO -->
        <section class="mt-5" id="galeri">
            <h3 class="h4 judul-bagian">Galeri Foto Kegiatan</h3>
            <p class="text-white">Dokumentasi kegiatan TK PAUD Birrul Walidain.</p>
            <div class="garis-bagian"></div>

            <div class="row g-4">
                @forelse($galeris as $galeri)
                    <div class="col-md-6 col-lg-3">
                        <div class="kartu-konten">
                            @if($galeri->foto)
                                <img src="{{ asset('storage/' . $galeri->foto) }}"
                                     class="foto-galeri"
                                     alt="{{ $galeri->judul }}">
                            @else
                                <div class="foto-galeri d-flex align-items-center justify-content-center bg-light">
                                    <i class="bi bi-image fs-1 text-secondary"></i>
                                </div>
                            @endif

                            <div class="kartu-konten-body">
                                <h6 class="fw-bold">{{ $galeri->judul }}</h6>
                                <p class="text-secondary mb-0">
                                    {{ \Illuminate\Support\Str::limit($galeri->deskripsi ?? '', 100) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="kosong-konten">
                            <i class="bi bi-images fs-2 d-block mb-2"></i>
                            Belum ada foto kegiatan yang dipublikasikan.
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- VIDEO KEGIATAN -->
        <section class="mt-5" id="video">
            <h3 class="h4 judul-bagian">Video Kegiatan Sekolah</h3>
            <p class="text-white">Video pembelajaran dan kegiatan sekolah.</p>
            <div class="garis-bagian"></div>

            <div class="row g-4">
                @forelse($videos as $video)
                    <div class="col-md-6 col-lg-4">
                        <div class="kartu-konten">
                            @php
                                $urlVideo = $video->url_video ?? '';
                                $videoId = null;

                                if (preg_match('~(?:youtube\.com/(?:watch\?v=|embed/|shorts/)|youtu\.be/)([A-Za-z0-9_-]{11})~', $urlVideo, $cocok)) {
                                    $videoId = $cocok[1];
                                }
                            @endphp

                            @if($videoId)
                                <iframe class="video-frame"
                                        src="https://www.youtube-nocookie.com/embed/{{ $videoId }}"
                                        title="{{ $video->judul }}"
                                        allowfullscreen></iframe>
                            @else
                                <div class="p-4 text-center bg-light">
                                    <i class="bi bi-camera-video fs-1"></i>
                                    <p class="mb-2">Video tersedia melalui tautan berikut.</p>
                                    <a href="{{ $urlVideo }}" target="_blank" rel="noopener" class="btn btn-sekolah btn-sm">
                                        Tonton Video
                                    </a>
                                </div>
                            @endif

                            <div class="kartu-konten-body">
                                <h6 class="fw-bold">{{ $video->judul }}</h6>
                                <p class="text-secondary mb-0">
                                    {{ \Illuminate\Support\Str::limit($video->deskripsi ?? '', 110) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="kosong-konten">
                            <i class="bi bi-camera-video fs-2 d-block mb-2"></i>
                            Belum ada video kegiatan yang dipublikasikan.
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- INFORMASI SEKOLAH -->
        <section class="mt-5" id="informasi">
            <h3 class="h4 judul-bagian">Informasi Sekolah</h3>
            <p class="text-white">Berita dan informasi terbaru dari sekolah.</p>
            <div class="garis-bagian"></div>

            <div class="row g-4">
                @forelse($informasis as $informasi)
                    <div class="col-md-6 col-lg-4">
                        <div class="kartu-konten">
                            @if($informasi->gambar)
                                <img src="{{ asset('storage/' . $informasi->gambar) }}"
                                     class="foto-galeri"
                                     alt="{{ $informasi->judul }}">
                            @endif

                            <div class="kartu-konten-body">
                                <h6 class="fw-bold">{{ $informasi->judul }}</h6>

                                @if($informasi->tanggal_publikasi)
                                    <small class="text-secondary d-block mb-2">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ \Carbon\Carbon::parse($informasi->tanggal_publikasi)->format('d-m-Y') }}
                                    </small>
                                @endif

                                <p class="text-secondary mb-0">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($informasi->isi ?? ''), 180) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="kosong-konten">
                            <i class="bi bi-info-circle fs-2 d-block mb-2"></i>
                            Belum ada informasi sekolah yang dipublikasikan.
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- AGENDA SEKOLAH -->
        <section class="mt-5" id="agenda">
            <h3 class="h4 judul-bagian">Agenda Kegiatan Sekolah</h3>
            <p class="text-white">Jadwal kegiatan TK PAUD Birrul Walidain.</p>
            <div class="garis-bagian"></div>

            <div class="row g-3">
                @forelse($agendas as $agenda)
                    <div class="col-12">
                        <div class="kartu-konten p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="tanggal-agenda">
                                    <div class="fs-4">
                                        {{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('d') }}
                                    </div>
                                    <small>
                                        {{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('M Y') }}
                                    </small>
                                </div>

                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">{{ $agenda->judul }}</h6>
                                    <p class="text-secondary mb-1">
                                        {{ \Illuminate\Support\Str::limit($agenda->deskripsi ?? '', 150) }}
                                    </p>

                                    @if($agenda->tanggal_selesai)
                                        <small class="text-secondary">
                                            Sampai:
                                            {{ \Carbon\Carbon::parse($agenda->tanggal_selesai)->format('d-m-Y') }}
                                        </small>
                                    @endif

                                    @if($agenda->lokasi)
                                        <small class="text-secondary d-block">
                                            <i class="bi bi-geo-alt me-1"></i>{{ $agenda->lokasi }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="kosong-konten">
                            <i class="bi bi-calendar-event fs-2 d-block mb-2"></i>
                            Belum ada agenda kegiatan yang dipublikasikan.
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer>
        &copy; {{ date('Y') }} TK PAUD Birrul Walidain.
        Website Monitoring Perkembangan dan Evaluasi Belajar Anak Usia Dini.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>