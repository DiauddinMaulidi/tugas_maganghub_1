
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
                        @forelse ($user->roles as $role)
                            {{ ucfirst($role->name) }}
                        @empty
                            Belum memiliki role
                        @endforelse
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
        <h2 class="text-lg font-bold mb-3">Data Kelas</h2>
        <table class="w-full border-collapse">
            <thead class="bg-blue-800 text-white">
                <tr>
                    <th class="p-3">No</th>
                    <th>Nama Kelas</th>
                    <th>Wali Kelas</th>
                    <th>Jumlah Siswa</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td colspan="4" class="p-3 text-center">
                        Data kelas belum tersedia.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- sekolah -->
     <div id="sekolah" class="tab-content hidden">
        <h2 class="text-lg font-bold mb-3">Data Sekolah</h2>
        <div class="border rounded-lg p-4">
            <p>Nama Sekolah: Belum diatur</p>
            <p>Alamat: Belum diatur</p>
            <p>NPSN: Belum diatur</p>
            <p>Akreditasi: Belum diatur</p>
        </div>

    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="border-2 p-2 cursor-pointer mt-3" type="submit">Logout</button>
    </form>
</div>

</body>
</html>
