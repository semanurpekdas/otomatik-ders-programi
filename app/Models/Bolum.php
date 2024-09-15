<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bolum extends Model
{
    use HasFactory;

    protected $table = 'bolumler';

    protected $fillable = ['bolum_isim', 'fakulte_id', 'uni_id'];

    public function fakulte()
    {
        return $this->belongsTo(Fakulte::class, 'fakulte_id');
    }
}
