<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelLikelihood extends Model
{
    protected $table = 'model_likelihood';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['id_penyakit', 'id_gejala', 'f', 'x', 'p_ada'];

    protected $casts = [
        'p_ada' => 'float',
        'f' => 'integer',
        'x' => 'integer',
    ];
}
