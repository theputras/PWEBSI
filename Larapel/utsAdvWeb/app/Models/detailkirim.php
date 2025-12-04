<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Detailkirim extends Model
{
    protected $table = 'detailkirim';
    // Composite key (kodekirim + kodeproduk) handled in queries; no single PK
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'kodekirim',
        'kodeproduk',
        'qty',
    ];

    protected $casts = [
        'qty' => 'float',
    ];

    public function master(): BelongsTo
    {
        return $this->belongsTo(Masterkirim::class, 'kodekirim', 'kodekirim');
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'kodeproduk', 'kodeproduk');
    }
}
