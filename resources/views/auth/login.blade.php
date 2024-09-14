<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: "Roboto", "Helvetica", "Arial", sans-serif;
            background: url('{{ asset("images/navbar.jpg") }}') no-repeat center center fixed;
            background-size: cover;
        }

        /* Siyah Katman */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1;
        }

        .card-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .card {
            display: flex;
            flex-direction: row;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 80%;
            max-width: 800px;
        }

        .card-left {
            flex: 1;
            background: url('{{ asset('images/logo.jpg') }}') no-repeat center center;
            background-size: contain;
            min-height: 300px;
        }

        .card-right {
            flex: 1;
            padding: 40px;
        }

        form i{
            font-size: 1.3rem;
        }

        form .mb-3{
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            transition: all 0.2s ease-in-out;
        }

        form .mb-3:hover{
            border: 1px solid  #4caf50;
            border-radius: 10px;
            border-left: 7px solid #4caf50;
        }

        .form-control {
            font-size: 1.1rem;
            border: none;
            outline: none;
            box-shadow: none;
            letter-spacing: 0.1rem;
        }

        .form-control:focus {
            outline: none;
            box-shadow: none;
        }

        
    </style>
</head>
<body> 
    <div class="container-fluid card-container">
        <div class="card ">
            <!-- Logo kısmı -->
            <div class="card-left bg-light border-end"></div>

            <!-- Form kısmı -->
            <div class="card-right">
                <h3 class="mb-4 text-center text-primary">Giriş Yap</h3>
                {{-- Doğrulama e-postası başarıyla gönderildiyse --}}
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        Yeni doğrulama e-postası gönderildi.
                    </div>
                @endif

                {{-- E-posta doğrulandıysa --}}
                @if (session('verified'))
                    <div class="alert alert-success">
                        {{ session('verified') }}
                    </div>
                @endif

                {{-- Eğer doğrulama yapılmamışsa, özel hata ve form --}}
                @if (session('verification_error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('verification_error') }}
                        <br>
                        Eğer e-posta doğrulama ile ilgili sorun yaşıyorsanız, doğrulama e-postasını tekrar göndermek için aşağıdaki butona tıklayın.
                        <form method="POST" action="{{ route('verification.resend') }}" style="display: inline;">
                            @csrf
                            <input type="text" id="hiddenEmail" name="email" value="{{ old('email', request('email')) }}">
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">buraya tıklayarak</button>
                        </form>
                    </div>
                @endif

                {{-- Diğer hatalar, örneğin yanlış e-posta veya şifre --}}
                @if ($errors->has('email') || $errors->has('password'))
                    <div class="alert alert-danger" role="alert">
                        @if ($errors->has('email'))
                            {{ $errors->first('email') }}
                        @endif
                        @if ($errors->has('password'))
                            {{ $errors->first('password') }}
                        @endif
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3 d-flex ps-3 d-flex align-items-center pe-2">
                        <i class="bi bi-envelope-at me-1"></i>
                        <input type="email" class="form-control" id="email" name="email" placeholder="E-posta" required>
                    </div>
                    <div class="mb-3 d-flex ps-3 d-flex align-items-center pe-2">
                        <i class="bi bi-lock me-1"></i>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Şifre" required>
                        <button type="button" class="btn"><i class="bi bi-eye"></i></button>
                    </div>
                    <div class="my-3 ps-4 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Beni Hatırla</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
                </form>
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <a href="{{ route('register') }}" class="btn btn-success text-white">Kayıt Ol</a>
                    <a href="{{ route('password.request') }}">Şifremi Unuttum</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Tüm mb-3 sınıfına sahip divleri seç
            const formGroups = document.querySelectorAll('.mb-3');

            formGroups.forEach(function (div) {
                // İçindeki input elemanına odaklanıldığında div'e stil ekle
                const input = div.querySelector('.form-control');
                
                if (input) {
                    input.addEventListener('focus', function () {
                        div.style.border = '1px solid #034f84';
                        div.style.borderRadius = '10px';
                        div.style.borderLeft = '7px solid #034f84';
                    });

                    // Blur (odak dışı) olduğunda div'in stilini kaldır
                    input.addEventListener('blur', function () {
                        div.style.border = '1px solid rgba(0, 0, 0, 0.2)';
                        div.style.borderRadius = '10px';
                    });
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePasswordButton = document.querySelector('.btn i'); // Şifreyi gösterme/gizleme butonunu seçiyoruz
            const passwordInput = document.querySelector('#password'); // Şifre inputunu seçiyoruz
            const togglePasswordIcon = document.querySelector('.btn i'); // Buton içindeki ikon

            togglePasswordButton.addEventListener('click', function (event) {
                event.preventDefault(); // Butonun formu submit etmesini engelliyoruz

                // Şifrenin görünürlüğünü değiştiriyoruz
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text'; // Şifreyi görünür yapıyoruz
                    togglePasswordIcon.classList.remove('bi-eye'); // Eski ikonu kaldırıyoruz
                    togglePasswordIcon.classList.add('bi-eye-slash'); // Yeni ikon ekliyoruz
                } else {
                    passwordInput.type = 'password'; // Şifreyi tekrar gizli hale getiriyoruz
                    togglePasswordIcon.classList.remove('bi-eye-slash'); // Eski ikonu kaldırıyoruz
                    togglePasswordIcon.classList.add('bi-eye'); // Yeni ikon ekliyoruz
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // E-posta input ve hidden input elemanlarını seçiyoruz
            const emailInput = document.getElementById('email');
            const hiddenEmailInput = document.getElementById('hiddenEmail');

            // E-posta input alanında her değişiklik olduğunda çalışacak bir event listener ekliyoruz
            emailInput.addEventListener('input', function () {
                // E-posta inputundaki değeri hidden input'a yazdırıyoruz
                hiddenEmailInput.value = emailInput.value;
            });
        });
    </script>

</body>
</html>
