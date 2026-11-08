
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bukti Pendaftaran SPMB - PAUD Birrul Walidain</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 25px;
            font-family: Arial, sans-serif;
            color: #263238;
            background: #f0f7f2;
        }

        .bukti {
            max-width: 750px;
            margin: 20px auto;
            padding: 35px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #16845b;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        .header h2 {
            color: #16845b;
            margin-bottom: 8px;
        }

        .nomor {
            padding: 15px;
            background: #e5f6eb;
            border: 1px dashed #16845b;
            text-align: center;
            margin: 20px 0;
        }

        .nomor strong {
            display: block;
            font-size: 22px;
            color: #116b49;
            margin-top: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 11px 5px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }

        td:first-child {
            width: 40%;
            font-weight: bold;
        }

        .catatan {
            margin-top: 25px;
            padding: 15px;
            background: #f5fbf7;
            line-height: 1.7;
        }

        .tombol {
            text-align: center;
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            margin: 5px;
            border-radius: 6px;
            background: #16845b;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }

        .btn-kembali {
            background: #6c757d;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .bukti {
                max-width: 100%;
                margin: 0;
                padding: 15px;
                border: none;
                border-radius: 0;
            }

            .tombol {
                display: none;
            }
        }
    </style>
    <style>
    .logo-sekolah {
        width: 85px;
        height: 85px;
        max-width: 85px;
        object-fit: contain;
        display: block;
        margin: 0 auto 5px;
    }

    @media print {
        .logo-sekolah {
            width: 40px;
            height: 40px;
            max-width: 40px;
        }
    }
</style>
</head>
<body>

<div class="bukti">
    <div class="header">
    <img
        src="{{ asset('images/logo-paud.jpg') }}"
        alt="Logo TK PAUD Birrul Walidain"
        class="logo-sekolah"
    >
        <h2>TK PAUD BIRRUL WALIDAIN</h2>
        <h3>BUKTI PENDAFTARAN MURID BARU</h3>
        <p>Sistem Penerimaan Murid Baru (SPMB)</p>
    </div>

    <p>
        Terima kasih. Data pendaftaran calon murid telah berhasil
        dikirim dan tercatat dalam sistem.
    </p>

    <div class="nomor">
        Nomor Pendaftaran
        <strong>{{ $pendaftaran->nomor_pendaftaran }}</strong>
    </div>

    <h3>Data Calon Murid</h3>

    <table>
        <tr>
            <td>Nama Calon Murid</td>
            <td>{{ $pendaftaran->nama_calon }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>{{ $pendaftaran->tanggal_lahir->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>{{ $pendaftaran->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>{{ $pendaftaran->alamat }}</td>
        </tr>
    </table>

    <h3 style="margin-top: 25px;">Data Orang Tua atau Wali</h3>

    <table>
        <tr>
            <td>Nama Orang Tua/Wali</td>
            <td>{{ $pendaftaran->nama_orang_tua }}</td>
        </tr>
        <tr>
            <td>Nomor HP</td>
            <td>{{ $pendaftaran->no_hp }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $pendaftaran->email ?: '-' }}</td>
        </tr>
        <tr>
            <td>Tanggal Pendaftaran</td>
            <td>{{ $pendaftaran->created_at->format('d-m-Y H:i') }}</td>
        </tr>
        <tr>
            <td>Status Pendaftaran</td>
            <td>{{ ucfirst($pendaftaran->status) }}</td>
        </tr>
    </table>

    <div class="catatan">
        <strong>Informasi penting:</strong><br>
        1. Simpan bukti pendaftaran ini dengan baik.<br>
        2. Catat nomor pendaftaran untuk mengecek status penerimaan.<br>
        3. Bukti ini bukan surat tanda diterima sebagai murid.<br>
        4. Hasil seleksi mengikuti pengumuman resmi pihak sekolah.
    </div>

    <div class="tombol">
        <button class="btn" onclick="window.print()">
            Cetak Bukti Pendaftaran
        </button>

        <a href="{{ route('spmb.cek') }}" class="btn">
            Cek Status
        </a>

        <a href="{{ url('/') }}" class="btn btn-kembali">
            Kembali ke Beranda
        </a>
    </div>
</div>

</body>
</html>
