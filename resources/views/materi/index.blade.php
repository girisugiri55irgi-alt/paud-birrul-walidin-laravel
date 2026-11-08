
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Materi PAUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Kelola Materi Pembelajaran</h2>
            <p class="text-muted mb-0">PAUD Birrul Walidain</p>
        </div>

        <a href="{{ route('materi.create') }}" class="btn btn-primary">
            + Tambah Materi
        </a>
    </div>

    @if(auth()->check() && auth()->user()->role === 'pendidik')
    <a href="{{ route('pendidik.dashboard') }}"
       class="btn btn-outline-secondary btn-sm mb-3">
        Kembali ke Dashboard Pendidik
    </a>
@elseif(auth()->check() && auth()->user()->role === 'administrator')
    <a href="{{ route('dashboard') }}"
       class="btn btn-outline-secondary btn-sm mb-3">
        Kembali ke Dashboard Administrator
    </a>
@else
    <a href="{{ route('beranda') }}"
       class="btn btn-outline-secondary btn-sm mb-3">
        Kembali ke Beranda
    </a>
@endif
    </a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No.</th>
                            <th>Judul Materi</th>
                            <th>Tema</th>
                            <th>Kelompok Usia</th>
                            <th>File</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($materis as $materi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $materi->judul }}</td>
                                <td>{{ $materi->tema ?: '-' }}</td>
                                <td>{{ $materi->kelompok_usia ?: '-' }}</td>
                                <td>
                                    @if ($materi->file_materi)
                                        <a href="{{ asset('storage/' . $materi->file_materi) }}"
                                           target="_blank" rel="noopener">
                                            Lihat file
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('materi.edit', $materi->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('materi.destroy', $materi->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus materi ini?')">
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
                                    Belum ada materi. Klik Tambah Materi untuk memulai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</body>
</html>
