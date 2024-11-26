<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBarang extends Model
{
    use HasFactory;

    protected $table = 'master_barangs';

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'stok',
        'harga',
        'foto',
    ];

    public function harga()
    {
        return $this->hasMany(BarangHarga::class, 'barang_id');
    }
}
