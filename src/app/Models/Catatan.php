<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    use HasFactory;

    protected $table = 'catatan';
    protected $primaryKey = 'id_catatan';

    protected $fillable = [
        'id_user',
        'mapel',
        'judul',
        'isi_catatan',
        'cover_color'
    ];
}
