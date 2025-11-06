<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Tentukan kolom mana saja yang bisa diisi
    protected $fillable = [
        'kodeproduk', 'nama', 'satuan', 'harga', 'gambar'
    ];

    // Menambahkan relasi jika ada relasi yang diperlukan (contoh: jika produk punya banyak transaksi)
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'kodeproduk', 'kodeproduk');
    }
}
