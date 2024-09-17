<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    use HasFactory;

    protected $table = 'salonlar';

    protected $fillable = [
        'guid',
        'isim',
        'fakulte_id',
        'bolum_id',
        'kapasite',
        'renk_kodu',
    ];

    public function fakulte()
    {
        return $this->belongsTo(Fakulte::class);
    }

    public function bolum()
    {
        return $this->belongsTo(Bolum::class);
    }
}
