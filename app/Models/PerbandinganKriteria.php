<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbandinganKriteria extends Model
{
    use HasFactory;

    // Tambahkan ini biar Laravel tahu nama tabelnya
    protected $table = 'perbandingan_kriterias';

    protected $fillable = [
        'kriteria1_id',
        'kriteria2_id',
        'nilai'
    ];
}
