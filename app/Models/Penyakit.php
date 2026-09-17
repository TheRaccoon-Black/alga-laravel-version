<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    protected $table = 'penyakits';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['id_penyakit', 'nama_penyakit'];

    public function dataKasus(): HasMany
    {
        return $this->hasMany(DataKasus::class, 'id_penyakit', 'id_penyakit');
    }
}
