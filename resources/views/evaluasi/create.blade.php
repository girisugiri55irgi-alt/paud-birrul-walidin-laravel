<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Evaluasi Anak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h2>Input Evaluasi Perkembangan Anak</h2>
    <p class="text-muted">PAUD Birrul Walidain</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('evaluasi.store') }}" method="POST" class="card card-body shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Anak</label>
            <select name="siswa_id" class="form-select" required>
                <option value="">-- Pilih Anak --</option>
                @foreach ($siswas as $siswa)
                    <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tahun Ajaran</label>
            <select name="tahun_ajaran_id" class="form-select" required>
                <option value="">-- Pilih Tahun Ajaran --</option>
                @foreach ($tahunAjarans as $tahun)
                    <option value="{{ $tahun->id }}">{{ $tahun->nama_tahun_ajaran }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Penilaian</label>
            <input type="date" name="tanggal_penilaian" class="form-control"
                   value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Agama dan Moral</label>
            <textarea name="agama_moral" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Kognitif</label>
            <textarea name="kognitif" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Motorik</label>
            <textarea name="motorik" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Sosial-Emosional</label>
            <textarea name="sosial_emosional" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Catatan Guru</label>
            <textarea name="catatan_guru" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Evaluasi</button>
        <a href="{{ route('evaluasi.index') }}" class="btn btn-secondary mt-2">Kembali</a>
    </form>
</div>
</body>
</html>