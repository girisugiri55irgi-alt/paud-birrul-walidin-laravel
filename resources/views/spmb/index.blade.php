<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPMB Online - PAUD Birrul Walidain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f7f2;
            font-family: Arial, sans-serif;
        }
        .header {
            background: #317fe6;
            color: white;
            padding: 28px 15px;
            text-align: center;
        }
        .form-card {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            border-radius: 15px;
            padding: 28px;
            box-shadow: 0 4px 18px rgba(0,0,0,.08);
        }
        .btn-daftar {
            background: #2b2ece;
            color: white;
            width: 100%;
            padding: 12px;
            font-weight: bold;
        }
        .btn-daftar:hover {
            background: #142c6c;
            color: white;
        }
    </style>
</head>
<body>

<header class="header">
    <h2>SPMB Online</h2>
    <h4>PAUD Birrul Walidain</h4>
    <p class="mb-0">Sistem Penerimaan Murid Baru</p>
</header>

<div class="container">
    <div class="form-card">
        <h3 class="text-success mb-2">Formulir Pendaftaran Calon Murid</h3>
        <p class="text-muted">
            Silakan isi data calon murid dan orang tua dengan benar.
        </p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa kembali data berikut:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('spmb.store') }}" method="POST">
            @csrf

            <h5 class="mt-4 mb-3">A. Data Calon Murid</h5>

            <div class="mb-3">
                <label class="form-label">Nama lengkap calon murid *</label>
                <input type="text" name="nama_calon"
                    class="form-control" value="{{ old('nama_calon') }}"
                    maxlength="255" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal lahir *</label>
                <input type="date" name="tanggal_lahir"
                    class="form-control" value="{{ old('tanggal_lahir') }}"
                    max="{{ date('Y-m-d') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis kelamin *</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih jenis kelamin --</option>
                    <option value="Laki-laki"
                        {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                        Laki-laki
                    </option>
                    <option value="Perempuan"
                        {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                        Perempuan
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat lengkap *</label>
                <textarea name="alamat" class="form-control"
                    rows="3" required>{{ old('alamat') }}</textarea>
            </div>

            <hr>
            <h5 class="mt-4 mb-3">B. Data Orang Tua atau Wali</h5>

            <div class="mb-3">
                <label class="form-label">Nama orang tua/wali *</label>
                <input type="text" name="nama_orang_tua"
                    class="form-control" value="{{ old('nama_orang_tua') }}"
                    maxlength="255" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor HP aktif *</label>
                <input type="tel" name="no_hp"
                    class="form-control" value="{{ old('no_hp') }}"
                    maxlength="20" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Email (opsional)</label>
                <input type="email" name="email"
                    class="form-control" value="{{ old('email') }}"
                    maxlength="255">
            </div>

            <div class="alert alert-info">
                Pastikan semua data sudah benar sebelum mengirim pendaftaran.
                Simpan nomor pendaftaran yang akan muncul setelah formulir
                berhasil dikirim.
            </div>

            <button type="submit" class="btn btn-daftar">
                Kirim Pendaftaran
            </button>

            <a href="{{ url('/') }}"
                class="btn btn-outline-secondary w-100 mt-2">
                Kembali ke Beranda
            </a>
        </form>
    </div>
</div>

<footer class="text-center text-muted py-3">
    &copy; {{ date('Y') }} PAUD Birrul Walidain
</footer>

</body>
</html>
