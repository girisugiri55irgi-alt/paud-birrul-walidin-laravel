<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri Foto - PAUD Birrul Walidin</title>
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
            <h3 class="fw-bold text-primary">Galeri Foto Sekolah</h3>
            <p class="text-muted mb-0">Kelola dokumentasi kegiatan sekolah.</p>
        </div>

        <a href="{{ route('admin.konten.galeri.create') }}"
           class="btn btn-primary">
            + Tambah Foto
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
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
                            <th width="130">Foto</th>
                            <th>Judul</th>
                            <th width="100">Urutan</th>
                            <th width="120">Status</th>
                            <th width="170">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($galeris as $index => $galeri)
                            <tr>
                                <td>{{ $galeris->firstItem() + $index }}</td>

                                <td>
                                    <img
                                        src="{{ asset('storage/'.$galeri->foto) }}"
                                        alt="{{ $galeri->judul }}"
                                        class="img-thumbnail"
                                        style="width:110px;height:75px;object-fit:cover">
                                </td>

                                <td>
                                    <strong>{{ $galeri->judul }}</strong>
                                    <div class="small text-muted">
                                        {{ $galeri->deskripsi }}
                                    </div>
                                </td>

                                <td>{{ $galeri->urutan }}</td>

                                <td>
                                    @if($galeri->is_published)
                                        <span class="badge bg-success">Terbit</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.konten.galeri.edit', $galeri) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.konten.galeri.destroy', $galeri) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
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
                                    Belum ada foto galeri.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $galeris->links('pagination::bootstrap-5') }}

        </div>
    </div>
</div>

</body>
</html>