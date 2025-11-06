<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    // Tentukan kolom mana saja yang bisa diisi
    protected $fillable = [
        'kodegudang', 'namagudang', 'alamat', 'kontak', 'kapasitas'
    ];

    // Relasi dengan transaksi (jika ada)
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'kodegudang', 'kodegudang');
    }
}
