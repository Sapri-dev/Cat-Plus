@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">

    <!-- 1. HERO BANNER (Professional Slate/Blue Theme) -->
    <!-- Mengganti warna Ungu ke Slate/Blue agar senada dengan Welcome Page -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-blue-900 rounded-3xl p-8 md:p-10 text-white shadow-2xl relative overflow-hidden mb-8 border border-slate-700">
        
        <!-- Dekorasi Background (Sama dengan Welcome) -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-blue-500 opacity-10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 bg-indigo-500 opacity-20 rounded-full blur-2xl"></div>

        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
            <!-- Teks Sambutan -->
            <div class="text-center md:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-xs font-bold mb-3 backdrop-blur-sm text-blue-200">
                    <i class="fa-solid fa-circle-check text-[10px]"></i>
                    <span>Sistem Siap Digunakan</span>
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold mb-3 tracking-tight leading-tight">
                    Halo, {{ Auth::user()->name }}!
                </h1>
                <p class="text-slate-300 text-base md:text-lg max-w-xl leading-relaxed">
                    @if(Auth::user()->role == 'super_admin')
                        Akses <strong>Super Admin</strong>. Kontrol penuh atas user, sistem, dan konfigurasi global.
                    @elseif(Auth::user()->role == 'admin')
                        Akses <strong>Admin Ujian</strong>. Kelola bank soal dan monitoring peserta ujian.
                    @else
                        Selamat datang di platform ujian. Pilih modul ujian di bawah untuk memulai sesi.
                    @endif
                </p>
            </div>
            
            <!-- Kotak Statistik (Style Tech / Dark Mode) -->
            <div class="flex gap-4">
                <div class="bg-slate-800/50 backdrop-blur-md border border-slate-600 rounded-2xl p-4 text-center min-w-[110px] transform hover:scale-105 transition duration-300">
                    <div class="text-3xl font-bold text-white mb-1">{{ $totalExamFinished ?? 0 }}</div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Selesai</div>
                </div>
                <div class="bg-slate-800/50 backdrop-blur-md border border-slate-600 rounded-2xl p-4 text-center min-w-[110px] transform hover:scale-105 transition duration-300">
                    <div class="text-3xl font-bold text-blue-400 mb-1">{{ number_format($averageScore ?? 0, 1) }}</div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Rata-Rata</div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. AKSES PANEL (Style Clean & Minimalis) -->
    @if(Auth::user()->role !== 'student')
    <div class="mb-10">
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden group hover:shadow-md transition duration-300">
            <!-- Dekorasi Hover -->
            <div class="absolute right-0 top-0 w-32 h-32 bg-slate-50 rounded-full blur-3xl -mr-10 -mt-10 group-hover:bg-blue-50 transition"></div>

            <div class="flex items-center gap-5 relative z-10">
                <!-- Icon: Slate Background (Sama seperti fitur di Welcome) -->
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-sm border border-slate-100
                    {{ Auth::user()->role == 'super_admin' ? 'bg-slate-900 text-red-500' : 'bg-slate-900 text-yellow-500' }}">
                    @if(Auth::user()->role == 'super_admin')
                        <i class="fa-solid fa-user-shield"></i>
                    @else
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    @endif
                </div>
                
                <div>
                    <h3 class="font-bold text-slate-800 text-lg">
                        Panel {{ Auth::user()->role == 'super_admin' ? 'Super Administrator' : 'Administrator' }}
                    </h3>
                    <p class="text-sm text-slate-500">
                        {{ Auth::user()->role == 'super_admin' ? 'Kelola pengguna, admin lain, dan pengaturan sistem.' : 'Kelola bank soal, jadwal, dan sesi ujian aktif.' }}
                    </p>
                </div>
            </div>
            
            <!-- Tombol Action -->
            <a href="{{ Auth::user()->role == 'super_admin' ? route('super.users.index') : route('admin.exams.index') }}" 
               class="relative z-10 px-8 py-3 rounded-full font-bold text-white shadow-lg transform hover:-translate-y-1 transition flex items-center gap-2 w-full md:w-auto justify-center
               {{ Auth::user()->role == 'super_admin' ? 'bg-red-600 hover:bg-red-700 shadow-red-200' : 'bg-slate-900 hover:bg-black shadow-slate-300' }}">
                <span>Masuk Panel</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
    @endif

    <!-- 3. KATALOG UJIAN -->
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <h2 class="text-xl font-bold text-slate-800">Modul Ujian Tersedia</h2>
            <span class="bg-slate-100 text-slate-600 text-xs font-bold px-2 py-1 rounded-full border border-slate-200">{{ $exams->count() }} Paket</span>
        </div>
        
        <!-- Search bar -->
        <div class="hidden md:flex items-center bg-white border border-slate-200 rounded-full px-4 py-2 shadow-sm focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500 transition">
            <i class="fa-solid fa-magnifying-glass text-slate-400 text-sm mr-2"></i>
            <input type="text" placeholder="Cari modul..." class="text-sm border-none focus:ring-0 text-slate-600 placeholder-slate-400 w-48 bg-transparent">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($exams as $exam)
        <div class="group bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-xl hover:border-blue-200 hover:-translate-y-1 transition duration-300 flex flex-col h-full relative">
            
            <!-- Badge Gratis -->
            <div class="absolute top-4 right-4 z-10">
                <span class="bg-blue-50/90 backdrop-blur-sm text-blue-700 text-[10px] font-bold px-2.5 py-1 rounded-full border border-blue-100 uppercase tracking-wide">
                    Tersedia
                </span>
            </div>

            <div class="p-6 flex-1 relative">
                <!-- Icon Background Effect -->
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-slate-50 rounded-full blur-xl group-hover:bg-blue-50 transition"></div>

                <div class="relative z-10">
                    <!-- Icon: Blue/Indigo Gradient -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 text-blue-600 w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-sm mb-5 group-hover:scale-110 transition duration-300 border border-blue-100">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    
                    <h3 class="font-bold text-lg text-slate-900 mb-2 leading-tight group-hover:text-blue-700 transition">{{ $exam->title }}</h3>
                    <p class="text-slate-500 text-sm mb-6 line-clamp-2 leading-relaxed">{{ $exam->description ?? 'Modul ujian standar untuk evaluasi kompetensi.' }}</p>
                    
                    <div class="flex items-center gap-4 text-xs font-medium text-slate-500 border-t border-slate-100 pt-4">
                        <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-blue-400"></i> {{ $exam->duration_minutes }} Menit</span>
                        <span class="flex items-center gap-1.5"><i class="fa-solid fa-list-check text-blue-400"></i> {{ $exam->questions_count }} Soal</span>
                    </div>
                </div>
            </div>

            <!-- Footer Action -->
            <div class="bg-slate-50 px-6 py-4 border-t border-slate-100">
                <form action="{{ route('exams.start', $exam->id) }}" method="POST">
                    @csrf
                    <!-- Button: Slate Dark Theme -->
                    <button type="submit" class="w-full bg-slate-900 text-white font-bold py-3 rounded-xl hover:bg-blue-600 transition shadow-lg group-hover:shadow-blue-200 flex items-center justify-center gap-2">
                        <span>Mulai Kerjakan</span>
                        <i class="fa-solid fa-chevron-right text-xs opacity-50 group-hover:translate-x-1 transition"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full py-16 text-center">
            <div class="bg-slate-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300 text-3xl">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <h3 class="text-slate-800 font-bold text-lg">Belum Ada Modul</h3>
            <p class="text-slate-500 text-sm">Silakan buat paket soal baru melalui panel admin.</p>
        </div>
        @endforelse
    </div>

</div>
@endsection