<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Masterkirim extends Model
{
    protected $table = 'masterkirim';
    protected $primaryKey = 'kodekirim';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kodekirim',
        'tglkirim',
        'nopol',
        'totalqty',
    ];

    protected $casts = [
        'tglkirim' => 'date',
        'totalqty' => 'float',
    ];

    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class, 'nopol', 'nopol');
    }

    public function detail(): HasMany
    {
        return $this->hasMany(Detailkirim::class, 'kodekirim', 'kodekirim');
    }
}
