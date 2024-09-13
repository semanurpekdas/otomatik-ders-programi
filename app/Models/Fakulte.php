<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakulte extends Model
{
    use HasFactory;

    protected $table = 'fakulteler'; // Tablo adı

    protected $fillable = ['fakulte_isim', 'uni_id']; // Doldurulabilir alanlar

    // Üniversite ile ilişki (Many to One)
    public function universite()
    {
        return $this->belongsTo(Universite::class, 'uni_id', 'id');
    }
}
