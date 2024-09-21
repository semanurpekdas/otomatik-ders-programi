@extends('layout')

@section('title', 'Ayarlar')

@section('content')
    <div class="px-5 my-5 pt-4">
        <div class="bg-white border shadow p-3 pt-5">
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center bg-primary rounded w-75 text-white py-3" id="sınıftab">
                    <h2>Ayarlar</h2>
                </div> 
            </div>

            <div class="mt-3">

                @if(session('success'))
                    <div class="alert alert-success text-center">
                        <b>{{ session('success') }}</b>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger text-center">
                        <b>{{ session('error') }}</b>
                    </div>
                @endif
                <form method="POST" action="{{ route('ayarlar.update') }}">
                    @csrf
                    <div class="mt-3">
                        <div class="d-flex pe-3 my-4">
                            <!-- Günlük Ders Saati -->
                            <div class="col-6">
                                <label for="gunluk_ders_saati" class="form-label">Günlük Ders Saati</label>
                                <div class="mb-3 me-3 ps-3 d-flex align-items-center">
                                    <i class="bi bi-clock me-3"></i>
                                    <select class="form-select" id="gunluk_ders_saati" name="gunluk_ders_saati">
                                        <option>Lütfen Günlük Ders Saatinizi Seçiniz</option>
                                        @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ isset($ayarlar) && $ayarlar->gunluk_ders_saati == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div> 

                            <!-- Yıl Dönem -->
                            <div class="col-6">
                                <label for="yil_donem" class="form-label">Yıl / Dönem</label>
                                <div class="mb-3 d-flex ps-3 col-12 align-items-center">
                                    <i class="bi bi-calendar-check me-3"></i>
                                    <select class="form-select" name="yil_donem_yil">
                                        <option value="">Ders Programı Yılı</option>
                                        @for($year = 2024; $year <= 2030; $year++)
                                            <option value="{{ $year }}" {{ (isset($yil) && $yil == $year) ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                    <h3 class="mx-2 mb-0 pb-0">/</h3>
                                    <select class="form-select" name="yil_donem_donem">
                                        <option value="">Dönem</option>
                                        <option value="Güz" {{ (isset($donem) && $donem == 'Güz') ? 'selected' : '' }}>Güz</option>
                                        <option value="Bahar" {{ (isset($donem) && $donem == 'Bahar') ? 'selected' : '' }}>Bahar</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex pe-3 my-4">
                            <!-- Ara Saati -->
                            <div class="col-6">
                                <label for="ara_saati" class="form-label">Kaçıncı Dersten Sonra Ara Var</label>
                                <div class="mb-3 me-3 ps-3 d-flex align-items-center">
                                    <i class="bi bi-clock-history me-3"></i>
                                    <select class="form-select" id="ara_saati" name="ara_saati">
                                        <option>Lütfen Ara Ders Saatinizi Seçiniz</option>
                                        @for($i = 1; $i <= 9; $i++)
                                            <option value="{{ $i }}" {{ isset($ayarlar) && $ayarlar->ara_saati == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <!-- Renklendirme Seçim -->
                            <div class="col-6">
                                <label for="renklendirme_secim" class="form-label">Renklendirme Neye Göre Olsun</label>
                                <div class="mb-3 d-flex ps-3 col-12 align-items-center">
                                    <i class="bi bi-diagram-3 me-3"></i>
                                    <select class="form-select" id="renklendirme_secim" name="renklendirme_secim">
                                        <option value="">Lütfen Renklendirme Seçiniz</option>
                                        <option value="ders" {{ isset($ayarlar) && $ayarlar->renklendirme_secim == 'ders' ? 'selected' : '' }}>Ders</option>
                                        <option value="salon" {{ isset($ayarlar) && $ayarlar->renklendirme_secim == 'salon' ? 'selected' : '' }}>Salon</option>
                                        <option value="akademisyen" {{ isset($ayarlar) && $ayarlar->renklendirme_secim == 'akademisyen' ? 'selected' : '' }}>Akademisyen</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex">
                            <div class="border-end pe-3">
                                <!-- Haftanın Günleri -->
                                <label for="haftanin_gunleri" class="form-label"><b>Haftanın Hangi Günleri Ders Var?</b></label>
                                <div class="mt-2 custom-checkbox-group">
                                    @php
                                        $haftanin_gunleri = json_decode($ayarlar->haftanin_gunleri ?? '[]');
                                    @endphp
                                    <div class="custom-checkbox">
                                        <input type="checkbox" id="monday" name="haftanin_gunleri[]" value="Pazartesi" {{ in_array('Pazartesi', $haftanin_gunleri) ? 'checked' : '' }}>
                                        <label for="monday">Pazartesi</label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input type="checkbox" id="tuesday" name="haftanin_gunleri[]" value="Salı" {{ in_array('Salı', $haftanin_gunleri) ? 'checked' : '' }}>
                                        <label for="tuesday">Salı</label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input type="checkbox" id="wednesday" name="haftanin_gunleri[]" value="Çarşamba" {{ in_array('Çarşamba', $haftanin_gunleri) ? 'checked' : '' }}>
                                        <label for="wednesday">Çarşamba</label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input type="checkbox" id="thursday" name="haftanin_gunleri[]" value="Perşembe" {{ in_array('Perşembe', $haftanin_gunleri) ? 'checked' : '' }}>
                                        <label for="thursday">Perşembe</label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input type="checkbox" id="friday" name="haftanin_gunleri[]" value="Cuma" {{ in_array('Cuma', $haftanin_gunleri) ? 'checked' : '' }}>
                                        <label for="friday">Cuma</label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input type="checkbox" id="saturday" name="haftanin_gunleri[]" value="Cumartesi" {{ in_array('Cumartesi', $haftanin_gunleri) ? 'checked' : '' }}>
                                        <label for="saturday">Cumartesi</label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input type="checkbox" id="sunday" name="haftanin_gunleri[]" value="Pazar" {{ in_array('Pazar', $haftanin_gunleri) ? 'checked' : '' }}>
                                        <label for="sunday">Pazar</label>
                                    </div>
                                </div>
                            </div>

                            <div class="ms-5">
                                <!-- Online Ders Sınıfa Yerleştirme -->
                                <div class="mb-2">
                                    <label for="online_ders_sinifa_yerlestirme" class="form-label"><b>Online Ders Sınıfa Yerleştirme</b></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="online_ders_sinifa_yerlestirme" id="online_ders_evet" value="1" {{ isset($ayarlar) && $ayarlar->online_ders_sinifa_yerlestirme == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="online_ders_evet">Evet</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="online_ders_sinifa_yerlestirme" id="online_ders_hayir" value="0" {{ isset($ayarlar) && $ayarlar->online_ders_sinifa_yerlestirme == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="online_ders_hayir">Hayır</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Butonu -->
                        <button type="submit" class="btn btn-primary w-100 mt-3">Kaydet</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
    <style>
        #sınıftab {
            margin-top: -80px; /* Yukarıya çekmek için negatif margin */
            box-shadow: 0 4px 15px rgba(0, 172, 193, 0.5);
        }

        table {
            font-size: 1.2rem;
        } 

        form i{
            font-size: 2rem;
        }

        form .mb-3{
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            transition: all 0.2s ease-in-out;
        }

        form .mb-3:hover{
            border: 1px solid  #034f84;
            border-radius: 10px;
            border-left: 7px solid #034f84;
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
            font-size:  1.1rem;
            border: none;
            outline: none;
            box-shadow: none;
            letter-spacing: 0.1rem;
        }

        .form-select:focus {
            outline: none;
            box-shadow: none;
        }

        /* Checkbox*/
        .custom-checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .custom-checkbox {
        position: relative;
        margin-right: 15px;
    }

    .custom-checkbox input[type="checkbox"] {
        opacity: 0;
        position: absolute;
        z-index: -1;
    }

    .custom-checkbox label {
        position: relative;
        display: inline-flex;
        align-items: center;
        padding-left: 35px;
        font-size: 15px;
        cursor: pointer;
        color: #333;
        user-select: none;
        transition: all 0.3s ease;
    }

    .custom-checkbox label::before {
        content: '';
        position: absolute;
        left: 0;
        width: 20px;
        height: 20px;
        border: 2px solid #aaa;
        border-radius: 4px;
        background-color: transparent;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .custom-checkbox input[type="checkbox"]:checked + label::before {
        background-color: #6c63ff;
        border-color: #6c63ff;
    }

    .custom-checkbox label::after {
        content: '✓';
        position: absolute;
        top: -1px;
        left: 4px;
        font-size: 18px;
        color: #fff;
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .custom-checkbox input[type="checkbox"]:checked + label::after {
        opacity: 1;
    }

    .custom-checkbox label:hover::before {
        border-color: #6c63ff;
    }

    </style>

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
                }, 4000); // 3000 milisaniye (3 saniye)
            }

            // Eğer hata mesajı varsa 3 saniye sonra gizle
            if (alertError) {
                setTimeout(() => {
                    alertError.style.display = 'none';
                }, 4000); // 3000 milisaniye (3 saniye)
            }
        });
    </script>
       
@endsection
