@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">

    <!-- 1. TAB NAVIGASI (Hanya Muncul untuk Super Admin) -->
    @if(Auth::user()->role === 'super_admin')
    <div class="flex items-center gap-2 mb-8 border-b border-gray-200 pb-1">
        <!-- Tab User -->
        <a href="{{ route('super.users.index') }}" class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-50 rounded-t-lg transition">
            <i class="fa-solid fa-users-gear mr-2"></i> Manajemen User
        </a>
        
        <!-- Tab Ujian (Aktif) -->
        <a href="{{ route('admin.exams.index') }}" class="px-4 py-2 text-sm font-bold text-yellow-600 border-b-2 border-yellow-600 bg-yellow-50/50 rounded-t-lg">
            <i class="fa-solid fa-file-pen mr-2"></i> Manajemen Ujian
        </a>
    </div>
    @endif

    <!-- 2. HEADER HALAMAN (Judul & Tombol Tambah) -->
    <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-2xl p-8 mb-8 text-white shadow-xl relative overflow-hidden">
        <!-- Dekorasi Background -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mr-16 -mt-16"></div>
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 relative z-10">
            <div>
                <h1 class="text-3xl font-bold flex items-center gap-3">
                    <i class="fa-solid fa-layer-group text-yellow-400"></i> Daftar Paket Ujian
                </h1>
                <p class="text-gray-400 mt-2">Buat, edit, dan kelola bank soal untuk peserta ujian.</p>
            </div>
            
            <!-- Tombol Tambah Ujian -->
            <a href="{{ route('admin.exams.create') }}" class="bg-yellow-400 hover:bg-yellow-300 text-gray-900 px-6 py-3 rounded-xl font-bold shadow-lg shadow-yellow-400/20 flex items-center gap-2 transition transform hover:scale-105">
                <i class="fa-solid fa-plus"></i> Buat Ujian Baru
            </a>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3 shadow-sm">
        <div class="bg-green-100 p-2 rounded-full"><i class="fa-solid fa-check"></i></div>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    <!-- 3. TABEL DAFTAR UJIAN -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-50/50 text-gray-500 font-bold uppercase tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-5">Judul Ujian</th>
                        <th class="px-6 py-5">Durasi</th>
                        <th class="px-6 py-5">Jumlah Soal</th>
                        <th class="px-6 py-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($exams as $exam)
                    <tr class="hover:bg-gray-50/80 transition duration-200">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold shadow-sm">
                                    <i class="fa-solid fa-book"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-base">{{ $exam->title }}</p>
                                    <p class="text-xs text-gray-500 truncate max-w-xs">{{ Str::limit($exam->description, 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 px-2.5 py-1 rounded text-xs font-medium">
                                <i class="fa-regular fa-clock"></i> {{ $exam->duration_minutes }} Menit
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 bg-purple-50 text-purple-700 px-2.5 py-1 rounded text-xs font-bold border border-purple-100">
                                <i class="fa-solid fa-list-ol"></i> {{ $exam->questions_count }} Soal
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <!-- Tombol Preview (Mencoba Ujian) -->
                                <!-- Perhatikan: Kita arahkan ke dashboard user biasa agar admin bisa tes -->
                                {{-- <a href="#" class="text-gray-400 hover:text-indigo-600 p-2 transition" title="Preview / Coba Ujian">
                                    <i class="fa-solid fa-play"></i>
                                </a> --}}

                                <!-- Tombol Kelola Soal -->
                                <a href="{{ route('admin.exams.show', $exam->id) }}" class="bg-indigo-50 text-indigo-600 hover:bg-indigo-100 border border-indigo-200 px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1">
                                    <i class="fa-solid fa-gear"></i> Kelola
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.exams.destroy', $exam->id) }}" method="POST" onsubmit="return confirm('Hapus ujian ini beserta seluruh soalnya?');">
                                    @csrf @method('DELETE')
                                    <button class="bg-red-50 text-red-600 hover:bg-red-100 border border-red-200 px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fa-solid fa-clipboard-list text-4xl mb-3 text-gray-300"></i>
                                <p class="font-medium">Belum ada paket ujian.</p>
                                <p class="text-sm mt-1">Klik tombol "Buat Ujian Baru" di atas.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection