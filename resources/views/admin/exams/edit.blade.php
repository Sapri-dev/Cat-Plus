@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <div class="mb-6">
        <a href="{{ route('admin.exams.index') }}" class="text-slate-500 hover:text-blue-600 text-sm flex items-center gap-1 font-bold transition">
            <i class="fa-solid fa-arrow-left"></i> Batal & Kembali
        </a>
        <h1 class="text-2xl font-bold text-slate-800 mt-2">Edit Informasi Ujian</h1>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-slate-200 p-8">
        <form action="{{ route('admin.exams.update', $exam->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Wajib untuk Update data -->
            
            <div class="space-y-6">
                <!-- Judul -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Judul Ujian</label>
                    <input type="text" name="title" value="{{ old('title', $exam->title) }}" class="w-full rounded-lg border-slate-300 focus:ring-blue-500 focus:border-blue-500 font-medium" required>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border-slate-300 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $exam->description) }}</textarea>
                </div>

                <!-- Grid Waktu -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Durasi -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Durasi Pengerjaan</label>
                        <div class="relative">
                            <input type="number" name="duration_minutes" value="{{ old('duration_minutes', $exam->duration_minutes) }}" class="w-full rounded-lg border-slate-300 focus:ring-blue-500 focus:border-blue-500 pr-12 font-bold text-slate-700" required>
                            <span class="absolute right-3 top-2.5 text-sm text-slate-500 font-bold">Menit</span>
                        </div>
                    </div>

                    <!-- Spacer -->
                    <div class="hidden md:block"></div>

                    <!-- Waktu Mulai -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Waktu Dibuka (Start)</label>
                        <!-- Format tanggal harus Y-m-d\TH:i agar terbaca di input type="datetime-local" -->
                        <input type="datetime-local" name="start_date" 
                               value="{{ $exam->start_date ? $exam->start_date->format('Y-m-d\TH:i') : '' }}" 
                               class="w-full rounded-lg border-slate-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>

                    <!-- Waktu Selesai -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Batas Akhir (Deadline)</label>
                        <input type="datetime-local" name="end_date" 
                               value="{{ $exam->end_date ? $exam->end_date->format('Y-m-d\TH:i') : '' }}" 
                               class="w-full rounded-lg border-slate-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex gap-3">
                <button type="submit" class="flex-1 bg-slate-900 text-white font-bold py-3 rounded-xl hover:bg-blue-600 transition shadow-lg flex items-center justify-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection