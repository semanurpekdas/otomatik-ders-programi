<!-- resources/views/auth/verify-email.blade.php -->

@extends('layouts.app') <!-- Eğer bir ana layout dosyanız varsa bunu kullanın -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">E-posta Adresinizi Doğrulayın</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Yeni bir doğrulama bağlantısı e-posta adresinize gönderildi.
                        </div>
                    @endif

                    Lütfen devam etmeden önce e-posta adresinizi doğrulamak için size gönderilen bağlantıyı kontrol edin.
                    Eğer e-posta almadıysanız, aşağıdaki bağlantıya tıklayarak yeni bir doğrulama e-postası isteyebilirsiniz.

                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link">Doğrulama e-postasını tekrar gönder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
