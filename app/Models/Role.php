<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles'; // Tablo ismi

    protected $fillable = [
        'isim',           // Rol adı
        'universite',      // Üniversite yönetimi yetkisi
        'fakulte',         // Fakülte yönetimi yetkisi
        'bolum',           // Bölüm yönetimi yetkisi
        'dersprogramı',    // Ders programı yönetimi yetkisi
        'dersler',         // Dersler yönetimi yetkisi
        'salonlar',        // Salonlar yönetimi yetkisi
        'user',            // Kullanıcı yönetimi yetkisi
        'role',            // Rol yönetimi yetkisi
        'ayar',            // Ayarlar yönetimi yetkisi
        'akademisyen'      // Akademisyen yönetimi yetkisi
    ];
}
