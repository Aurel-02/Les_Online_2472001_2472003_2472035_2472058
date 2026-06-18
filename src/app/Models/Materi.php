<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';
    protected $primaryKey = 'id_materi';

    protected $fillable = [
        'judul',
        'deskripsi',
        'link_video',
        'jenjang',
        'mapel',
        'kelas',
        'jurusan',
        'file_materi',
        'id_guru',
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'id_guru', 'id_user');
    }
}
