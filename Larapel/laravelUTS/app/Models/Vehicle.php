<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'capacity', 'type'];

    // Relasi: Kendaraan bisa memiliki banyak transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
