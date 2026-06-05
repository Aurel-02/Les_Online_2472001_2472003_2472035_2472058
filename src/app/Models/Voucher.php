<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'voucher';
    protected $primaryKey = 'id_voucher';

    public $timestamps = false;

    protected $fillable = [
        'kode_voucher',
        'potongan',
        'tanggal_berakhir',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_voucher', 'id_voucher');
    }
}
