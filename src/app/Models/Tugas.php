<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugas';
    protected $primaryKey = 'id_tugas';

    protected $fillable = [
        'judul',
        'deskripsi',
        'deadline',
        'kelas',
        'mapel',
        'file_tugas',
        'id_guru',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'id_guru', 'id_user');
    }

    public function isDeadlineSoon(): bool
    {
        return $this->deadline && $this->deadline->diffInDays(now()) <= 3 && $this->deadline->isFuture();
    }
}
