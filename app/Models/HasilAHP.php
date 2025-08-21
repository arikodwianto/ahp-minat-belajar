<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilAhp extends Model
{
    use HasFactory;

    protected $table = 'hasil_ahp';

    protected $fillable = [
        'kriteria_id',
        'nilai',
    ];

    // Relasi ke kriteria
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
