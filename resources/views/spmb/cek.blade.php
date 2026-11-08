
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Status SPMB - PAUD Birrul Walidain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f4f8;
            font-family: Arial, sans-serif;
        }
        .header {
            background: #571cc4;
            color: white;
            text-align: center;
            padding: 28px 15px;
        }
        .card-form {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 18px rgba(0,0,0,.08);
        }
        .btn-success {
            background: #5820a1;
        }
    </style>
</head>
<body>

<header class="header">
    <h2>PAUD Birrul Walidain</h2>
    <p class="mb-0">Pengecekan Status Pendaftaran Murid Baru</p>
</header>

<div class="container">
    <div class="card-form">
        <h3 class="text-success mb-3">Cek Status Pendaftaran</h3>
        <p>Masukkan nomor pendaftaran yang diperoleh setelah mengirim formulir.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('spmb.hasil') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nomor_pendaftaran" class="form-label">
                    Nomor Pendaftaran
                </label>
                <input
                    type="text"
                    id="nomor_pendaftaran"
                    name="nomor_pendaftaran"
                    class="form-control"
                    value="{{ old('nomor_pendaftaran') }}"
                    placeholder="Contoh: SPMB-2026-ABC123"
                    required
                >
            </div>

            <button type="submit" class="btn btn-success w-100">
                Periksa Status
            </button>
        </form>

        <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100 mt-3">
            Kembali ke Beranda
        </a>
    </div>
</div>

<footer class="text-center text-muted py-3">
    &copy; {{ date('Y') }} PAUD Birrul Walidain
</footer>

</body>
</html>
