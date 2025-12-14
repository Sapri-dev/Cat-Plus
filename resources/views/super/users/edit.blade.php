@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    
    <!-- Breadcrumb -->
    <div class="mb-6">
        <a href="{{ route('super.users.index') }}" class="text-gray-500 hover:text-purple-600 text-sm font-medium flex items-center gap-2 transition">
            <i class="fa-solid fa-arrow-left-long"></i> Kembali ke Daftar User
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        
        <!-- Header Form -->
        <div class="bg-gray-50 px-8 py-6 border-b border-gray-200 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold text-gray-800">Edit Data Pengguna</h1>
                <p class="text-sm text-gray-500">Perbarui informasi profil dan hak akses.</p>
            </div>
            <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-lg">
                {{ substr($user->name, 0, 1) }}
            </div>
        </div>

        <form action="{{ route('super.users.update', $user->id) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                
                <!-- Grid Nama & Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                               class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50/50" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                               class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50/50" required>
                    </div>
                </div>

                <!-- Ganti Password -->
                <div class="bg-yellow-50 rounded-xl p-5 border border-yellow-100">
                    <label class="block text-xs font-bold text-yellow-700 uppercase mb-2">
                        <i class="fa-solid fa-key mr-1"></i> Ganti Password (Opsional)
                    </label>
                    <input type="password" name="password" 
                           class="w-full rounded-xl border-yellow-200 focus:ring-yellow-500 focus:border-yellow-500 placeholder-gray-400 text-sm" 
                           placeholder="Kosongkan jika tidak ingin mengubah password...">
                    <p class="text-[10px] text-yellow-600 mt-2">*Minimal 8 karakter jika diisi.</p>
                </div>

                <!-- Role Selection -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-3">Hak Akses (Role)</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        
                        <!-- Pilihan Admin -->
                        <label class="cursor-pointer relative group">
                            <input type="radio" name="role" value="admin" class="peer sr-only" {{ $user->role == 'admin' ? 'checked' : '' }}>
                            <div class="p-4 rounded-xl border-2 border-gray-200 bg-white hover:border-yellow-400 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 transition text-center h-full">
                                <div class="text-2xl text-gray-300 peer-checked:text-yellow-600 mb-2 group-hover:text-yellow-400"><i class="fa-solid fa-user-gear"></i></div>
                                <div class="font-bold text-gray-700 peer-checked:text-yellow-800">Admin Ujian</div>
                                <div class="text-[10px] text-gray-400 mt-1">Kelola soal & peserta</div>
                            </div>
                        </label>

                        <!-- Pilihan Student -->
                        <label class="cursor-pointer relative group">
                            <input type="radio" name="role" value="student" class="peer sr-only" {{ $user->role == 'student' ? 'checked' : '' }}>
                            <div class="p-4 rounded-xl border-2 border-gray-200 bg-white hover:border-purple-400 peer-checked:border-purple-500 peer-checked:bg-purple-50 transition text-center h-full">
                                <div class="text-2xl text-gray-300 peer-checked:text-purple-600 mb-2 group-hover:text-purple-400"><i class="fa-solid fa-user-graduate"></i></div>
                                <div class="font-bold text-gray-700 peer-checked:text-purple-800">Peserta</div>
                                <div class="text-[10px] text-gray-400 mt-1">Hanya akses ujian</div>
                            </div>
                        </label>

                        <!-- Pilihan Super Admin -->
                        <label class="cursor-pointer relative group">
                            <input type="radio" name="role" value="super_admin" class="peer sr-only" {{ $user->role == 'super_admin' ? 'checked' : '' }}>
                            <div class="p-4 rounded-xl border-2 border-gray-200 bg-white hover:border-red-400 peer-checked:border-red-500 peer-checked:bg-red-50 transition text-center h-full">
                                <div class="text-2xl text-gray-300 peer-checked:text-red-600 mb-2 group-hover:text-red-400"><i class="fa-solid fa-shield-halved"></i></div>
                                <div class="font-bold text-gray-700 peer-checked:text-red-800">Super Admin</div>
                                <div class="text-[10px] text-gray-400 mt-1">Full akses sistem</div>
                            </div>
                        </label>

                    </div>
                </div>

            </div>

            <!-- Footer Buttons -->
            <div class="mt-8 pt-6 border-t border-gray-100 flex gap-3">
                <button type="submit" class="flex-1 bg-gray-900 text-white font-bold py-3 rounded-xl hover:bg-black transition shadow-lg flex items-center justify-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                </button>
                <a href="{{ route('super.users.index') }}" class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection