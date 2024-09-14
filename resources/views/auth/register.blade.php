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
                max-width: 1200px;
            }

            .card-left {
                flex: 1;
                background: url('{{ asset('images/logo.jpg') }}') no-repeat center center;
                background-size: contain;
                min-height: 300px;
            }

            .card-right {
                flex: 2;
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
                font-size: 1rem;
                border: none;
                outline: none;
                box-shadow: none;
                letter-spacing: 0.1rem;
            }

            .form-control:focus {
                outline: none;
                box-shadow: none;
            }

            .form-select {
                font-size: 1rem;
                border: none;
                outline: none;
                box-shadow: none;
                letter-spacing: 0.1rem;
            }

            .form-select:focus {
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
                    <h3 class="mb-4 text-center text-primary">Kayıt Ol</h3>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex pe-3 mb-2">
                            <div class="mb-3 me-3 d-flex ps-3 col-6 d-flex align-items-center pe-2">
                                <i class="bi bi-person me-1"></i>
                                <input type="text" class="form-control" name="isim" placeholder="İsim" required>
                            </div>
                            <div class="mb-3 d-flex ps-3 col-6 d-flex align-items-center pe-2">
                                <i class="bi bi-person me-1"></i>
                                <input type="text" class="form-control" name="soyisim" placeholder="Soyisim" required>
                            </div>
                        </div> 
                        <div class="d-flex pe-3 mb-2">
                            <div class="mb-3 me-3 d-flex ps-3 col-6 d-flex align-items-center pe-2">
                                <i class="bi bi-envelope-at me-1"></i>
                                <input type="email" class="form-control" name="email" placeholder="Kurumsal E-posta" required>
                            </div>
                            <div class="mb-3 d-flex ps-3 col-6 d-flex align-items-center pe-2">
                                <i class="bi bi-phone me-1"></i>
                                <input type="tel" class="form-control" name="telefon" placeholder="Telefon" required>
                            </div>
                        </div>
                        <div class="d-flex pe-3 mb-2">
                            <div class="mb-3 me-3 d-flex ps-3 col-6 d-flex align-items-center pe-2">
                                <i class="bi bi-lock me-1"></i>
                                <input type="password" class="form-control" name="password" placeholder="Şifre" required>
                            </div>
                            <div class="mb-3 d-flex ps-3 col-6 d-flex align-items-center pe-2">
                                <i class="bi bi-lock me-1"></i>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Şifre Tekrar" required>
                            </div>
                        </div>
                        <div class="d-flex pe-3 mb-2">
                            <div class="mb-3 me-3 d-flex ps-3 col-6 d-flex align-items-center pe-2">
                                <i class="bi bi-houses me-1"></i>
                                <input type="text" class="form-control" name="universite_adi" list="universiteler" placeholder="Üniversite" required>
                            </div>
                            <div class="mb-3 d-flex ps-3 col-6 d-flex align-items-center pe-2">
                                <i class="bi bi-backpack me-1"></i>
                                <input type="text" class="form-control" name="bolum" placeholder="Bölüm">
                            </div>
                        </div>
                        <div class="d-flex pe-3 mb-2">
                            <div class="mb-3 me-3 d-flex ps-3 col-6 d-flex align-items-center pe-2">
                                <i class="bi bi-person-workspace me-1"></i>
                                <select class="form-select" name="unvan" required>
                                    <option value="Öğrenci" selected>Öğrenci</option>
                                    <option value="Arş. Gör.">Arş. Gör.</option>
                                    <option value="Dr. Öğr.">Dr. Öğr.</option>
                                    <option value="Doç. Dr.">Doç. Dr.</option>
                                    <option value="Prof. Dr.">Prof. Dr.</option>
                                </select>
                            </div>
                            <div class="mb-3 px-1 col-6">
                                <input class="form-control" type="file" name="profilimg" accept="image/*">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-4">Kayıt Ol</button>
                        <a href="{{ route('login') }}" class="btn btn-secondary">Zaten Hesabım Var</a>
                    </form>
                </div>
            </div>
        </div>

        <datalist id="universiteler">
            @foreach($universiteler as $universite)
                <option value="{{ $universite->isim }}">
            @endforeach
        </datalist>

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
    </body>
</html>
