
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - PAUD Birrul Walidain</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #edf7f0;
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
        }
        .login-box {
            background: white;
            width: min(360px, 85%);
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 4px 20px #0001;
        }
        h2 { color: #16845b; text-align: center; }
        label { display: block; margin-top: 15px; }
        input {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 22px;
            background: #16845b;
            color: white;
            border: 0;
            border-radius: 6px;
            cursor: pointer;
        }
        .error { color: #b42318; font-size: 14px; }
        a { color: #16845b; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>🌱 PAUD Birrul Walidain</h2>
        <p style="text-align:center">Silakan masuk ke akun Anda</p>

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
                required
                autocomplete="username"
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                required
                autocomplete="current-password"
            >

            <button type="submit">Masuk</button>
        </form>

        <p style="text-align:center">
            <a href="{{ route('beranda') }}">Kembali ke Beranda</a>
        </p>
    </div>
</body>
</html>
