<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $table = 'gudang';
    protected $primaryKey = 'kodegudang';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kodegudang',
        'namagudang',
        'alamat',
        'kontak',
        'kapasitas',
    ];

    protected $casts = [
        'kapasitas' => 'float',
    ];

    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class, 'kodegudang', 'kodegudang');
    }
}
