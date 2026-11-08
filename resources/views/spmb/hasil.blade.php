<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hasil Pendaftaran SPMB - PAUD Birrul Walidain</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: #f0f5ff;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            color: #263238;
        }

        .navbar-custom {
            background: #0d6efd;
        }

        .logo-sekolah {
            width: 48px;
            height: 48px;
            object-fit: contain;
            background: white;
            border-radius: 50%;
            padding: 3px;
        }

        .header-biru {
            background: linear-gradient(135deg, #0d6efd, #084298);
            color: white;
            padding: 30px 15px;
            text-align: center;
        }

        .kartu-hasil {
            max-width: 760px;
            margin: 35px auto;
            padding: 32px;
            background: white;
            border-radius: 18px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, .08);
        }

        .judul {
            color: #0d6efd;
        }

        /* Logo pada halaman hasil */
        .logo-cetak {
            display: block;
            width: 55px;
            height: 55px;
            max-width: 55px;
            max-height: 55px;
            object-fit: contain;
            margin: 0 auto 8px;
        }

        .table th {
            width: 42%;
            background: #eaf2ff;
            color: #263b5e;
        }

        .table th,
        .table td {
            padding: 13px;
            vertical-align: middle;
            overflow-wrap: anywhere;
        }

        .nomor-pendaftaran {
            color: #0d6efd;
            font-weight: 700;
        }

        .status-diterima {
            display: inline-block;
            background: #d1e7ff;
            color: #084298;
            border: 1px solid #9ec5fe;
            border-radius: 30px;
            padding: 7px 15px;
            font-weight: 700;
        }

        .btn {
            border-radius: 9px;
            padding: 10px 17px;
        }

        footer {
            color: #6c757d;
            font-size: 14px;
        }

        @media (max-width: 576px) {
            .kartu-hasil {
                margin: 20px auto;
                padding: 20px 15px;
            }

            .table th,
            .table td {
                font-size: 14px;
                padding: 10px 8px;
            }

            .table th {
                width: 45%;
            }
        }

        /* Pengaturan khusus saat dicetak */
        @media print {
            @page {
                size: A4 portrait;
                margin: 12mm;
            }

            body {
                background: white !important;
                font-family: Arial, sans-serif;
                font-size: 12px;
                min-height: auto;
            }

            .navbar-custom,
            .header-biru,
            .tombol,
            footer {
                display: none !important;
            }

            .logo-cetak {
                display: block !important;
                width: 45px !important;
                height: 45px !important;
                min-width: 45px !important;
                min-height: 45px !important;
                max-width: 45px !important;
                max-height: 45px !important;
                object-fit: contain !important;
                margin: 0 auto 6px !important;
                padding: 0 !important;
            }

            .kartu-hasil {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 10px !important;
                box-shadow: none !important;
                border: none !important;
                border-radius: 0 !important;
            }

            .table-responsive {
                overflow: visible !important;
            }

            .table {
                width: 100% !important;
                border-collapse: collapse !important;
            }

            .table th,
            .table td {
                padding: 7px !important;
                font-size: 11px !important;
                overflow-wrap: anywhere;
            }

            .table th {
                background: #eaf2ff !important;
                color: #263b5e !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .alert {
                padding: 8px !important;
                margin-bottom: 10px !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            h4 {
                font-size: 16px !important;
            }

            h5 {
                font-size: 13px !important;
            }
        }
    </style>
</head>

<body>

{{-- Navigasi --}}
<nav class="navbar navbar-dark navbar-custom shadow-sm">
    <div class="container">
        <a href="{{ route('beranda') }}"
           class="navbar-brand d-flex align-items-center gap-2">

            <img src="{{ asset('images/logo1.jpeg') }}"
                 alt="Logo PAUD Birrul Walidain"
                 class="logo-sekolah">

            <span class="fw-bold">TK PAUD Birrul Walidain</span>
        </a>

        <a href="{{ route('beranda') }}"
           class="btn btn-light btn-sm">
            Beranda
        </a>
    </div>
</nav>

{{-- Header halaman --}}
<header class="header-biru">
    <div class="container">
        <h1 class="h3 fw-bold mb-2">
            Hasil Pengecekan Pendaftaran SPMB
        </h1>

        <p class="mb-0">
            Penerimaan Murid Baru TK PAUD Birrul Walidain
        </p>
    </div>
</header>

<div class="container">
    <div class="kartu-hasil">

        {{-- Judul dan logo untuk layar serta cetakan --}}
        <div class="text-center mb-4">

            <img src="{{ asset('images/logo1.jpeg') }}"
                 alt="Logo TK PAUD Birrul Walidain"
                 class="logo-cetak">

            <h4 class="judul fw-bold mt-2">
                TK PAUD Birrul Walidain
            </h4>

            <h5 class="fw-semibold">
                Hasil Pengecekan Pendaftaran SPMB
            </h5>

            <p class="text-secondary mb-0">
                Penerimaan Murid Baru Tahun {{ date('Y') }}
            </p>

            <hr>

            <h5 class="text-primary fw-bold mt-3">
                Data Pendaftaran Ditemukan
            </h5>

            <p class="text-secondary mb-0">
                Berikut informasi pendaftaran calon murid.
            </p>

        </div>

        {{-- Informasi pendaftaran --}}
        <div class="alert alert-primary">
            Nomor pendaftaran ditemukan. Silakan periksa informasi berikut.
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <th>Nomor Pendaftaran</th>
                        <td class="nomor-pendaftaran">
                            {{ $pendaftaran->nomor_pendaftaran }}
                        </td>
                    </tr>

                    <tr>
                        <th>Nama Calon Murid</th>
                        <td>{{ $pendaftaran->nama_calon }}</td>
                    </tr>

                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>
                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('d-m-Y') }}
                        </td>
                    </tr>

                    <tr>
                        <th>Nama Orang Tua</th>
                        <td>{{ $pendaftaran->nama_orang_tua }}</td>
                    </tr>

                    <tr>
                        <th>Tanggal Pendaftaran</th>
                        <td>
                            {{ $pendaftaran->created_at
                                ? $pendaftaran->created_at->format('d-m-Y H:i')
                                : '-' }}
                        </td>
                    </tr>

                    <tr>
                        <th>Status Seleksi</th>
                        <td>
                            @if ($pendaftaran->status === 'diterima')
                                <span class="status-diterima">
                                    DITERIMA
                                </span>
                            @elseif (in_array($pendaftaran->status, ['tidak_diterima', 'tidak diterima', 'ditolak']))
                                <span class="badge text-bg-danger fs-6">
                                    TIDAK DITERIMA
                                </span>
                            @else
                                <span class="badge text-bg-warning fs-6">
                                    MENUNGGU SELEKSI
                                </span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Catatan seleksi --}}
        @if ($pendaftaran->catatan_seleksi)
            <div class="alert alert-light border mt-3">
                <strong class="text-primary">
                    Catatan dari Sekolah
                </strong>

                <p class="mb-0 mt-2">
                    {{ $pendaftaran->catatan_seleksi }}
                </p>
            </div>
        @endif

        {{-- Pesan sesuai status --}}
        @if ($pendaftaran->status === 'menunggu')
            <div class="alert alert-warning mt-3">
                <strong>
                    Pendaftaran masih dalam proses seleksi.
                </strong>

                <p class="mb-0 mt-1">
                    Silakan periksa kembali secara berkala untuk mengetahui
                    hasil terbaru dari pihak sekolah.
                </p>
            </div>

        @elseif ($pendaftaran->status === 'diterima')
            <div class="alert alert-primary mt-3">
                <h5 class="fw-bold">
                    Selamat! Calon Murid Dinyatakan Diterima
                </h5>

                <p class="mb-0">
                    Silakan mengikuti informasi lanjutan dari pihak sekolah.
                </p>
            </div>

        @elseif (in_array($pendaftaran->status, ['tidak_diterima', 'tidak diterima', 'ditolak']))
            <div class="alert alert-danger mt-3">
                <strong>
                    Calon murid belum dinyatakan diterima.
                </strong>

                <p class="mb-0 mt-1">
                    Silakan membaca catatan seleksi atau menghubungi pihak sekolah.
                </p>
            </div>
        @endif

        {{-- Tombol tindakan --}}
        <div class="d-flex flex-wrap gap-2 tombol mt-4">

            <button onclick="window.print()"
                    class="btn btn-primary">
                Cetak Hasil
            </button>

            <a href="{{ route('spmb.cek') }}"
               class="btn btn-outline-primary">
                Cek Nomor Lain
            </a>

            <a href="{{ route('beranda') }}"
               class="btn btn-secondary">
                Kembali ke Beranda
            </a>

        </div>

    </div>
</div>

<footer class="text-center py-4">
    &copy; {{ date('Y') }} TK PAUD Birrul Walidain
</footer>

</body>
</html>