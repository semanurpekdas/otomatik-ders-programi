@extends('layout')

@section('title', 'Ders Programı')

@section('content')

    <div class="px-5 my-5 pt-4">
        <div class="bg-white border shadow p-3 pt-5">
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center bg-dark rounded w-75 text-white py-3" id="sınıftab">
                    <h2>Ders Programı Ayarları</h2>
                </div>
            </div>
            <div class="d-flex justify-content-between my-4"> 
                <div>
                    <a href="{{ route('akademisyenler.gun') }}" class="btn btn-warning text-white warning-active-overlay">Akademisyen Gün Ayarları</a>
                </div>
                <div>
                    <a href="{{ route('dersprogramigoruntule') }}" class="btn btn-dark text-white dark-active-overlay">Ders Programı Oluştur</a>
                </div>
            </div>
            <div>
                <h5 class="h4 text-center">Ders Atamaları</h5>
                <!-- Alert Mesajları -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center mt-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show text-center mt-3" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="mt-3 px-5 py-3 border">
                <form action="{{ route('ders_programi.store') }}" method="POST" class="repeater">
                    @csrf
                    <div data-repeater-list="dersler">
                        @foreach ($kayitlar as $kayit)
                            <div data-repeater-item class="row">
                                <!-- Ders - Akademisyen -->
                                <div class="col-lg-5 me-3">
                                    <label for="ders_akademisyen" class="ps-2 mb-2">Ders - Akademisyen</label>
                                    <div class="mb-3 p-1">
                                        <select name="dersler[{{ $loop->index }}][ders_akademisyen]" class="form-select" required>
                                            <option value="">Lütfen Ders ve Akademisyeni Seçiniz</option>
                                            @foreach ($dersProgrami as $ders)
                                                <option value="{{ $ders['id'] }}_{{ $ders['ders_saati'] }}"
                                                    {{ isset($kayit[0], $kayit[3]) && $ders['id'] == $kayit[0] && $ders['ders_saati'] == $kayit[3] ? 'selected' : '' }}>
                                                    {{ $ders['ders_adi'] }} ({{ $ders['hoca_isim'] }} {{ $ders['hoca_soyisim'] }}) ({{ $ders['ders_saati'] }} saat)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Gün -->
                                <div class="col-lg-3 me-3">
                                    <label for="gun" class="ps-2 mb-2">Gün</label>
                                    <div class="mb-3 p-1">
                                        <select name="dersler[{{ $loop->index }}][gun]" class="form-select" required>
                                            <option value="">Gün Seçiniz</option>
                                            @foreach ($gunler as $gun)
                                                <option value="{{ $gun }}" {{ isset($kayit[1]) && $gun == $kayit[1] ? 'selected' : '' }}>
                                                    {{ $gun }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Ders Saati -->
                                <div class="col-lg-2 me-3">
                                    <label for="ders_saati" class="ps-2 mb-2">Ders Saati</label>
                                    <div class="mb-3 p-1">
                                        <select name="dersler[{{ $loop->index }}][ders_saati]" class="form-select" required>
                                            <option value="">Ders Saati Seçiniz</option>
                                            @for ($i = 1; $i <= $ayarlar->gunluk_ders_saati; $i++)
                                                <option value="{{ $i }}" {{ isset($kayit[2]) && $i == $kayit[2] ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <!-- Sil Butonu -->
                                <div class="col-lg-1 align-self-center text-center">
                                    <button data-repeater-delete type="button" class="btn btn-danger text-white mt-3">Sil</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button data-repeater-create type="button" class="btn btn-success text-white mt-2">Ders Ekle</button>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
    


    <style>
        #sınıftab {
            margin-top: -80px; /* Yukarıya çekmek için negatif margin */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        table {
            font-size: 1.2rem;
        } 

        form i{
            font-size: 1.2rem;
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

    
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        // Mevcut kayıtlardan ders_sartlari varsa onları alalım
        const existingDersSartlari = {!! json_encode($dersProgramiSartlari->ders_sartlari ?? null) !!};
    </script>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Repeater için gerekli JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
<script src="https://unpkg.com/vue@3.2.47/dist/vue.global.js"></script>


<!-- Kendi JavaScript Kodlarınız -->
<script>
    $(document).ready(function () {
        $('.repeater').repeater({
            initEmpty: false,
            defaultValues: {
                'gun': '',
                'ders_saati': '',
                'ders_akademisyen': '',
            },
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Bu dersi silmek istediğinizden emin misiniz?')) {
                    $(this).slideUp(deleteElement);
                }
            },
        });
    });

    // Alert'leri kaldırmak için
    document.addEventListener('DOMContentLoaded', function () {
        // Tüm alert'leri seç
        const alerts = document.querySelectorAll('.alert');
        
        // 2 saniye sonra alert'leri kaldır
        setTimeout(() => {
            alerts.forEach(alert => {
                alert.classList.add('fade');
                setTimeout(() => {
                    alert.remove();
                }, 500); // fade-out animasyon süresi
            });
        }, 2000);
    });
</script>



       
@endsection


