<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerbandinganAlternatif extends Model
{
    protected $fillable = [
        'siswa_id','kriteria_id','alternatif1_id','alternatif2_id',
        'pilihan','nilai','alasan'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function alternatif1()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif1_id');
    }

    public function alternatif2()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif2_id');
    }

    public function pilihanAlternatif()
    {
        return $this->belongsTo(Alternatif::class, 'pilihan');
    }
}
