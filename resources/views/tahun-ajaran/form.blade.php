<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Tahun Ajaran - PAUD Birrul Walidin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h2 class="mb-4">
        {{ $item->exists ? 'Edit Tahun Ajaran' : 'Tambah Tahun Ajaran' }}
    </h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Data belum valid.</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form
                action="{{ $item->exists
                    ? route('tahun-ajaran.update', $item->id)
                    : route('tahun-ajaran.store') }}"
                method="POST"
            >
                @csrf

                @if($item->exists)
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">Nama Tahun Ajaran</label>
                    <input
                        type="text"
                        name="nama_tahun_ajaran"
                        class="form-control"
                        placeholder="Contoh: 2026/2027"
                        value="{{ old('nama_tahun_ajaran', $item->nama_tahun_ajaran) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input
                        type="date"
                        name="tanggal_mulai"
                        class="form-control"
                        value="{{ old('tanggal_mulai', $item->tanggal_mulai?->format('Y-m-d')) }}"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Selesai</label>
                    <input
                        type="date"
                        name="tanggal_selesai"
                        class="form-control"
                        value="{{ old('tanggal_selesai', $item->tanggal_selesai?->format('Y-m-d')) }}"
                    >
                </div>

                <div class="mb-4">
                    <label class="form-label">Status Tahun Ajaran</label>
                    <select name="aktif" class="form-select" required>
                        <option value="1"
                            {{ (string) old('aktif', $item->exists ? (int) $item->aktif : 1) === '1' ? 'selected' : '' }}>
                            Aktif
                        </option>
                        <option value="0"
                            {{ (string) old('aktif', $item->exists ? (int) $item->aktif : 1) === '0' ? 'selected' : '' }}>
                            Tidak Aktif
                        </option>
                    </select>
                    <small class="text-muted">
                        Hanya satu tahun ajaran yang sebaiknya berstatus aktif.
                    </small>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('tahun-ajaran.index') }}"
                   class="btn btn-secondary">
                    Batal
                </a>
            </form>
        </div>
    </div>
</div>
</body>
</html>