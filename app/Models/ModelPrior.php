<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPrior extends Model
{
    protected $table = 'model_prior';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['id_penyakit', 'jumlah_kasus', 'prior'];

    protected $casts = [
        'prior' => 'float',
        'jumlah_kasus' => 'integer',
    ];
}
