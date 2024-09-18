<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ders extends Model
{
    use HasFactory;

    protected $table = 'dersler';

    protected $fillable = [
        'ders_adi',
        'kisa_isim',
        'donem',
        'ders_sayisi',
        'ders_parcasi',
        'sinif',
        'alan_kisi_sayisi',
        'secmeli_durumu',
        'bolum_id',
        'hoca_id',
        'renk_kodu',
    ];

    public function bolum()
    {
        return $this->belongsTo(Bolum::class, 'bolum_id');
    }

    public function hoca()
    {
        return $this->belongsTo(Akademisyen::class, 'hoca_id');
    }
}
