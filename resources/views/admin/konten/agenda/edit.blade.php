<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Kegiatan Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width:800px">
        <div class="card-header bg-primary text-white py-3">
            <h4 class="mb-0">Edit Kegiatan Sekolah</h4>
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

            <form action="{{ route('admin.konten.agenda.update', $agenda) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Kegiatan</label>
                    <input type="text" name="judul" class="form-control"
                           value="{{ old('judul', $agenda->judul) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Kegiatan</label>
                    <textarea name="deskripsi" class="form-control" rows="5">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control"
                               value="{{ old('tanggal_mulai', $agenda->tanggal_mulai?->format('Y-m-d')) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control"
                               value="{{ old('tanggal_selesai', $agenda->tanggal_selesai?->format('Y-m-d')) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi Kegiatan</label>
                    <input type="text" name="lokasi" class="form-control"
                           value="{{ old('lokasi', $agenda->lokasi) }}">
                </div>

                <div class="form-check mb-4">
                    <input type="checkbox" name="is_published" value="1"
                           class="form-check-input" id="published"
                           {{ old('is_published', $agenda->is_published) ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">
                        Terbitkan kegiatan di halaman depan website
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.konten.agenda.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>