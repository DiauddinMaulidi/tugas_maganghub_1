
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Dashboard Admin</title>
</head>
<script>
    function showTab(tabId, button) {
        // sembunyikan semua konten
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden')
        });

        // tampilkan konten yang dipilih
        document.getElementById(tabId).classList.remove('hidden');

        // hilangkan warna semua tombol
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-blue-300');
        });

        // Berikan warna pada tombol aktif
        button.classList.add('bg-blue-300');
    }
</script>
<body class="bg-red-200 py-10 px-20">
<div class="bg-white p-[25px] rounded-md">
    <h1 class="text-xl">Dashboard Admin Sekolah</h1>
    <p>Selamat datang, {{ Auth::user()->name }}</p>

    <div class="p-2 flex gap-3">
        <button onClick="showTab('pengguna', this)" class="tab-btn bg-blue-300 rounded-lg p-3 cursor-pointer">Manajemen Pengguna</button>
        <!-- <button onClick="showTab('guru', this)" class="tab-btn p-3 cursor-pointer">Data Guru</button> -->
        <button onClick="showTab('siswa', this)" class="tab-btn p-3 cursor-pointer">Data Siswa</button>
        <button onClick="showTab('kelas', this)" class="tab-btn p-3 cursor-pointer">Data Kelas</button>
    </div>

    <div id="pengguna" class="tab-content">
        <table class="w-full mt-[20px] border-collapse">
            <thead>
                <tr>
                    <th class="bg-[#1e40af] p-[13px] text-left">No</th>
                    <th class="bg-[#1e40af] p-[13px] text-left">Nama</th>
                    <th class="bg-[#1e40af] p-[13px] text-left">Email</th>
                    <th class="bg-[#1e40af] p-[13px] text-left">Status</th>
                    <th class="bg-[#1e40af] p-[13px] text-left">Role</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)
                <tr>
                    <td class="border border-[#ddd] p-1">{{ $loop->iteration }}</td>
                    <td class="border border-[#ddd] p-1">{{ $user->name }}</td>
                    <td class="border border-[#ddd] p-1">{{ $user->email }}</td>
                    <td class="border border-[#ddd] p-1">
                        @if ($user->is_active)
                            <span class="aktif">Aktif</span>
                        @else
                            <span class="nonaktif">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="border border-[#ddd] p-1">
                        @if ($user->role)
                            {{ ucfirst($user->role->name) }}
                        @else
                            Belum memiliki role
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

    <!-- siswa -->
    <div id="siswa" class="tab-content hidden">
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="bg-[#1e40af] p-[13px] text-left">No</th>
                    <th class="bg-[#1e40af] p-[13px] text-left">Nama Siswa</th>
                    <th class="bg-[#1e40af] p-[13px] text-left">NIS</th>
                    <th class="bg-[#1e40af] p-[13px] text-left">Jenis Kelamin</th>
                    <th class="bg-[#1e40af] p-[13px] text-left">TTL</th>
                    <th class="bg-[#1e40af] p-[13px] text-left">Alamat</th>
                    <th class="bg-[#1e40af] p-[13px] text-left">Kelas</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($siswas as $siswa)
                    <tr>
                        <td class="border border-[#ddd] p-1">
                            {{ $loop->iteration }}
                        </td>

                        <td class="border border-[#ddd] p-1">
                            {{ $siswa->nama }}
                        </td>

                        <td class="border border-[#ddd] p-1">
                            {{ $siswa->nis }}
                        </td>


                        <td class="border border-[#ddd] p-1">
                            {{ $siswa->jenis_kelamin }}
                        </td>

                        <td class="border border-[#ddd] p-1">
                            {{ $siswa->tempat_lahir }},
                            {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d-m-Y') }}
                        </td>

                        <td class="border border-[#ddd] p-1">
                            {{ $siswa->alamat }}
                        </td>

                        <td class="border border-[#ddd] p-1">
                            {{ $siswa->kelas ?? '-' }}
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="8" class="text-center p-4">
                            Belum ada data siswa.
                        </td>
                    </tr>

                @endforelse
            </tbody>
        </table>
    </div>

    <!-- kelas -->
     <div id="kelas" class="tab-content hidden">
        <h3 class="text-lg font-semibold mb-4">
            Tambahkan Guru
        </h3>

         @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-3">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-3">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.guru-kelas') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-2 font-medium">Pilih Guru</label>
                    <select name="user_id" required
                        class="w-full border rounded p-2">
                        <option value="">-- Pilih Guru --</option>

                        @foreach ($guruUsers as $guru)
                            <option value="{{ $guru->id }}">
                                {{ $guru->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Pilih Kelas</label>
                    <select name="kelas_id" required
                        class="w-full border rounded p-2">
                        <option value="">-- Pilih Kelas --</option>

                        @foreach ($kelas as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit"
                class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Penugasan
            </button>
        </form>

        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="bg-[#1e40af] p-[13px] text-left">No</th>
                    <th class="bg-[#1e40af] p-[13px] text-left">Nama Kelas</th>
                    <th class="bg-[#1e40af] p-[13px] text-left">Tingkat</th>
                    <th class="bg-[#1e40af] p-[13px] text-left">Tahun Ajaran</th>
                    <th class="bg-[#1e40af] p-[13px] text-left">Wali Kelas</th>
                    <th class="bg-[#1e40af] p-[13px] text-left">Jumlah Siswa</th>
                    <th class="bg-[#1e40af] p-[13px] text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($kelas as $item)
                    <tr>
                        <td class="border border-[#ddd] p-1">
                            {{ $loop->iteration }}
                        </td>

                        <td class="border border-[#ddd] p-1">
                            {{ $item->nama_kelas }}
                        </td>

                        <td class="border border-[#ddd] p-1">
                            {{ $item->tingkat }}
                        </td>

                        <td class="border border-[#ddd] p-1">
                            {{ $item->tahun_ajaran }}
                        </td>

                        <td class="border border-[#ddd] p-1">
                            {{ $item->waliKelas->name ?? 'Belum ditentukan' }}
                        </td>

                        <td class="border border-[#ddd] p-1">
                            {{ $item->siswas_count }} Siswa
                        </td>
                        <td class="border border-[#ddd] p-2">
                            <button class="bg-yellow-400 px-2 py-1 rounded">
                                Edit
                            </button>

                            <button class="bg-red-500 text-white px-2 py-1 rounded">
                                Hapus
                            </button>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="text-center p-4">
                            Belum ada data kelas.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="border-2 p-2 cursor-pointer mt-3" type="submit">Logout</button>
    </form>
</div>

</body>
</html>
