<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailKasus extends Model
{
    protected $table = 'detail_kasus';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['id_kasus', 'id_gejala', 'nilai'];

    protected $casts = [
        'nilai' => 'boolean',
    ];

    public function kasus(): BelongsTo
    {
        return $this->belongsTo(DataKasus::class, 'id_kasus', 'id_kasus');
    }

    public function gejala(): BelongsTo
    {
        return $this->belongsTo(Gejala::class, 'id_gejala', 'id_gejala');
    }
}
