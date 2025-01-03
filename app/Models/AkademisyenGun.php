<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akademisyengun extends Model
{
    use HasFactory;

    protected $table = 'akademisyen_gun';

    protected $fillable = [
        'bolum_id',
        'akademisyen_id',
        'gunler',
    ];

    protected $casts = [
        'gunler' => 'array', // JSON formatındaki günler dizi olarak işlenir
    ];

    // Akademisyen ilişkisi
    public function akademisyen()
    {
        return $this->belongsTo(Akademisyen::class, 'akademisyen_id');
    }

    // Bölüm ilişkisi
    public function bolum()
    {
        return $this->belongsTo(Bolum::class, 'bolum_id');
    }
}
