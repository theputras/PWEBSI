<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'warehouse_id', 'vehicle_id', 'quantity', 'delivery_date'];

    // Relasi: Transaksi berhubungan dengan satu produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi: Transaksi berhubungan dengan satu gudang
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    // Relasi: Transaksi berhubungan dengan satu kendaraan
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
