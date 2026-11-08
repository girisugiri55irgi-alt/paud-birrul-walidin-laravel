<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Detail Pendaftar SPMB - TK PAUD Birrul Walidain</title>

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

        .section-title {
            color: #0d6efd;
            font-weight: 700;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .info-label {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 4px;
        }

        .info-value {
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .school-logo {
            width: 42px;
            height: 42px;
            object-fit: cover;
            border-radius: 50%;
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

        <a href="{{ url('/admin/spmb') }}"
           class="btn btn-light btn-sm">
            &larr; Daftar Pendaftar
        </a>

    </div>
</nav>

<div class="container py-4">

    <div class="mb-4">
        <h2 class="fw-bold text-primary mb-1">
            Detail Pendaftar SPMB
        </h2>

        <p class="text-muted mb-0">
            Informasi calon murid dan pengelolaan hasil seleksi.
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Tutup"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">

        {{-- Informasi calon murid --}}
        <div class="col-lg-7">

            <div class="card content-card h-100">
                <div class="card-body p-4">

                    <h5 class="section-title">
                        <span class="me-2">👤</span>
                        Informasi Calon Murid
                    </h5>

                    <div class="mb-4">
                        <div class="info-label">Nomor Pendaftaran</div>
                        <div class="info-value text-primary fs-5">
                            {{ $pendaftaran->nomor_pendaftaran }}
                        </div>
                    </div>

                    <div class="row g-4">

                        <div class="col-md-6">
                            <div class="info-label">Nama Calon Murid</div>
                            <div class="info-value">
                                {{ $pendaftaran->nama_calon }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Tanggal Lahir</div>
                            <div class="info-value">
                                {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('d-m-Y') }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Jenis Kelamin</div>
                            <div class="info-value">
                                {{ $pendaftaran->jenis_kelamin }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Nama Orang Tua</div>
                            <div class="info-value">
                                {{ $pendaftaran->nama_orang_tua }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Nomor HP</div>
                            <div class="info-value">
                                {{ $pendaftaran->no_hp }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Email</div>
                            <div class="info-value">
                                {{ $pendaftaran->email ?: '-' }}
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="info-label">Alamat</div>
                            <div class="info-value">
                                {{ $pendaftaran->alamat }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        {{-- Formulir status seleksi --}}
        <div class="col-lg-5">

            <div class="card content-card h-100">
                <div class="card-body p-4">

                    <h5 class="section-title">
                        <span class="me-2">📋</span>
                        Pengelolaan Seleksi
                    </h5>

                    <div class="mb-4">
                        <div class="info-label">Status Saat Ini</div>

                        @if ($pendaftaran->status === 'diterima')
                            <span class="badge text-bg-success fs-6">
                                Diterima
                            </span>
                        @elseif ($pendaftaran->status === 'tidak_diterima')
                            <span class="badge text-bg-danger fs-6">
                                Tidak Diterima
                            </span>
                        @else
                            <span class="badge text-bg-warning fs-6">
                                Menunggu Seleksi
                            </span>
                        @endif
                    </div>

                    <form action="{{ url('/admin/spmb/' . $pendaftaran->id . '/status') }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">
                                Status Seleksi
                            </label>

                            <select name="status"
                                    id="status"
                                    class="form-select"
                                    required>

                                <option value="menunggu"
                                    {{ old('status', $pendaftaran->status) === 'menunggu' ? 'selected' : '' }}>
                                    Menunggu Seleksi
                                </option>

                                <option value="diterima"
                                    {{ old('status', $pendaftaran->status) === 'diterima' ? 'selected' : '' }}>
                                    Diterima
                                </option>

                                <option value="tidak_diterima"
                                    {{ old('status', $pendaftaran->status) === 'tidak_diterima' ? 'selected' : '' }}>
                                    Tidak Diterima
                                </option>

                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="catatan_seleksi"
                                   class="form-label fw-semibold">
                                Catatan Seleksi
                            </label>

                            <textarea name="catatan_seleksi"
                                      id="catatan_seleksi"
                                      rows="5"
                                      maxlength="2000"
                                      class="form-control"
                                      placeholder="Masukkan catatan hasil seleksi atau alasan keputusan...">{{ old('catatan_seleksi', $pendaftaran->catatan_seleksi) }}</textarea>

                            <div class="form-text">
                                Catatan maksimal 2.000 karakter.
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Simpan Perubahan Status
                        </button>

                    </form>

                    @if ($pendaftaran->tanggal_diumumkan)
                        <div class="mt-3 small text-muted">
                            Tanggal pengumuman:
                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_diumumkan)->format('d-m-Y H:i') }}
                        </div>
                    @endif

                </div>
            </div>

        </div>

    </div>

    <div class="mt-4">
        <a href="{{ url('/admin/spmb') }}"
           class="btn btn-outline-primary">
            &larr; Kembali ke Daftar Pendaftar
        </a>
    </div>

    <div class="text-center text-muted small mt-4">
        TK PAUD Birrul Walidain &copy; {{ date('Y') }}
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>