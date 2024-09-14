<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KullaniciKayitMaili extends Mailable
{
    use Queueable, SerializesModels;

    public $isim;
    public $url;

    public function __construct($isim, $url)
    {
        $this->isim = $isim;
        $this->url = $url;
    }

    public function build()
    {
        return $this->subject('E-posta Doğrulama')
                    ->view('emails.kullanici_kayit') // Bu view dosyasını oluşturacağız
                    ->with([
                        'isim' => $this->isim,
                        'url' => $this->url,
                    ]);
    }
}
