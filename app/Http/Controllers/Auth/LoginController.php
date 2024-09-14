<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;  
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return back()->withErrors(['email' => 'Bu e-posta adresi bulunamadı.']);
        }
    
        if (!$user->hasVerifiedEmail()) {
            return back()->with('verification_error', 'E-posta adresiniz doğrulanmamış. Lütfen e-postanızı kontrol edin.');
        }
    
        if (Hash::check($request->password, $user->password)) {
            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }
        }
    
        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        // Oturumu kapatıyoruz
        Auth::logout();
    
        // Session'ı geçersiz hale getiriyoruz
        $request->session()->invalidate();
    
        // Yeni bir session token oluşturuyoruz
        $request->session()->regenerateToken();
    
        // Kullanıcıyı login sayfasına yönlendiriyoruz
        return redirect()->route('login')->with('success', 'Başarıyla çıkış yaptınız.');
    }
    
}
    
