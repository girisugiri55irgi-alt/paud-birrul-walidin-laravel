
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->exists ? 'Edit' : 'Tambah' }} Data Kelas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 30px;
            color: #1e293b;
        }
        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 28px;
            border-radius: 12px;
        }
        label {
            display: block;
            margin: 15px 0 6px;
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 15px;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 11px 16px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
        }
        .primary { background: #0f766e; color: white; }
        .secondary { background: #e2e8f0; color: #334155; }
        .error { color: #b91c1c; }
    </style>
</head>
<body>
<div class="container">
    <h1>{{ $item->exists ? 'Edit Data Kelas' : 'Tambah Data Kelas' }}</h1>
    <p>TK PAUD Birrul Walidin</p>

    @if ($errors->any())
        <div class="error">
            <strong>Periksa kembali data berikut:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $item->exists ? route('kelas.update', $item) : route('kelas.store') }}"
          method="POST">
        @csrf

        @if ($item->exists)
            @method('PUT')
        @endif

        <label>Nama Kelas *</label>
        <input name="nama_kelas"
               value="{{ old('nama_kelas', $item->nama_kelas) }}"
               placeholder="Contoh: Kelompok A1" required>

        <label>Kelompok</label>
        <select name="kelompok">
            <option value="">-- Pilih Kelompok --</option>
            @foreach (['Kelompok A', 'Kelompok B', 'Kelompok Bermain'] as $kelompok)
                <option value="{{ $kelompok }}"
                    @selected(old('kelompok', $item->kelompok) === $kelompok)>
                    {{ $kelompok }}
                </option>
            @endforeach
        </select>

        <label>Tahun Ajaran</label>
        <input name="tahun_ajaran"
               value="{{ old('tahun_ajaran', $item->tahun_ajaran) }}"
               placeholder="2026/2027">

        <label>Nama Guru</label>
        <input name="nama_guru"
               value="{{ old('nama_guru', $item->nama_guru) }}"
               placeholder="Nama guru kelas">

        <label>Keterangan</label>
        <textarea name="keterangan" rows="3"
        >{{ old('keterangan', $item->keterangan) }}</textarea>

        <button type="submit" class="btn primary">Simpan Data</button>
        <a href="{{ route('kelas.index') }}" class="btn secondary">Batal</a>
    </form>
</div>
</body>
</html>
