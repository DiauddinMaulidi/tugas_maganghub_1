
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: Arial;
            background: #f1f5f9;
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
    <h1>Dashboard Admin Sekolah</h1>

    <p>Selamat datang, {{ Auth::user()->name }}</p>

    <h3>Menu Admin</h3>
    <ul>
        <li>Manajemen Pengguna</li>
        <li>Data Guru</li>
        <li>Data Siswa</li>
        <li>Data Kelas</li>
        <li>Data Sekolah</li>
    </ul>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>

</body>
</html>
