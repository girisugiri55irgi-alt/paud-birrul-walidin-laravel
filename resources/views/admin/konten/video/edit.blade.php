@extends('layout.app')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <h3 class="fw-bold text-primary">Edit Video Kegiatan</h3>
        <p class="text-muted">Perbarui informasi video kegiatan sekolah.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <form action="{{ route('admin.konten.video.update', $video->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Video</label>
                    <input type="text"
                           name="judul"
                           class="form-control"
                           value="{{ old('judul', $video->judul) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="4">{{ old('deskripsi', $video->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">URL Video YouTube</label>
                    <input type="url"
                           name="url_video"
                           class="form-control"
                           value="{{ old('url_video', $video->url_video) }}"
                           required>
                </div>

                <div class="form-check form-switch mb-4">
                    <input type="checkbox"
                           name="is_published"
                           value="1"
                           class="form-check-input"
                           id="is_published"
                           {{ old('is_published', $video->is_published) ? 'checked' : '' }}>

                    <label class="form-check-label" for="is_published">
                        Tampilkan video di halaman utama website
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>

                <a href="{{ route('admin.konten.video.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>
@endsection