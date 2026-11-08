<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informasi Sekolah - PAUD Birrul Walidin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark"
     style="background:linear-gradient(90deg,#0756a5,#1685d4)">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/dashboard') }}">
            PAUD Birrul Walidin
        </a>
        <a href="{{ url('/dashboard') }}" class="btn btn-light btn-sm">
            Kembali ke Dashboard
        </a>
    </div>
</nav>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-primary">Informasi Sekolah</h3>
            <p class="text-muted mb-0">Kelola berita dan informasi sekolah.</p>
        </div>

        <a href="{{ route('admin.konten.informasi.create') }}"
           class="btn btn-primary">
            + Tambah Informasi
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th width="60">No</th>
                            <th width="130">Gambar</th>
                            <th>Judul Informasi</th>
                            <th width="170">Tanggal Publikasi</th>
                            <th width="110">Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($informasis as $index => $informasi)
                            <tr>
                                <td>{{ $informasis->firstItem() + $index }}</td>
                                <td>
                                    @if($informasi->gambar)
                                        <img src="{{ asset('storage/'.$informasi->gambar) }}"
                                             alt="{{ $informasi->judul }}"
                                             class="img-thumbnail"
                                             style="width:110px;height:75px;object-fit:cover">
                                    @else
                                        <span class="text-muted small">Tanpa gambar</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $informasi->judul }}</strong>
                                    <div class="small text-muted">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($informasi->isi), 100) }}
                                    </div>
                                </td>
                                <td>
                                    {{ $informasi->tanggal_publikasi
                                        ? $informasi->tanggal_publikasi->format('d-m-Y H:i')
                                        : '-' }}
                                </td>
                                <td>
                                    @if($informasi->is_published)
                                        <span class="badge bg-success">Terbit</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.konten.informasi.edit', $informasi) }}"
                                       class="btn btn-warning btn-sm">Edit</a>

                                    <form action="{{ route('admin.konten.informasi.destroy', $informasi) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus informasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Belum ada informasi sekolah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $informasis->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

</body>
</html>