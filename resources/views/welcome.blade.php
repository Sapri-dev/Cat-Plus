@extends('layouts.app')

@section('content')
<div class="bg-white overflow-x-hidden">

    <!-- 1. HERO SECTION (Platform CBT Modern) -->
    <div class="relative pt-16 pb-20 lg:pt-32 lg:pb-28 overflow-hidden">
        <!-- Background Decor (Animasi Blob) -->
        <div class="absolute top-0 left-1/2 w-full -translate-x-1/2 h-full z-0 pointer-events-none">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

            <!-- Badge Technology -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-900 text-white text-xs font-bold mb-8 shadow-xl border border-slate-700 hover:scale-105 transition duration-300 cursor-default">
                <i class="fa-solid fa-microchip text-blue-400 text-sm"></i>
                <span>Next-Gen Computer Assisted Test (CAT)</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 tracking-tight mb-6 leading-tight">
                Platform Ujian Online <br class="hidden md:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Cepat, Aman & Cerdas.</span>
            </h1>

            <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500 mb-10 leading-relaxed">
                Solusi lengkap untuk Sekolah, Universitas, dan Perusahaan. Kelola ribuan peserta dan bank soal dengan mudah. Dilengkapi <strong>AI Generator</strong> untuk membantu Admin membuat soal dalam hitungan detik.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-8 py-4 rounded-full bg-slate-900 text-white font-bold text-lg shadow-lg hover:bg-black transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                        Masuk Dashboard <i class="fa-solid fa-arrow-right"></i>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-4 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold text-lg shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 transition transform hover:-translate-y-1">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-4 rounded-full bg-white text-gray-700 border border-gray-200 font-bold text-lg hover:bg-gray-50 hover:border-gray-300 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-right-to-bracket"></i> Login Peserta
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- 2. AI FEATURE SECTION (Highlight untuk Admin) -->
    <div class="bg-slate-900 py-24 relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600 rounded-full blur-[100px] opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-600 rounded-full blur-[100px] opacity-20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-base text-blue-400 font-bold tracking-wide uppercase mb-2">Fitur Unggulan Admin</h2>
                <p class="text-3xl md:text-5xl font-extrabold text-white">
                    Buat 100 Soal dalam <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">1 Menit.</span>
                </p>
                <p class="mt-4 text-gray-400 max-w-2xl mx-auto text-lg">
                    Lelah mengetik soal satu per satu? Biarkan <strong>AI Assistant</strong> kami bekerja untuk Anda. Cukup ketik topik, tentukan jumlah, dan tingkat kesulitan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 p-8 rounded-2xl hover:border-blue-500/50 transition duration-300 group">
                    <div class="w-14 h-14 bg-slate-900 rounded-xl flex items-center justify-center text-2xl text-blue-400 mb-6 group-hover:scale-110 transition border border-slate-700">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">AI Generator Otomatis</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Input topik apa saja (Sejarah, Matematika, Biologi, Umum, dll). AI akan menyusun pertanyaan + kunci jawaban secara otomatis.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 p-8 rounded-2xl hover:border-indigo-500/50 transition duration-300 group">
                    <div class="w-14 h-14 bg-slate-900 rounded-xl flex items-center justify-center text-2xl text-indigo-400 mb-6 group-hover:scale-110 transition border border-slate-700">
                        <i class="fa-solid fa-file-excel"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Import Excel Massal</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Sudah punya bank soal sendiri? Upload file Excel berisi ratusan soal sekaligus. Sistem akan memprosesnya dalam sekejap.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 p-8 rounded-2xl hover:border-green-500/50 transition duration-300 group">
                    <div class="w-14 h-14 bg-slate-900 rounded-xl flex items-center justify-center text-2xl text-green-400 mb-6 group-hover:scale-110 transition border border-slate-700">
                        <i class="fa-solid fa-sliders"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Kontrol Kesulitan</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Atur tingkat kesulitan soal dari Mudah, Sedang, Sulit, hingga HOTS. Sesuaikan bobot nilai untuk setiap jawaban.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. GENERAL FEATURES (Untuk Pengguna/Instansi) -->
    <div class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6">
                        Sistem Ujian Terpercaya untuk <br>
                        <span class="text-indigo-600">Berbagai Kebutuhan.</span>
                    </h2>
                    <p class="text-gray-500 text-lg mb-8">
                        Fleksibel digunakan untuk ujian sekolah, kuis harian, rekrutmen pegawai, hingga sertifikasi profesional.
                    </p>

                    <ul class="space-y-6">
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 mt-1">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-900">Real-time Scoring</h4>
                                <p class="text-gray-500">Nilai langsung keluar begitu peserta menekan tombol selesai. Transparan dan akurat.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mt-1">
                                <i class="fa-solid fa-laptop-code"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-900">User Friendly Interface</h4>
                                <p class="text-gray-500">Tampilan ujian yang bersih dan mudah dipahami, meminimalisir kebingungan peserta.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 mt-1">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-900">Manajemen Pengguna</h4>
                                <p class="text-gray-500">Kelola akun Admin dan Peserta dalam satu panel super admin yang terintegrasi.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Image / Visual Right -->
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-200 to-indigo-200 rounded-3xl transform -rotate-3 scale-105 opacity-50"></div>
                    <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" alt="Online Exam" class="relative rounded-3xl shadow-2xl w-full object-cover h-[500px]">

                    <!-- Floating Badge -->
                    <div class="absolute -bottom-6 -right-6 bg-white p-4 rounded-xl shadow-xl border border-gray-100 flex items-center gap-4 animate-bounce duration-[3000ms]">
                        <div class="bg-indigo-100 p-3 rounded-full text-indigo-600">
                            <i class="fa-solid fa-users text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs font-bold uppercase">Peserta Aktif</p>
                            <p class="text-gray-900 font-bold text-xl">Unlimited</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. CTA (Call To Action) -->
    <div class="bg-gradient-to-r from-slate-900 to-indigo-900 py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                <span class="block">Tingkatkan Efisiensi Evaluasi Anda</span>
                <span class="block text-indigo-300 mt-2 text-2xl">Bergabung dengan platform CAT modern sekarang.</span>
            </h2>
            <div class="mt-8 flex justify-center gap-4">
                <a href="{{ route('register') }}" class="px-8 py-3 border border-transparent text-base font-bold rounded-full text-indigo-900 bg-white hover:bg-gray-100 md:py-4 md:text-lg md:px-10 shadow-lg transition">
                    Mulai Gratis
                </a>
            </div>
        </div>
    </div>

</div>

<!-- CSS Animasi Blob -->
<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
@endsection
