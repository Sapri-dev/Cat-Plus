@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
        <h2 class="text-xl font-bold mb-6">Buat Ujian Baru</h2>
        
        <form action="{{ route('admin.exams.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Judul Ujian</label>
                <input type="text" name="title" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200" placeholder="Contoh: Tryout SKD CPNS 2024" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                <textarea name="description" class="w-full border-gray-300 rounded-lg shadow-sm" rows="3" placeholder="Deskripsi singkat..."></textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Durasi (Menit)</label>
                <input type="number" name="duration_minutes" class="w-full border-gray-300 rounded-lg shadow-sm" value="90" required>
            </div>

            <button type="submit" class="w-full bg-purple-700 text-white font-bold py-3 rounded-lg hover:bg-purple-800 transition">
                Simpan & Lanjut ke Soal
            </button>
        </form>
    </div>
</div>
@endsection