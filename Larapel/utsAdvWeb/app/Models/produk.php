<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'kodeproduk';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $appends = ['gambar_url'];

    protected $fillable = [
        'kodeproduk',
        'nama',
        'satuan',
        'harga',
        'gambar',
        'kodegudang',
    ];

    protected $casts = [
        'harga' => 'float',
    ];

    public function gudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'kodegudang', 'kodegudang');
    }

    public function detailPengiriman(): HasMany
    {
        return $this->hasMany(Detailkirim::class, 'kodeproduk', 'kodeproduk');
    }

    public function getGambarUrlAttribute(): ?string
    {
        return $this->gambar ? Storage::url($this->gambar) : null;
    }
}
