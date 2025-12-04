<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'nopol';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $appends = ['foto_url'];

    protected $fillable = [
        'nopol',
        'namakendaraan',
        'jeniskendaraan',
        'namadriver',
        'kontakdriver',
        'tahun',
        'kapasitas',
        'foto',
    ];

    protected $casts = [
        'tahun' => 'date',
    ];

    public function pengiriman(): HasMany
    {
        return $this->hasMany(Masterkirim::class, 'nopol', 'nopol');
    }

    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto ? Storage::url($this->foto) : null;
    }
}
