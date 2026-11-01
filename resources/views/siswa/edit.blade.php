<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Siswa - PAUD Birrul Walidin</title>

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
        <h2 class="page-title mb-1">Edit Data Siswa</h2>
        <p class="text-secondary mb-0">
            Perbarui identitas anak didik yang dipilih.
        </p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Data belum dapat diperbarui.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('siswa.update', $siswa) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text"
                               class="form-control @error('nis') is-invalid @enderror"
                               id="nis"
                               name="nis"
                               value="{{ old('nis', $siswa->nis) }}"
                               required>
                        @error('nis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Siswa</label>
                        <input type="text"
                               class="form-control @error('nama') is-invalid @enderror"
                               id="nama"
                               name="nama"
                               value="{{ old('nama', $siswa->nama) }}"
                               required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="jenis_kelamin" class="form-label">
                            Jenis Kelamin
                        </label>
                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                id="jenis_kelamin"
                                name="jenis_kelamin"
                                required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki"
                                {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="Perempuan"
                                {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
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
                               id="kelas"
                               name="kelas"
                               value="{{ old('kelas', $siswa->kelas) }}"
                               placeholder="Contoh: Kelompok A">
                        @error('kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="nama_orang_tua" class="form-label">
                            Nama Orang Tua
                        </label>
                        <input type="text"
                               class="form-control @error('nama_orang_tua') is-invalid @enderror"
                               id="nama_orang_tua"
                               name="nama_orang_tua"
                               value="{{ old('nama_orang_tua', $siswa->nama_orang_tua) }}">
                        @error('nama_orang_tua')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex flex-column flex-sm-row gap-2 justify-content-end">
                    <a href="{{ route('siswa.index') }}"
                       class="btn btn-outline-secondary px-4">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <footer class="text-center text-secondary small mt-4">
        © {{ date('Y') }} PAUD Birrul Walidin
    </footer>
</main>

</body>
</html>