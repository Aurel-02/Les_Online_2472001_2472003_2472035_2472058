<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'voucher';
    protected $primaryKey = 'id_voucher';

    // No created_at/updated_at in schema
    public $timestamps = false;

    protected $fillable = [
        'kode_voucher',
        'potongan',
        'tipe_potongan',
        'tanggal_berakhir',
    ];

    protected $casts = [
        'tanggal_berakhir' => 'date',
        'potongan'         => 'decimal:2',
    ];

    /**
     * Cek apakah voucher masih aktif (belum kedaluwarsa)
     */
    public function isAktif(): bool
    {
        return $this->tanggal_berakhir >= now()->startOfDay();
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_voucher', 'id_voucher');
    }
}
