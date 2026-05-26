<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalMengajar extends Model
{
    use HasFactory;

    protected $table = 'jadwal_mengajar';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'hari',
        'jam_mulai',
        'jam_selesai',
        'mapel',
        'kelas',
        'id_guru',
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'id_guru', 'id_user');
    }

    // Urutan hari untuk sorting
    public static function hariOrder(): array
    {
        return ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    }
}
