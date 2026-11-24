
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna Sekolah</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h2 {
            color: #1e293b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 13px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #1e40af;
            color: white;
        }

        .aktif {
            color: green;
            font-weight: bold;
        }

        .nonaktif {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Data Pengguna Sistem Informasi Sekolah</h2>
    <p>Daftar seluruh pengguna dan hak aksesnya.</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th>Role</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->is_active)
                            <span class="aktif">Aktif</span>
                        @else
                            <span class="nonaktif">Tidak Aktif</span>
                        @endif
                    </td>
                    <td>
                        @if ($user->role)
                            {{ ucfirst($user->role->name) }}
                        @else
                            belum memiliki role
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada data pengguna.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

</body>
</html>
