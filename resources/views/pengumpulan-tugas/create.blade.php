<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kirim Tugas Anak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a href="{{ route('pengumpulan-tugas.index') }}"
           class="navbar-brand">TK PAUD Birrul Walidain</a>
    </div>
</nav>

<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-3">
                    <h4 class="mb-1">Kirim Tugas Anak</h4>
                    <p class="text-secondary mb-0">
                        Isi jawaban atau unggah hasil pekerjaan anak.
                    </p>
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

                    <div class="mb-3">
                        <label class="form-label">Nama Siswa</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $siswa->nama }}"
                               readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Judul Tugas</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $tugas->judul }}"
                               readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Tugas</label>
                        <div class="border rounded bg-light p-3">
                            {{ $tugas->deskripsi ?: 'Tidak ada deskripsi tugas.' }}
                        </div>
                    </div>

                    <form action="{{ route('pengumpulan-tugas.store', $tugas->id) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="jawaban" class="form-label">
                                Jawaban atau Catatan Pekerjaan
                            </label>
                            <textarea name="jawaban"
                                      id="jawaban"
                                      rows="5"
                                      class="form-control"
                                      placeholder="Tuliskan keterangan hasil pekerjaan anak...">{{ old('jawaban') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="file_jawaban" class="form-label">
                                Berkas Hasil Pekerjaan (opsional)
                            </label>
                            <input type="file"
                                   name="file_jawaban"
                                   id="file_jawaban"
                                   class="form-control"
                                   accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <div class="form-text">
                                Format PDF, Word, atau gambar. Ukuran maksimal 10 MB.
                            </div>
                        </div>

                        <div class="d-flex justify-content-between gap-2">
                            <a href="{{ route('pengumpulan-tugas.index') }}"
                               class="btn btn-outline-secondary">
                                Batal
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Kirim Tugas
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</main>

</body>
</html>