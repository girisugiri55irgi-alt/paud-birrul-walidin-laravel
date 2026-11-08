<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kegiatan Sekolah - PAUD Birrul Walidin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark" style="background:linear-gradient(90deg,#0756a5,#1685d4)">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/dashboard') }}">PAUD Birrul Walidin</a>
        <a href="{{ url('/dashboard') }}" class="btn btn-light btn-sm">Kembali ke Dashboard</a>
    </div>
</nav>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-primary">Kegiatan Sekolah</h3>
            <p class="text-muted mb-0">Kelola agenda dan jadwal kegiatan sekolah.</p>
        </div>
        <a href="{{ route('admin.konten.agenda.create') }}" class="btn btn-primary">
            + Tambah Kegiatan
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
                            <th width="55">No</th>
                            <th>Nama Kegiatan</th>
                            <th width="130">Tanggal Mulai</th>
                            <th width="130">Tanggal Selesai</th>
                            <th>Lokasi</th>
                            <th width="100">Status</th>
                            <th width="145">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($agendas as $index => $agenda)
                            <tr>
                                <td>{{ $agendas->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $agenda->judul }}</strong>
                                    <div class="small text-muted">
                                        {{ \Illuminate\Support\Str::limit($agenda->deskripsi, 80) }}
                                    </div>
                                </td>
                                <td>{{ $agenda->tanggal_mulai?->format('d-m-Y') ?? '-' }}</td>
                                <td>{{ $agenda->tanggal_selesai?->format('d-m-Y') ?? '-' }}</td>
                                <td>{{ $agenda->lokasi ?: '-' }}</td>
                                <td>
                                    @if($agenda->is_published)
                                        <span class="badge bg-success">Terbit</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.konten.agenda.edit', $agenda) }}"
                                       class="btn btn-warning btn-sm">Edit</a>

                                    <form action="{{ route('admin.konten.agenda.destroy', $agenda) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Belum ada kegiatan sekolah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $agendas->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
</body>
</html>