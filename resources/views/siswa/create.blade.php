<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Siswa - PAUD Birrul Walidin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f0f5ff;
            font-family: Arial, sans-serif;
            color: #243247;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #0d47a1, #1976d2);
        }

        .school-logo {
            width: 45px;
            height: 45px;
            object-fit: contain;
            background: white;
            border-radius: 50%;
            padding: 3px;
        }

        .page-title {
            color: #0d47a1;
            font-weight: 700;
        }

        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(13, 71, 161, 0.08);
        }

        .form-label {
            font-weight: 600;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #1976d2;
            box-shadow: 0 0 0 0.2rem rgba(25, 118, 210, 0.15);
        }

        .btn-primary {
            background: #1565c0;
            border-color: #1565c0;
        }

        .btn-primary:hover {
            background: #0d47a1;
            border-color: #0d47a1;
        }

        .section-title {
            color: #0d47a1;
            font-weight: 700;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark navbar-custom shadow-sm">
    <div class="container-fluid px-3 px-md-4">
        <a class="navbar-brand d-flex align-items-center gap-3"
           href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo1.jpeg') }}"
                 alt="Logo sekolah"
                 class="school-logo"
                 onerror="this.style.display='none'">
            <span>
                <strong>PAUD Birrul Walidin</strong>
                <small class="d-block text-white-50">
                    Sistem Monitoring Perkembangan Anak
                </small>
            </span>
        </a>

        <a href="{{ route('siswa.index') }}"
           class="btn btn-light btn-sm text-primary fw-semibold">
            ← Kembali
        </a>
    </div>
</nav>

<main class="container py-4">
    <div class="mb-4">
        <h2 class="page-title mb-1">Tambah Data Siswa</h2>
        <p class="text-secondary mb-0">
            Isi identitas siswa dan buat akun login untuk orang tua.
        </p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Data belum dapat disimpan.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('siswa.store') }}" method="POST">
        @csrf

        <div class="card mb-4">
            <div class="card-body p-4 p-md-5">
                <h5 class="section-title mb-3">
                    <i class="bi bi-person-fill"></i>
                    A. Identitas Siswa
                </h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text"
                               class="form-control @error('nis') is-invalid @enderror"
                               id="nis" name="nis"
                               value="{{ old('nis') }}" required>
                        @error('nis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Siswa</label>
                        <input type="text"
                               class="form-control @error('nama') is-invalid @enderror"
                               id="nama" name="nama"
                               value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="tanggal_lahir" class="form-label">
                            Tanggal Lahir
                        </label>
                        <input type="date"
                               class="form-control @error('tanggal_lahir') is-invalid @enderror"
                               id="tanggal_lahir" name="tanggal_lahir"
                               value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="jenis_kelamin" class="form-label">
                            Jenis Kelamin
                        </label>
                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki"
                                {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="Perempuan"
                                {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="kelas" class="form-label">Kelas</label>
                        <input type="text"
                               class="form-control @error('kelas') is-invalid @enderror"
                               id="kelas" name="kelas"
                               value="{{ old('kelas') }}"
                               placeholder="Contoh: Kelompok A">
                        @error('kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="nama_orang_tua" class="form-label">
                            Nama Orang Tua
                        </label>
                        <input type="text"
                               class="form-control @error('nama_orang_tua') is-invalid @enderror"
                               id="nama_orang_tua" name="nama_orang_tua"
                               value="{{ old('nama_orang_tua') }}" required>
                        @error('nama_orang_tua')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body p-4 p-md-5">
                <h5 class="section-title mb-2">B. Akun Login Orang Tua</h5>
                <p class="text-secondary">
                    Akun ini digunakan orang tua untuk masuk ke aplikasi dan
                    melihat informasi perkembangan anak.
                </p>

                <div class="row g-3">
                    <div class="col-12">
                        <label for="email_orang_tua" class="form-label">
                            Email Login Orang Tua
                        </label>
                        <input type="email"
                               class="form-control @error('email_orang_tua') is-invalid @enderror"
                               id="email_orang_tua" name="email_orang_tua"
                               value="{{ old('email_orang_tua') }}"
                               placeholder="contoh@email.com" required>
                        @error('email_orang_tua')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password_orang_tua" class="form-label">
                            Password
                        </label>
                        <input type="password"
                               class="form-control @error('password_orang_tua') is-invalid @enderror"
                               id="password_orang_tua"
                               name="password_orang_tua"
                               minlength="8" required
                               autocomplete="new-password">
                        <div class="form-text">Minimal 8 karakter.</div>
                        @error('password_orang_tua')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password_orang_tua_confirmation"
                               class="form-label">
                            Konfirmasi Password
                        </label>
                        <input type="password"
                               class="form-control"
                               id="password_orang_tua_confirmation"
                               name="password_orang_tua_confirmation"
                               minlength="8" required
                               autocomplete="new-password">
                    </div>
                </div>

                <div class="alert alert-info mt-4 mb-0">
                    <strong>Informasi:</strong> Setelah data disimpan,
                    akun orang tua akan dibuat dengan peran
                    <code>orang_tua</code>. Simpan email dan password
                    untuk disampaikan kepada orang tua secara aman.
                </div>
            </div>
        </div>

        <div class="d-flex flex-column flex-sm-row gap-2 justify-content-end">
            <a href="{{ route('siswa.index') }}"
               class="btn btn-outline-secondary px-4">
                Batal
            </a>
            <button type="submit" class="btn btn-primary px-4">
                Simpan Siswa dan Akun Orang Tua
            </button>
        </div>
    </form>

    <footer class="text-center text-secondary small mt-4">
        © {{ date('Y') }} PAUD Birrul Walidin
    </footer>
</main>

</body>
</html>