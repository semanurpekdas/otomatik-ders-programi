<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akademisyen extends Model
{
    use HasFactory;

    protected $table = 'akademisyenler';

    protected $fillable = [
        'guid',
        'isim',
        'soyisim',
        'kisa_kod', // Bu alanı burada tanımlayın
        'cinsiyet',
        'unvan',
        'bolum_id',
        'fakulte_id',
        'email',
        'renk_kodu',
    ];

    public function fakulte()
    {
        return $this->belongsTo(Fakulte::class, 'fakulte_id');
    }

    public function bolum()
    {
        return $this->belongsTo(Bolum::class, 'bolum_id');
    }

    
}
