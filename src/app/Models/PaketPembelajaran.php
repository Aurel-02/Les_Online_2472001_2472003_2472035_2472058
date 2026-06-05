<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketPembelajaran extends Model
{
    use HasFactory;

    protected $table = 'paket_pembelajaran';
    protected $primaryKey = 'id_paket';
    
    // Disable timestamps if not present in schema
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'jenjang',
        'harga',
        'masa_aktif',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_paket', 'id_paket');
    }
}
