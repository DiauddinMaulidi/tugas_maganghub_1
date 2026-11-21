
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Petugas</title>
    <style>
        body {
            font-family: Arial;
            background: #f0fdf4;
            padding: 30px;
        }
        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>Dashboard Petugas Sekolah</h1>

    <p>Selamat datang, {{ Auth::user()->name }}</p>

    <h3>Menu Petugas</h3>
    <ul>
        <li>Melihat Data Siswa</li>
        <li>Mengelola Data Administrasi</li>
        <li>Melihat Informasi Sekolah</li>
    </ul>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>

</body>
</html>
