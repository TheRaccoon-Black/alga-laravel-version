<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataKasus extends Model
{
    use HasFactory;

    protected $table = 'data_kasus';
    protected $fillable = ['kode_pasien', 'id_penyakit', 'is_uji'];

    public function penyakit(): BelongsTo
    {
        return $this->belongsTo(Penyakit::class, 'id_penyakit', 'id_penyakit');
    }

    public function details(): HasMany
    {
        return $this->hasMany(DetailKasus::class, 'id_kasus', 'id_kasus');
    }

    public function getActiveSymptomsAttribute(): array
    {
        return $this->details()->where('nilai', 1)->pluck('id_gejala')->toArray();
    }
}
