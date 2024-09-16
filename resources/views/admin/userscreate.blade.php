<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title', 'Kullanıcı Kaydı')</title> 
        <!-- Bootstrap CSS -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
        html {
                height: 100%;
                margin: 0;
                font-family: "Roboto", "Helvetica", "Arial", sans-serif;
                background-size: cover;
            }

            #altbolum{
                background-color: rgba(0, 0, 0, 0.9);
                height: 100vh;

            }
            .row{
                padding-right: 0px !important;
                padding-left: 0px !important;
            }

            .card {
                display: flex;
                background: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                overflow: hidden;
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
                font-size: 1.2rem;
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
                font-size: 1.2rem;
                border: none;
                outline: none;
                box-shadow: none;
                letter-spacing: 0.1rem;
            }

            .form-select:focus {
                outline: none;
                box-shadow: none;
            }

            .custom-checkbox {
                width: 20px;
                height: 20px;
                background-color: #fff;
                border: 2px solid #9c27b0;
                border-radius: 4px;
                cursor: pointer;
            }

            .custom-checkbox:checked {
                background-color: #9c27b0;
                border-color: #9c27b0;
            }

            .custom-checkbox:focus {
                outline: none;
                box-shadow: 0 0 3px 2px rgba(156, 39, 176, 0.5); /* Yeşil bir glow */
            }

            .form-check-label{
                font-size: 1.4rem;
                margin-left: 10px;
            }

            .primary-overlay {
                box-shadow: 0 8px 15px rgba(3, 79, 132, 0.9); /* Işık efekti */
            }

            .secondary-overlay {
                box-shadow: 0 8px 15px rgba(156, 39, 176, 0.9); /* Işık efekti */
            }

        </style>
    </head>
    <body>
        <div class="container-fluid" id="altbolum">
            <div class="row p-0" style="padding:0px !important">
                <!-- Sidebar -->
                @include('layouts.navbar')

                <div class="container-fluid card-container mt-5">
                    <form method="POST" action="{{ route('admin.adduser') }}"  enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex justify-content-center">
                            <div class="card col-6 m-4 primary-overlay">
                                <!-- Form kısmı -->
                                <div class="card-right p-3">
                                    <h3 class="mb-4 text-center text-primary">Kullanıcı Bilgileri</h3>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
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
                                        <!-- Üniversite datalist -->
                                        <div class="mb-3 me-3 d-flex ps-3 col-6 d-flex align-items-center pe-2">
                                            <i class="bi bi-houses me-1"></i>
                                            <input type="text" class="form-control" name="universite_adi" list="universiteler" placeholder="Üniversite" required>
                                            <datalist id="universiteler">
                                                @foreach($universiteler as $universite)
                                                    <option value="{{ $universite->isim }}">
                                                @endforeach
                                            </datalist>
                                        </div>
        
                                        <!-- Bölüm datalist -->
                                        <div class="mb-3 d-flex ps-3 col-6 d-flex align-items-center pe-2">
                                            <i class="bi bi-backpack me-1"></i>
                                            <input type="text" class="form-control" name="bolum" list="bolumler" id="bolumidcreate" placeholder="Bölüm">
                                            <datalist id="bolumler">
                                                @foreach($bolumler as $bolum)
                                                    <option value="{{ $bolum->bolum_isim }} ({{ $bolum->universite->isim }})">
                                                @endforeach
                                            </datalist>
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
                                </div>
                            </div>
                            <div class="card col-3  m-4 secondary-overlay">
                                <div class="card-right p-3 ">
                                    <h3 class="mb-4 text-center text-primary">Roller</h3>
                                    @foreach($roles as $role)
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input custom-checkbox" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}">
                                            <label class="form-check-label text-secondary" for="role_{{ $role->id }}">{{ $role->isim }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success text-white w-75 my-3">Kayıt Oluştur</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Bootstrap JS -->
        <script src="{{ asset('js/app.js') }}"></script>

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

            // Alert mesajlarını gizlemek için
            document.addEventListener('DOMContentLoaded', function() {
                // Başarı veya hata alertleri için DOM elementlerini seç
                const alertSuccess = document.querySelector('.alert-success');
                const alertError = document.querySelector('.alert-danger');

                // Eğer başarı mesajı varsa 3 saniye sonra gizle
                if (alertSuccess) {
                    setTimeout(() => {
                        alertSuccess.style.display = 'none';
                    }, 3000); // 3000 milisaniye (3 saniye)
                }

                // Eğer hata mesajı varsa 3 saniye sonra gizle
                if (alertError) {
                    setTimeout(() => {
                        alertError.style.display = 'none';
                    }, 3000); // 3000 milisaniye (3 saniye)
                }
            });
        </script>

        <!-- JavaScript: Fakülte seçildiğinde parantez içindeki üniversite adını hemen sil -->
        <script>
            document.getElementById('bolumidcreate').addEventListener('input', function () {
                var fakulteInput = document.getElementById('bolumidcreate');
                var fakulteValue = fakulteInput.value;

                // Parantez içindeki üniversite adını anlık olarak silmek için regex kullanıyoruz
                fakulteValue = fakulteValue.replace(/\s*\(.*?\)\s*/g, '');
                fakulteInput.value = fakulteValue; // Fakülte adını güncelliyoruz
            });
        </script>
    </body>
</html>


