@extends('layout.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-primary">Video Kegiatan</h3>
            <p class="text-muted mb-0">Kelola video kegiatan TK PAUD Birrul Walidin.</p>
        </div>

        <a href="{{ route('admin.konten.video.create') }}"
           class="btn btn-primary">
            + Tambah Video
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
                            <th width="60">No.</th>
                            <th>Judul Video</th>
                            <th>Tautan Video</th>
                            <th>Status</th>
                            <th width="190">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($videos as $video)
                            <tr>
                                <td>{{ $loop->iteration + ($videos->currentPage() - 1) * $videos->perPage() }}</td>

                                <td>
                                    <strong>{{ $video->judul }}</strong>
                                    <div class="small text-muted">
                                        {{ Str::limit($video->deskripsi, 70) }}
                                    </div>
                                </td>

                                <td>
                                    <a href="{{ $video->url_video }}"
                                       target="_blank"
                                       rel="noopener">
                                        Lihat tautan
                                    </a>
                                </td>

                                <td>
                                    @if($video->is_published)
                                        <span class="badge bg-success">Ditampilkan</span>
                                    @else
                                        <span class="badge bg-secondary">Disembunyikan</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.konten.video.edit', $video->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.konten.video.destroy', $video->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus video ini?')">
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
                                <td colspan="5" class="text-center text-muted py-4">
                                    Belum ada video kegiatan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $videos->links() }}

        </div>
    </div>

</div>
@endsection