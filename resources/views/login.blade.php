<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - PAUD Birrul Walidain</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #0d47a1, #1976d2, #64b5f6);
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-box {
            background: #ffffff;
            width: 100%;
            max-width: 380px;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* Logo sekolah */
        .logo-sekolah {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .logo-sekolah img {
            display: block;
            width: 65px;
            height: 65px;
            max-width: 100%;
            object-fit: contain;
            margin: 0 auto 10px;
        }

        h2 {
            color: #0d47a1;
            text-align: center;
            font-size: 22px;
            margin: 0;
            line-height: 1.4;
        }

        .deskripsi {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin: 12px 0 22px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            color: #334155;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            display: block;
            width: 100%;
            padding: 12px;
            border: 1px solid #bfdbfe;
            border-radius: 7px;
            font-size: 15px;
            outline: none;
            transition: 0.2s;
        }

        input:focus {
            border-color: #1976d2;
            box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.12);
        }

        button {
            display: block;
            width: 100%;
            padding: 13px;
            margin-top: 24px;
            background: #1565c0;
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        button:hover {
            background: #0d47a1;
        }

        .error {
            color: #b42318;
            background: #fef2f2;
            border: 1px solid #fecaca;
            padding: 10px;
            border-radius: 7px;
            font-size: 14px;
        }

        .kembali {
            text-align: center;
            margin: 22px 0 0;
            font-size: 14px;
        }

        a {
            color: #1565c0;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 420px) {
            .login-box {
                padding: 24px 20px;
            }

            .logo-sekolah img {
                width: 55px;
                height: 55px;
            }

            h2 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-box">

        <div class="logo-sekolah">
            <img
                src="{{ asset('images/logo1.jpeg') }}"
                alt="Logo PAUD Birrul Walidain"
            >
            <h2>PAUD Birrul Walidain</h2>
        </div>

        <p class="deskripsi">
            Silakan masuk ke akun Anda
        </p>

        @if ($errors->any())
            <p class="error">{{ $errors->first() }}</p>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Masukkan email Anda"
                required
                autocomplete="username"
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password Anda"
                required
                autocomplete="current-password"
            >

            <button type="submit">Masuk</button>
        </form>

        <p class="kembali">
            <a href="{{ route('beranda') }}">
                &larr; Kembali ke Beranda
            </a>
        </p>

    </div>
</body>
</html>