<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Tugas - PAUD Birrul Walidain</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">
            PAUD Birrul Walidain
        </span>
    </div>
</nav>

<div class="container py-5">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">Edit Tugas Anak</h5>
        </div>

        <div class="card-body p-4">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa kembali data berikut:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tugas.update', $tugas->id) }}"
      method="POST"
      enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Judul Tugas
                    </label>

                    <input type="text"
                           name="judul"
                           class="form-control"
                           value="{{ old('judul', $tugas->judul) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Deskripsi Tugas
                    </label>

                    <textarea name="deskripsi"
                              class="form-control"
                              rows="4">{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Batas Pengumpulan
                    </label>

                    <input type="date"
                           name="deadline"
                           class="form-control"
                           value="{{ old('deadline', $tugas->deadline ? \Carbon\Carbon::parse($tugas->deadline)->format('Y-m-d') : '') }}">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        File Materi
                    </label>

                    @if ($tugas->file_materi)
                        <div class="mb-2">
                            File saat ini:
                            <a href="{{ asset('storage/' . $tugas->file_materi) }}"
                               target="_blank" rel="noopener">
                                Lihat File Materi
                            </a>
                        </div>
                    @endif

                    <input type="file"
                           name="file_materi"
                           class="form-control"
                           accept=".pdf,.doc,.docx,.mp4,.webm,.mov,.avi,.jpg,.jpeg,.png">

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti file.
                        Maksimal 50 MB.
                    </small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('tugas.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>