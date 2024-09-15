<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassesController extends Controller
{
    protected $user;

    public function __construct()
    {
        // Oturum açmış kullanıcının bilgilerini alıyoruz
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user(); // Kullanıcı bilgisi
            return $next($request);
        });
    }

    public function index()
    {
        return view('main.sınıflar');
    }
}
