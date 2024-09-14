<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail; // Bu satırı ekleyin

class User extends Authenticatable implements MustVerifyEmail // Bu kısmı güncelleyin
{
    use HasFactory, Notifiable;

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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function universite()
    {
        return $this->belongsTo(Universite::class, 'uni_id');
    }

    public function bolum()
    {
        return $this->belongsTo(Bolum::class, 'bolum_id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\CustomPasswordResetNotification($token, $this->email));
    }

}
