<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamScore extends Model
{
    protected $table = 'exam_scores';

    protected $fillable = [
        'user_id',
        'jenis',
        'mapel',
        'score',
        'correct',
        'total',
        'questions_snapshot',
        'student_answers',
    ];

    protected $casts = [
        'questions_snapshot' => 'array',
        'student_answers'    => 'array',
    ];

    public function getJenisLabelAttribute(): string
    {
        return match ($this->jenis) {
            'uts'    => 'UTS',
            'uas'    => 'UAS',
            'tryout' => 'Try Out',
            default  => strtoupper($this->jenis),
        };
    }
}
