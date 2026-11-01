
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Evaluasi Anak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Evaluasi Perkembangan Anak</h4>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa kembali data yang diisi:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('evaluasi.update', $evaluasi->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Anak</label>
                    <select name="siswa_id" class="form-select" required>
                        @foreach ($siswas as $siswa)
                            <option value="{{ $siswa->id }}"
                                @selected(old('siswa_id', $evaluasi->siswa_id) == $siswa->id)>
                                {{ $siswa->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Ajaran</label>
                    <select name="tahun_ajaran_id" class="form-select" required>
                        @foreach ($tahunAjarans as $tahun)
                            <option value="{{ $tahun->id }}"
                                @selected(old('tahun_ajaran_id', $evaluasi->tahun_ajaran_id) == $tahun->id)>
                                {{ $tahun->nama_tahun_ajaran }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Penilaian</label>
                    <input type="date"
                           name="tanggal_penilaian"
                           class="form-control"
                           value="{{ old('tanggal_penilaian', $evaluasi->tanggal_penilaian ? \Carbon\Carbon::parse($evaluasi->tanggal_penilaian)->format('Y-m-d') : '') }}"
                           required>
                </div>

                @php
                    $aspek = [
                        'agama_moral' => 'Agama dan Moral',
                        'kognitif' => 'Kognitif',
                        'motorik' => 'Motorik',
                        'sosial_emosional' => 'Sosial-Emosional',
                    ];

                    $pilihan = [
                        'BB' => 'BB - Belum Berkembang',
                        'MB' => 'MB - Mulai Berkembang',
                        'BSH' => 'BSH - Berkembang Sesuai Harapan',
                        'BSB' => 'BSB - Berkembang Sangat Baik',
                    ];
                @endphp

                @foreach ($aspek as $kolom => $label)
                    <div class="mb-3">
                        <label class="form-label">{{ $label }}</label>
                        <select name="{{ $kolom }}" class="form-select">
                            <option value="">-- Pilih penilaian --</option>
                            @foreach ($pilihan as $kode => $keterangan)
                                <option value="{{ $kode }}"
                                    @selected(old($kolom, $evaluasi->$kolom) == $kode)>
                                    {{ $keterangan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endforeach

                <div class="mb-3">
                    <label class="form-label">Catatan Guru</label>
                    <textarea name="catatan_guru"
                              class="form-control"
                              rows="4">{{ old('catatan_guru', $evaluasi->catatan_guru) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>

                <a href="{{ route('evaluasi.index') }}"
                   class="btn btn-secondary">
                    Batal
                </a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
