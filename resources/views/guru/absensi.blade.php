<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-5xl mx-auto p-6">

        <div class="bg-blue-700 text-white p-5 rounded-lg mb-6">
            <h1 class="text-2xl font-bold">Absensi Siswa</h1>
            <p>Guru: {{ $guru->name }}</p>
            <p>Kelas: {{ $kelas->nama_kelas }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-5">
            <h2 class="text-xl font-semibold mb-4">
                Daftar Siswa
            </h2>

            @forelse ($siswa as $item)
                <div class="border-b p-3">
                    {{ $loop->iteration }}. {{ $item->nama }}
                </div>
            @empty
                <p class="text-gray-500">
                    Belum ada siswa di kelas ini.
                </p>
            @endforelse
        </div>

        <a href="{{ route('guru.dashboard') }}"
           class="inline-block mt-5 bg-gray-600 text-white px-4 py-2 rounded">
            Kembali
        </a>

    </div>

</body>
</html>
