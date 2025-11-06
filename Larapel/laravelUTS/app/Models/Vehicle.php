<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    // Tentukan kolom mana saja yang bisa diisi
    protected $fillable = [
        'nopol', 'nama_kendaraan', 'jenis_kendaraan', 'kontakdriver', 'tahun', 'kapasitas', 'foto'
    ];

    // Menambahkan relasi jika kendaraan memiliki transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'nopol', 'nopol');
    }
}
