<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'guid',
        'isim',
        'soyisim',
        'email',
        'telefon',
        'uni_id',
        'bolum_id',
        'unvan',
        'profilimg_path',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * İlişkiler: Kullanıcıya ait üniversiteyi getirir.
     */
    public function universite()
    {
        return $this->belongsTo(Universite::class, 'uni_id');
    }

    /**
     * İlişkiler: Kullanıcıya ait bölümü getirir.
     */
    public function bolum()
    {
        return $this->belongsTo(Bolum::class, 'bolum_id');
    }
}
