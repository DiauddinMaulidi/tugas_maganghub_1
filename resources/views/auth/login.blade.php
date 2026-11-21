
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Sekolah</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef2ff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: white;
            width: 380px;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        }

        h2 {
            text-align: center;
            color: #1e3a8a;
        }

        p {
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 7px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
        }

        button {
            width: 100%;
            padding: 13px;
            margin-top: 25px;
            background: #1d4ed8;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
        }

        button:hover {
            background: #1e40af;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 6px;
        }
    </style>
</head>

<body>

<div class="login-container">

    <h2>Login Sekolah</h2>

    <p>Silakan masuk menggunakan akun Anda</p>

    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login.process') }}" method="POST">

        @csrf

        <label>Email</label>

        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="Masukkan email"
            required
        >

        <label>Password</label>

        <input
            type="password"
            name="password"
            placeholder="Masukkan password"
            required
        >

        <button type="submit">Login</button>

    </form>

</div>

</body>
</html>
