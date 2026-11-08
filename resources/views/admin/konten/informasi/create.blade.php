
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Informasi Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width:800px">
        <div class="card-header bg-primary text-white py-3">
            <h4 class="mb-0">Tambah Informasi Sekolah</h4>
        </div>

        <div class="card-body p-4">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.konten.informasi.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul Informasi</label>
                    <input type="text" name="judul" class="form-control"
                           value="{{ old('judul') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi Informasi</label>
                    <textarea name="isi" class="form-control" rows="7"
                              required>{{ old('isi') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar (Opsional)</label>
                    <input type="file" name="gambar" class="form-control"
                           accept="image/jpeg,image/png,image/webp">
                    <small class="text-muted">Format JPG, PNG, WEBP. Maksimal 2 MB.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Publikasi</label>
                    <input type="datetime-local" name="tanggal_publikasi"
                           class="form-control"
                           value="{{ old('tanggal_publikasi') }}">
                </div>

                <div class="form-check mb-4">
                    <input type="checkbox" name="is_published" value="1"
                           class="form-check-input" id="published"
                           {{ old('is_published') ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">
                        Terbitkan informasi di halaman depan website
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Informasi
                </button>

                <a href="{{ route('admin.konten.informasi.index') }}"
                   class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>