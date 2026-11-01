<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $guru->exists ? 'Edit' : 'Tambah' }} Data Guru - TK PAUD Birrul Walidin</title>

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

        .form-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
        }

        .form-label {
            font-weight: 600;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center"
           href="{{ url('/dashboard') }}">
            <img src="{{ asset('images/logo1.jpeg') }}"
                 alt="Logo TK PAUD Birrul Walidin"
                 width="42"
                 height="42"
                 class="me-2 rounded-circle"
                 style="object-fit: cover;">
            <span>TK PAUD Birrul Walidin</span>
        </a>

        <a href="{{ route('guru.index') }}" class="btn btn-light btn-sm">
            Kembali ke Data Guru
        </a>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            <div class="mb-4">
                <h2 class="fw-bold text-primary">
                    {{ $guru->exists ? 'Edit Data Guru' : 'Tambah Data Guru' }}
                </h2>

                <p class="text-muted">
                    {{ $guru->exists
                        ? 'Perbarui informasi guru dan akun login.'
                        : 'Masukkan informasi guru sekaligus buat akun login.' }}
                </p>
            </div>

            <div class="card form-card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        Formulir {{ $guru->exists ? 'Edit' : 'Tambah' }} Guru
                    </h5>
                </div>

                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Periksa kembali data yang dimasukkan.</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form
                        action="{{ $guru->exists
                            ? route('guru.update', $guru)
                            : route('guru.store') }}"
                        method="POST">

                        @csrf

                        @if ($guru->exists)
                            @method('PUT')
                        @endif

                        {{-- NIP --}}
                        <div class="mb-3">
                            <label for="nip" class="form-label">
                                NIP
                                <span class="text-muted fw-normal">(boleh kosong)</span>
                            </label>

                            <input
                                type="text"
                                id="nip"
                                name="nip"
                                class="form-control @error('nip') is-invalid @enderror"
                                value="{{ old('nip', $guru->nip) }}"
                                placeholder="Masukkan NIP guru">

                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="nama" class="form-label">
                                Nama Lengkap Guru <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $guru->nama) }}"
                                placeholder="Masukkan nama lengkap guru"
                                required>

                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email untuk Login <span class="text-danger">*</span>
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $guru->email) }}"
                                placeholder="contoh@email.com"
                                autocomplete="email"
                                required>

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="form-text">
                                Email harus unik dan akan digunakan guru untuk masuk ke aplikasi.
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                {{ $guru->exists ? 'Password Baru' : 'Password Awal' }}

                                @if (!$guru->exists)
                                    <span class="text-danger">*</span>
                                @else
                                    <span class="text-muted fw-normal">(opsional)</span>
                                @endif
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                minlength="8"
                                autocomplete="new-password"
                                placeholder="{{ $guru->exists
                                    ? 'Kosongkan jika tidak ingin mengganti password'
                                    : 'Minimal 8 karakter' }}"
                                {{ !$guru->exists ? 'required' : '' }}>

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="form-text">
                                Minimal 8 karakter.
                                @if ($guru->exists)
                                    Kosongkan jika password tidak ingin diubah.
                                @else
                                    Password ini digunakan guru untuk login.
                                @endif
                            </div>
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">
                                Konfirmasi Password
                                @if (!$guru->exists)
                                    <span class="text-danger">*</span>
                                @endif
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control"
                                minlength="8"
                                autocomplete="new-password"
                                placeholder="Ketik ulang password"
                                {{ !$guru->exists ? 'required' : '' }}>
                        </div>

                        {{-- Nomor Telepon --}}
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">
                                Nomor Telepon
                            </label>

                            <input
                                type="text"
                                id="no_telp"
                                name="no_telp"
                                class="form-control @error('no_telp') is-invalid @enderror"
                                value="{{ old('no_telp', $guru->no_telp) }}"
                                placeholder="Masukkan nomor telepon">

                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jabatan --}}
                        <div class="mb-4">
                            <label for="jabatan" class="form-label">
                                Jabatan
                            </label>

                            <input
                                type="text"
                                id="jabatan"
                                name="jabatan"
                                class="form-control @error('jabatan') is-invalid @enderror"
                                value="{{ old('jabatan', $guru->jabatan) }}"
                                placeholder="Contoh: Guru Kelompok A">

                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary px-4">
                                {{ $guru->exists ? 'Simpan Perubahan' : 'Simpan Data dan Akun' }}
                            </button>

                            <a href="{{ route('guru.index') }}"
                               class="btn btn-outline-secondary px-4">
                                Batal
                            </a>
                        </div>

                    </form>
                </div>
            </div>

            <p class="text-center text-muted small mt-4">
                TK PAUD Birrul Walidin &copy; {{ date('Y') }}
            </p>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>