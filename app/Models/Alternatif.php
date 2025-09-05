<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $fillable = ['kode', 'nama'];

    public function jawabans()
    {
        return $this->hasMany(Jawaban::class);
    }
}
