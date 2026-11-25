<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Dashboard Guru</title>
</head>

<body class="bg-red-200 py-10 px-5 md:px-20">

    <div class="bg-white p-[25px] rounded-md">

        <!-- HEADER -->
        <div class="flex justify-between items-center flex-wrap gap-3">
            <div>
                <h1 class="text-xl">Dashboard Guru</h1>
                <p>Selamat datang, {{ Auth::user()->name }}</p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="border-2 p-2 rounded-md cursor-pointer hover:bg-red-500 hover:text-white">
                    Logout
                </button>
            </form>
        </div>

        <!-- NAVIGASI MENU SESUAI IZIN ADMIN -->
        <div class="p-2 flex gap-3 flex-wrap mt-3">

            @forelse ($menus as $menu)

            <button
                type="button"
                onclick="showTab('menu-{{ $menu->id }}', this)"
                class="tab-btn rounded-lg p-3 cursor-pointer
                    {{ $loop->first ? 'bg-blue-300' : '' }}">

                {{ $menu->nama_menu }}

            </button>

            @empty

            <p class="text-gray-500 p-3">
                Belum ada menu yang diberikan oleh Admin.
            </p>

            @endforelse

        </div>

        <!-- KONTEN MENU -->
        @foreach ($menus as $menu)

        @php
        $permission = $menu->roleMenus->first();
        @endphp

        <div id="menu-{{ $menu->id }}"
            class="tab-content {{ $loop->first ? '' : 'hidden' }}">

            <!-- DASHBOARD -->
            @if ($menu->slug === 'dashboard')

            <h2 class="text-lg font-semibold mb-4">
                Dashboard
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div class="border rounded-md p-5">
                    <h3 class="font-semibold">Nama Guru</h3>
                    <p class="mt-2">{{ Auth::user()->name }}</p>
                </div>

                <div class="border rounded-md p-5">
                    <h3 class="font-semibold">Menu yang Diizinkan</h3>
                    <p class="mt-2">{{ $menus->count() }} Menu</p>
                </div>

                <div class="border rounded-md p-5">
                    <h3 class="font-semibold">Status Akun</h3>
                    <p class="mt-2">
                        {{ Auth::user()->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </p>
                </div>

            </div>

            <!-- DATA SISWA -->
            @elseif ($menu->slug === 'data-siswa')

            <h2 class="text-lg font-semibold mb-4">
                Data Siswa
            </h2>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">

                    <thead>
                        <tr>
                            <th class="bg-[#1e40af] text-white p-[13px] text-left">No</th>
                            <th class="bg-[#1e40af] text-white p-[13px] text-left">Nama Siswa</th>
                            <th class="bg-[#1e40af] text-white p-[13px] text-left">NIS</th>
                            <th class="bg-[#1e40af] text-white p-[13px] text-left">Jenis Kelamin</th>
                            <th class="bg-[#1e40af] text-white p-[13px] text-left">TTL</th>
                            <th class="bg-[#1e40af] text-white p-[13px] text-left">Alamat</th>
                            <th class="bg-[#1e40af] text-white p-[13px] text-left">Kelas</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($siswas as $siswa)
                        <tr>
                            <td class="border border-[#ddd] p-2">
                                {{ $loop->iteration }}
                            </td>
                            <td class="border border-[#ddd] p-2">
                                {{ $siswa->nama }}
                            </td>
                            <td class="border border-[#ddd] p-2">
                                {{ $siswa->nis }}
                            </td>
                            <td class="border border-[#ddd] p-2">
                                {{ $siswa->jenis_kelamin }}
                            </td>
                            <td class="border border-[#ddd] p-2">
                                {{ $siswa->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d-m-Y') }}
                            </td>
                            <td class="border border-[#ddd] p-2">
                                {{ $siswa->alamat }}
                            </td>
                            <td class="border border-[#ddd] p-2">
                                {{ $siswa->kelas ?? '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center p-4">
                                Belum ada data siswa.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- DATA KELAS -->
            @elseif ($menu->slug === 'data-kelas')

            <h2 class="text-lg font-semibold mb-4">
                Data Kelas
            </h2>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">

                    <thead>
                        <tr>
                            <th class="bg-[#1e40af] text-white p-[13px] text-left">No</th>
                            <th class="bg-[#1e40af] text-white p-[13px] text-left">Nama Kelas</th>
                            <th class="bg-[#1e40af] text-white p-[13px] text-left">Tingkat</th>
                            <th class="bg-[#1e40af] text-white p-[13px] text-left">Tahun Ajaran</th>
                            <th class="bg-[#1e40af] text-white p-[13px] text-left">Jumlah Siswa</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($kelas as $item)
                        <tr>
                            <td class="border border-[#ddd] p-2">
                                {{ $loop->iteration }}
                            </td>
                            <td class="border border-[#ddd] p-2">
                                {{ $item->nama_kelas }}
                            </td>
                            <td class="border border-[#ddd] p-2">
                                {{ $item->tingkat }}
                            </td>
                            <td class="border border-[#ddd] p-2">
                                {{ $item->tahun_ajaran }}
                            </td>
                            <td class="border border-[#ddd] p-2">
                                {{ $item->siswas_count }} Siswa
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center p-4">
                                Belum ada data kelas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- DATA GURU -->
            @elseif ($menu->slug === 'data-guru')

            <h2 class="text-lg font-semibold mb-4">
                Data Guru
            </h2>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="bg-[#1e40af] text-white p-[13px] text-left">No</th>
                            <th class="bg-[#1e40af] text-white p-[13px] text-left">Nama Guru</th>
                            <th class="bg-[#1e40af] text-white p-[13px] text-left">Email</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($gurus as $item)
                        <tr>
                            <td class="border border-[#ddd] p-2">
                                {{ $loop->iteration }}
                            </td>
                            <td class="border border-[#ddd] p-2">
                                {{ $item->name }}
                            </td>
                            <td class="border border-[#ddd] p-2">
                                {{ $item->email }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center p-4">
                                Belum ada data guru.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- ABSENSI -->
            @elseif ($menu->slug === 'absensi')

            <h2 class="text-lg font-semibold mb-4">
                Kelas yang Dapat Diabsen
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                @forelse ($kelas as $item)

                <div class="border rounded-md p-5">

                    <h3 class="text-lg font-semibold">
                        {{ $item->nama_kelas }}
                    </h3>

                    <p class="mt-2">
                        Tingkat: {{ $item->tingkat }}
                    </p>

                    <p>
                        Tahun Ajaran: {{ $item->tahun_ajaran }}
                    </p>

                    <p class="mb-4">
                        Jumlah Siswa: {{ $item->siswas_count }}
                    </p>

                    <a href="{{ route('guru.absensi', $item->id) }}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded">

                        Lakukan Absensi

                    </a>

                </div>

                @empty

                <p>Belum ada kelas yang ditugaskan kepada Anda.</p>

                @endforelse

            </div>

            <!-- MENU LAINNYA -->
            @else

            <h2 class="text-lg font-semibold mb-4">
                {{ $menu->nama_menu }}
            </h2>

            <p class="text-gray-500">
                Menu ini sudah diberikan izin oleh Admin,
                tetapi konten halamannya belum dibuat.
            </p>

            @endif

        </div>

        @endforeach

    </div>

    <!-- JAVASCRIPT TAB -->
    <script>
        function showTab(tabId, button) {

            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });

            const selectedTab = document.getElementById(tabId);

            if (selectedTab) {
                selectedTab.classList.remove('hidden');
            }

            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-blue-300');
            });

            button.classList.add('bg-blue-300');
        }
    </script>

</body>

</html>