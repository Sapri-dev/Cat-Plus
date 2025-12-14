<?php

namespace App\Imports;

use App\Models\Question;
use App\Models\Option;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionsImport implements ToCollection, WithHeadingRow
{
    protected $examId;

    public function __construct($examId)
    {
        $this->examId = $examId;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Validasi baris kosong
            if (!isset($row['pertanyaan']) || $row['pertanyaan'] == null) continue;

            // 1. Simpan Soal
            $question = Question::create([
                'exam_id' => $this->examId,
                'question_text' => $row['pertanyaan'],
                'type' => $row['kategori'] ?? 'Umum', // Default Umum jika kosong
            ]);

            // 2. Simpan Opsi Jawaban (A-E)
            $options = ['a', 'b', 'c', 'd', 'e'];
            
            foreach ($options as $optKey) {
                // Cek apakah kolom opsi ada di excel (misal: opsi_a)
                if (isset($row['opsi_'.$optKey]) && $row['opsi_'.$optKey] != null) {
                    
                    // Cek Kunci Jawaban
                    // Di Excel kolom 'kunci' isinya huruf 'a', 'b', dll.
                    $isCorrect = (strtolower($row['kunci']) == $optKey);
                    
                    // Logika Skor:
                    // Jika kolom 'skor_benar' ada, pakai itu. Jika tidak, default 5.
                    // Jika soal TKP, logic bisa dikembangkan lagi nanti (butuh format excel khusus).
                    // Untuk sekarang kita pakai logic umum: Benar=Input/5, Salah=0.
                    
                    $score = 0;
                    if ($isCorrect) {
                        $score = isset($row['poin']) ? $row['poin'] : 5;
                    }

                    Option::create([
                        'question_id' => $question->id,
                        'option_text' => $row['opsi_'.$optKey],
                        'is_correct' => $isCorrect,
                        'score' => $score
                    ]);
                }
            }
        }
    }
}