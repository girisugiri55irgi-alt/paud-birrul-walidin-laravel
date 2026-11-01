<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Foto Galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width:750px">
        <div class="card-header bg-primary text-white py-3">
            <h4 class="mb-0">Edit Foto Galeri</h4>
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

            <form action="{{ route('admin.konten.galeri.update', $galeri) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Judul Foto</label>
                    <input type="text" name="judul"
                           class="form-control"
                           value="{{ old('judul', $galeri->judul) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Foto Saat Ini</label>
                    <img src="{{ asset('storage/'.$galeri->foto) }}"
                         class="img-thumbnail mb-2"
                         style="width:200px;height:140px;object-fit:cover">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto"
                           class="form-control"
                           accept="image/jpeg,image/png,image/webp">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Urutan Tampilan</label>
                    <input type="number" name="urutan"
                           class="form-control"
                           value="{{ old('urutan', $galeri->urutan) }}" min="0">
                </div>

                <div class="form-check mb-4">
                    <input type="checkbox" name="is_published"
                           value="1" class="form-check-input"
                           id="published"
                           {{ old('is_published', $galeri->is_published) ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">
                        Terbitkan foto di halaman depan website
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>

                <a href="{{ route('admin.konten.galeri.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>
            </form>
        </div>
    </div>
</div>

</body>
</html>