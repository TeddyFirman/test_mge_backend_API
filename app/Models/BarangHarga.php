<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangHarga extends Model
{
    use HasFactory;

    protected $table = 'barang_hargas';

    protected $fillable = [
        'barang_id',
        'harga',
        'tanggal_berlaku',
    ];

    public function barang()
    {
        return $this->belongsTo(MasterBarang::class, 'barang_id');
    }
}
