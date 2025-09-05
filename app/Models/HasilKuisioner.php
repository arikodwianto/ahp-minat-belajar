<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilKuisioner extends Model
{
    protected $fillable = ['siswa_id', 'pertanyaan_id', 'jawaban_id'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }

    public function jawaban()
    {
        return $this->belongsTo(Jawaban::class);
    }
}
