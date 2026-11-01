<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Guru - TK PAUD Birrul Walidin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background-color: #f3f6fa;
        }

        .navbar-custom {
            background-color: #0d6efd;
        }

        .form-card {
            border: none;
            border-radius: 12px;
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
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/dashboard') }}">
            <img src="{{ asset('images/logo1.jpeg') }}"
                 alt="Logo Sekolah"
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
        <div class="col-lg-8">

            <div class="mb-4">
                <h3 class="fw-bold text-primary">Edit Data Guru</h3>
                <p class="text-muted mb-0">
                    Perbarui informasi guru, kemudian tekan tombol Simpan Perubahan.
                </p>
            </div>

            <div class="card form-card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Formulir Data Guru</h5>
                </div>

                <div class="card-body p-4">

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

                    <form action="{{ route('guru.update', $guru) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input
                                type="text"
                                name="nip"
                                id="nip"
                                class="form-control @error('nip') is-invalid @enderror"
                                value="{{ old('nip', $guru->nip) }}"
                            >
                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Guru</label>
                            <input
                                type="text"
                                name="nama"
                                id="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $guru->nama) }}"
                                required
                            >
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $guru->email) }}"
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_telp" class="form-label">Nomor Telepon</label>
                            <input
                                type="text"
                                name="no_telp"
                                id="no_telp"
                                class="form-control @error('no_telp') is-invalid @enderror"
                                value="{{ old('no_telp', $guru->no_telp) }}"
                            >
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input
                                type="text"
                                name="jabatan"
                                id="jabatan"
                                class="form-control @error('jabatan') is-invalid @enderror"
                                value="{{ old('jabatan', $guru->jabatan) }}"
                            >
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>

                            <a href="{{ route('guru.index') }}" class="btn btn-secondary">
                                Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>