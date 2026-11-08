<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tambah Materi - TK PAUD Birrul Walidain</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #f0f5ff;
            font-family: Arial, sans-serif;
            color: #263238;
        }

        .navbar-custom,
        .header-biru {
            background: linear-gradient(135deg, #0d6efd, #084298);
        }

        .logo-sekolah {
            width: 44px;
            height: 44px;
            object-fit: contain;
            background: white;
            border-radius: 50%;
            padding: 3px;
        }

        .header-biru {
            color: white;
            padding: 30px 0;
        }

        .kartu-form {
            max-width: 850px;
            margin: 30px auto;
            padding: 30px;
            background: white;
            border: none;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .06);
        }

        .form-label {
            font-weight: 600;
        }

        .form-control,
        .form-select {
            padding: 10px 12px;
            border-radius: 9px;
        }

        .btn {
            border-radius: 9px;
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

{{-- Navigasi --}}
<nav class="navbar navbar-dark navbar-custom shadow-sm">
    <div class="container">
        <a href="{{ route('beranda') }}"
           class="navbar-brand d-flex align-items-center gap-2">

            <img src="{{ asset('images/logo1.jpeg') }}"
                 alt="Logo TK PAUD Birrul Walidain"
                 class="logo-sekolah">

            <span class="fw-bold">TK PAUD Birrul Walidain</span>
        </a>

        <a href="{{ route('materi.kelola') }}"
           class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left me-1"></i>
            Daftar Materi
        </a>
    </div>
</nav>

{{-- Header halaman --}}
<header class="header-biru">
    <div class="container">
        <h1 class="h3 fw-bold mb-2">
            <i class="bi bi-journal-plus me-2"></i>
            Tambah Materi Pembelajaran
        </h1>

        <p class="mb-0">
            Tambahkan materi pembelajaran untuk anak usia dini.
        </p>
    </div>
</header>

{{-- Form tambah materi --}}
<main class="container">
    <div class="kartu-form">

        <div class="mb-4">
            <h5 class="fw-bold mb-1">Formulir Materi</h5>
            <p class="text-secondary small mb-0">
                Lengkapi informasi materi di bawah ini.
                Tanda <span class="text-danger">*</span> wajib diisi.
            </p>
        </div>

        {{-- Pesan validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    Materi belum dapat disimpan.
                </strong>

                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Tutup"></button>
            </div>
        @endif

        {{-- Pesan berhasil --}}
        @if (session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('materi.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            {{-- Judul --}}
            <div class="mb-3">
                <label for="judul" class="form-label">
                    Judul Materi <span class="text-danger">*</span>
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

            {{-- Tema dan kelompok usia --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tema" class="form-label">
                        Tema Pembelajaran
                    </label>

                    <input type="text"
                           name="tema"
                           id="tema"
                           class="form-control @error('tema') is-invalid @enderror"
                           value="{{ old('tema') }}"
                           maxlength="255"
                           placeholder="Contoh: Diriku, Binatang, Tanaman">

                    @error('tema')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="kelompok_usia" class="form-label">
                        Kelompok Usia
                    </label>

                    <select name="kelompok_usia"
                            id="kelompok_usia"
                            class="form-select @error('kelompok_usia') is-invalid @enderror">

                        <option value="">Pilih kelompok usia</option>

                        <option value="3-4 tahun"
                            {{ old('kelompok_usia') == '3-4 tahun' ? 'selected' : '' }}>
                            3–4 tahun
                        </option>

                        <option value="4-5 tahun"
                            {{ old('kelompok_usia') == '4-5 tahun' ? 'selected' : '' }}>
                            4–5 tahun
                        </option>

                        <option value="5-6 tahun"
                            {{ old('kelompok_usia') == '5-6 tahun' ? 'selected' : '' }}>
                            5–6 tahun
                        </option>
                    </select>

                    @error('kelompok_usia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label for="deskripsi" class="form-label">
                    Deskripsi Materi
                </label>

                <textarea name="deskripsi"
                          id="deskripsi"
                          rows="3"
                          class="form-control @error('deskripsi') is-invalid @enderror"
                          placeholder="Tuliskan ringkasan materi pembelajaran">{{ old('deskripsi') }}</textarea>

                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Isi materi --}}
            <div class="mb-3">
                <label for="isi_materi" class="form-label">
                    Isi Materi
                </label>

                <textarea name="isi_materi"
                          id="isi_materi"
                          rows="6"
                          class="form-control @error('isi_materi') is-invalid @enderror"
                          placeholder="Tuliskan materi atau petunjuk kegiatan anak">{{ old('isi_materi') }}</textarea>

                @error('isi_materi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Upload file --}}
            <div class="mb-4">
                <label for="file_materi" class="form-label">
                    <i class="bi bi-paperclip me-1"></i>
                    Unggah File Materi
                </label>

                <input type="file"
                       name="file_materi"
                       id="file_materi"
                       class="form-control @error('file_materi') is-invalid @enderror"
                       accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.jpeg,.png">

                <div class="form-text">
                    Format yang didukung: PDF, Word, PowerPoint, dan gambar.
                    Ukuran maksimal 10 MB.
                </div>

                @error('file_materi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr class="my-4">

            {{-- Tombol --}}
            <div class="d-flex flex-wrap justify-content-end gap-2">
                <a href="{{ route('materi.kelola') }}"
                   class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-1"></i>
                    Batal
                </a>

                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i>
                    Simpan Materi
                </button>
            </div>

        </form>
    </div>
</main>

<footer class="text-center text-secondary py-4">
    <small>
        &copy; {{ date('Y') }} TK PAUD Birrul Walidain
    </small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>