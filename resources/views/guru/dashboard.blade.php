
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen">

        
    <header class="bg-blue-700 text-white p-5 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">Dashboard Guru</h1>
            <p>Selamat datang, {{ $guru->name }}</p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                Logout
            </button>
        </form>
    </header>


    <main class="p-6">

        <h2 class="text-xl font-semibold mb-4">
            Kelas yang Dapat Diabsen
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse ($kelas as $item)
                <div class="bg-white rounded-lg shadow p-5">
                    <h3 class="text-xl font-bold">
                        {{ $item->nama_kelas }}
                    </h3>
                    <p class="text-gray-600 mt-2">
                        Tingkat: {{ $item->tingkat }}
                    </p>
                    <p class="text-gray-600">
                        Tahun Ajaran: {{ $item->tahun_ajaran }}
                    </p>
                    <p class="text-gray-600 mb-4">
                        Jumlah Siswa: {{ $item->siswas_count }}
                    </p>
                    <a href="{{ route('guru.absensi', $item->id) }}"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Lakukan Absensi
                    </a>
                </div>
            @empty
                <div class="bg-white p-5 rounded-lg shadow">
                    Belum ada kelas yang ditugaskan kepada Anda.
                </div>
            @endforelse
        </div>
    </main>

    </div>

</body>
</html>
