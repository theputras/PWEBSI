<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * INI WAJIB: Beri tahu Laravel nama tabel yang benar.
     */
    protected $table = 'masterkiriman';

    /**
     * INI JUGA WAJIB: Definisikan Primary Key Anda
     */
protected $primaryKey = 'kodepengiriman';
    public $incrementing = false;
    protected $keyType = 'string';


protected $fillable = [
        'kodepengiriman', 
        'tglpengiriman', 
        'nopol', 
        'driver', 
        'totalqty'
    ];

public function products()
    {
        // Pastikan foreign key pertama adalah 'kodepengiriman' (DENGAN 'n')
        return $this->belongsToMany(Product::class, 'detailkirim', 'kodepengiriman', 'kodeproduk')
                    ->withPivot('qty');
    }

    /**
     * Relasi ke tabel vehicles
     */
    public function vehicle()
    {
        // Asumsi primary key di 'vehicles' adalah 'nopol'
        return $this->belongsTo(Vehicle::class, 'nopol', 'nopol');
    }
}