<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamHistory extends Model
{
    protected $table = 'exam_histories';

    protected $fillable = [
        'user_id',
        'jenis',
        'mapel',
        'score',
        'correct',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Label tipe ujian untuk tampilan
     */
    public function getJenisLabelAttribute(): string
    {
        return match ($this->jenis) {
            'uts'     => 'Ujian Tengah Semester',
            'uas'     => 'Ujian Akhir Semester',
            'tryout'  => 'Try Out UTBK/SNBT',
            default   => strtoupper($this->jenis),
        };
    }
}
