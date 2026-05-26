<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    
    // The table does not have created_at/updated_at fields in the sql schema.
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_voucher',
        'subtotal',
        'status',
        'metode_pembayaran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
