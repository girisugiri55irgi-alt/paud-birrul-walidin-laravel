<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Tugas - TK PAUD Birrul Walidain</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: #f0f5ff;
            color: #263238;
            font-family: Arial, sans-serif;
        }

        .navbar-biru,
        .header-biru {
            background: linear-gradient(135deg, #0d6efd, #084298);
        }

        .logo-sekolah {
            width: 46px;
            height: 46px;
            object-fit: contain;
            background: white;
            border-radius: 50%;
            padding: 3px;
        }

        .header-biru {
            color: white;
            padding: 28px 0;
        }

        .kartu-form {
            max-width: 850px;
            margin: 30px auto;
            padding: 30px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .06);
        }

        .form-label {
            font-weight: 600;
        }

        .form-control {
            padding: 10px 12px;
            border-radius: 9px;
        }

        .btn {
            border-radius: 9px;
        }

        .ikon-form {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #e7f1ff;
            color: #0d6efd;
            font-size: 24px;
        }

        @media (max-width: 576px) {
            .header-biru {
                padding: 22px 0;
            }

            .kartu-form {
                margin: 20px auto;
                padding: 20px 15px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark navbar-biru shadow-sm">
    <div class="container">
        <a href="{{ route('beranda') }}"
           class="navbar-brand d-flex align-items-center gap-2">
            <img src="{{ asset('images/logo1.jpeg') }}"
                 alt="Logo TK PAUD Birrul Walidain"
                 class="logo-sekolah">
            <span class="fw-bold">TK PAUD Birrul Walidain</span>
        </a>

        <a href="{{ route('tugas.index') }}" class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Daftar Tugas
        </a>
    </div>
</nav>

<header class="header-biru">
    <div class="container">
        <h1 class="h3 fw-bold mb-2">
            <i class="bi bi-journal-plus me-2"></i>
            Tambah Tugas Anak
        </h1>
        <p class="mb-0">
            Buat tugas dan kegiatan pembelajaran untuk anak usia dini.
        </p>
    </div>
</header>

<main class="container">
    <div class="kartu-form">

        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="ikon-form">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-1">Formulir Tugas</h5>
                <p class="text-secondary small mb-0">
                    Lengkapi informasi tugas berikut.
                </p>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Tugas belum dapat disimpan.</strong>
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

        <form action="{{ route('tugas.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="judul" class="form-label">
                    Judul Tugas <span class="text-danger">*</span>
                </label>
                <input type="text"
                       name="judul"
                       id="judul"
                       class="form-control @error('judul') is-invalid @enderror"
                       value="{{ old('judul') }}"
                       maxlength="255"
                       placeholder="Contoh: Mengenal Angka 1–10"
                       required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">
                    Deskripsi / Instruksi Tugas
                </label>
                <textarea name="deskripsi"
                          id="deskripsi"
                          rows="4"
                          class="form-control @error('deskripsi') is-invalid @enderror"
                          placeholder="Tuliskan petunjuk kegiatan yang harus dilakukan anak">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deadline" class="form-label">
                    <i class="bi bi-calendar-check me-1 text-primary"></i>
                    Batas Pengumpulan Tugas
                </label>
                <input type="date"
                       name="deadline"
                       id="deadline"
                       min="{{ date('Y-m-d') }}"
                       class="form-control @error('deadline') is-invalid @enderror"
                       value="{{ old('deadline') }}">
                @error('deadline')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="file_materi" class="form-label">
                    <i class="bi bi-paperclip me-1 text-primary"></i>
                    Materi / Video Pembelajaran (Opsional)
                </label>
                <input type="file"
                       name="file_materi"
                       id="file_materi"
                       class="form-control @error('file_materi') is-invalid @enderror"
                       accept=".pdf,.doc,.docx,.mp4,.webm,.mov,.avi,.jpg,.jpeg,.png">
                <div class="form-text">
                    Format PDF, DOC, DOCX, MP4, WebM, MOV, AVI, JPG, JPEG,
                    atau PNG. Ukuran maksimal 50 MB.
                </div>
                @error('file_materi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr class="my-4">

            <div class="d-flex flex-wrap justify-content-end gap-2">
                <a href="{{ route('tugas.index') }}"
                   class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </a>

                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i> Simpan Tugas
                </button>
            </div>
        </form>
    </div>
</main>

<footer class="text-center text-secondary py-4">
    <small>&copy; {{ date('Y') }} TK PAUD Birrul Walidain</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>