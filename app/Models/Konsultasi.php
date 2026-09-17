<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'konsultasi';

    protected $fillable = ['waktu', 'gejala_input', 'hasil_utama', 'prob_utama'];

    protected $casts = [
        'waktu' => 'datetime',
        'gejala_input' => 'array',
    ];
}
