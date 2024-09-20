<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayar extends Model
{
    use HasFactory;

    protected $table = 'ayarlar';

    // Doldurulabilir alanlar
    protected $fillable = [
        'bolum_id',
        'gunluk_ders_saati',
        'haftanin_gunleri',
        'yıl_donem',
        'ara_saati',
        'renklendirme_secim',
        'online_ders_sinifa_yerlestirme',
    ];

    // JSON formatında olanlar
    protected $casts = [
        'haftanin_gunleri' => 'array', // Liste şeklinde günler
        'online_ders_sinifa_yerlestirme' => 'boolean', // Online ders yerleştirme
    ];
}

