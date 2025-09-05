<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $fillable = ['siswa_id','pertanyaan_id', 'alternatif_id', 'teks', 'nilai'];

     public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }

    public function hasilKuisioners()
    {
        return $this->hasMany(HasilKuisioner::class);
    }
}
