<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universite extends Model
{
    use HasFactory;

    protected $table = 'universiteler';

    protected $fillable = [
        'isim', 'img_yolu', 'created_at', 'updated_at'
    ];
}
