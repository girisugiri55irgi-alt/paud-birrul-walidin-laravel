<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Materi - TK PAUD Birrul Walidain</title>

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

        .navbar-custom {
            color: white;
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
            padding: 28px 0;
        }

        .kartu-form {
            max-width: 850px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .06);
        }

        .form-label {
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 9px;
            padding: 10px 12px;
        }

        .btn {
            border-radius: 9px;
        }

        @media (max-width: 576px) {
            .kartu-form {
                margin: 20px auto;
                padding: 20px 15px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark navbar-custom shadow-sm">
    <div class="container">
        <a href="{{ route('beranda') }}"
           class="navbar-brand d-flex align-items-center gap-2">

            <img src="{{ asset('images/logo1.jpeg') }}"
                 alt="Logo sekolah"
                 class="logo-sekolah">

            <span class="fw-bold">TK PAUD Birrul Walidain</span>
        </a>

        <a href="{{ route('materi.kelola') }}"
           class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left"></i> Daftar Materi
        </a>
    </div>
</nav>

<header class="header-biru">
    <div class="container">
        <h1 class="h3 fw-bold mb-2">
            <i class="bi bi-pencil-square"></i>
            Edit Materi Pembelajaran
        </h1>

        <p class="mb-0">
            Perbarui informasi materi pembelajaran anak.
        </p>
    </div>
</header>

<main class="container">
    <div class="kartu-form">

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Data belum dapat disimpan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('materi.update', $materi->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="judul" class="form-label">
                    Judul Materi <span class="text-danger">*</span>
                </label>

                <input type="text"
                       name="judul"
                       id="judul"
                       class="form-control @error('judul') is-invalid @enderror"
                       value="{{ old('judul', $materi->judul) }}"
                       maxlength="255"
                       required>

                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tema" class="form-label">Tema</label>

                    <input type="text"
                           name="tema"
                           id="tema"
                           class="form-control @error('tema') is-invalid @enderror"
                           value="{{ old('tema', $materi->tema) }}"
                           maxlength="255">

                    @error('tema')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="kelompok_usia" class="form-label">
                        Kelompok Usia
                    </label>

                    <input type="text"
                           name="kelompok_usia"
                           id="kelompok_usia"
                           class="form-control @error('kelompok_usia') is-invalid @enderror"
                           value="{{ old('kelompok_usia', $materi->kelompok_usia) }}"
                           maxlength="100"
                           placeholder="Contoh: Usia 4–5 tahun">

                    @error('kelompok_usia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Materi</label>

                <textarea name="deskripsi"
                          id="deskripsi"
                          rows="3"
                          class="form-control @error('deskripsi') is-invalid @enderror"
                          placeholder="Tuliskan ringkasan materi">{{ old('deskripsi', $materi->deskripsi) }}</textarea>

                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isi_materi" class="form-label">Isi Materi</label>

                <textarea name="isi_materi"
                          id="isi_materi"
                          rows="6"
                          class="form-control @error('isi_materi') is-invalid @enderror"
                          placeholder="Tuliskan isi pembelajaran">{{ old('isi_materi', $materi->isi_materi) }}</textarea>

                @error('isi_materi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="file_materi" class="form-label">
                    Ganti Berkas Materi (opsional)
                </label>

                @if ($materi->file_materi)
                    <div class="alert alert-primary py-2">
                        <i class="bi bi-file-earmark-check"></i>
                        Berkas saat ini:
                        <a href="{{ asset('storage/' . $materi->file_materi) }}"
                           target="_blank"
                           rel="noopener noreferrer">
                            {{ basename($materi->file_materi) }}
                        </a>

                        <div class="small mt-1">
                            Kosongkan pilihan berkas jika tidak ingin menggantinya.
                        </div>
                    </div>
                @endif

                <input type="file"
                       name="file_materi"
                       id="file_materi"
                       class="form-control @error('file_materi') is-invalid @enderror"
                       accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.jpeg,.png">

                <div class="form-text">
                    Format: PDF, DOC, DOCX, PPT, PPTX, JPG, JPEG, PNG.
                    Maksimal 10 MB.
                </div>

                @error('file_materi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>

            <div class="d-flex flex-wrap gap-2 justify-content-end">
                <a href="{{ route('materi.kelola') }}"
                   class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</main>

<footer class="text-center text-secondary py-4">
    <small>&copy; {{ date('Y') }} TK PAUD Birrul Walidain</small>
</footer>

</body>
</html>