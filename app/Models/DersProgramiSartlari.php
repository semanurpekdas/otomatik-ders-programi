<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DersProgramiSartlari extends Model
{
    use HasFactory;

    protected $table = 'ders_programi_sartlari';

    protected $fillable = [
        'bolum_id',
        'sinif_cakismamasi',
        'akademisyen_cakismamasi',
        'salon_cakismamasi',
        'sart_sayisi',
        'ders_sartlari',
    ];

    // JSON casting
    protected $casts = [
        'ders_sartlari' => 'array', // JSON alanı dizi olarak işlenir
    ];

    // Bölüm ilişkisi (Bolum Modeli ile ilişki tanımlanabilir)
    public function bolum()
    {
        return $this->belongsTo(Bolum::class, 'bolum_id');
    }
}
