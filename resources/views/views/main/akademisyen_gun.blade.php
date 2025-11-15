@extends('layout')

@section('title', 'Akademisyen Gün Ayarı')

@section('content')

<div class="px-5 my-5 pt-4">
    <div class="bg-white border shadow p-3 pt-5">
        <div class="d-flex justify-content-center" >
            <div class="d-flex justify-content-center bg-success rounded w-75 text-white py-3" id="sınıftab">
                <h2>Akademisyen Gün Ayarı</h2>
            </div>
        </div>

        <div class="d-flex justify-content-between my-3"> 
            <div>
                <a href="{{ route('akademisyenler') }}" class="btn btn-warning text-white warning-active-overlay">Akademisyenler</a>
            </div>
            <div>
                <a href="{{ route('dersprogrami') }}" class="btn btn-dark text-white dark-active-overlay">Ders Programı</a>
            </div>
        </div>

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
        <div class="alert alert-primary text-center alert-dismissible fade show" role="alert">
            <i class="bi bi-info-square-fill me-2"></i>
            <b>Akademisyenlerin müsait olduğu günleri aşağıdan belirleyebilirsiniz.</b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="mt-3 px-5 py-4 border">
        <form action="{{ route('akademisyenler.gun.store') }}" method="POST" class="repeater">
            @csrf
            <div data-repeater-list="akademisyenler">
                <!-- Eğer kayıt varsa göster -->
                @if ($akademisyenGunKayitlari->isNotEmpty())
                    @foreach ($akademisyenGunKayitlari as $kayit)
                        <div data-repeater-item class="row mb-4">
                            <!-- Akademisyen -->
                            <div class="col-lg-4 me-3">
                                <label for="akademisyen" class="ps-2 mb-2"><b>Akademisyen</b></label>
                                <div class="mb-3 p-1">
                                    <select name="akademisyen_id" class="form-select" required>
                                        <option value="">Lütfen Akademisyeni Seçiniz</option>
                                        @foreach($akademisyenler as $akademisyen)
                                            <option value="{{ $akademisyen->id }}" 
                                                {{ $akademisyen->id == $kayit->akademisyen_id ? 'selected' : '' }}>
                                                {{ $akademisyen->isim }} {{ $akademisyen->soyisim }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Günler -->
                            <div class="col-lg-6">
                                <label class="ps-2 mb-2"><b>Günler</b></label>
                                <div class=" d-flex flex-wrap gap-2 mt-2">
                                    @foreach($haftanin_gunleri as $gun)
                                        @php
                                            $uniqueId = "gun_{$loop->parent->index}_{$loop->index}"; // Benzersiz ID oluştur
                                        @endphp
                                        <div class="form-check me-3">
                                            <input class="form-check-input" 
                                                type="checkbox" 
                                                name="akademisyenler[{{ $loop->parent->index }}][gunler][]" 
                                                value="{{ $gun }}" 
                                                id="{{ $uniqueId }}" 
                                                {{ isset($kayit->gunler) && in_array($gun, $kayit->gunler) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="{{ $uniqueId }}">{{ $gun }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Sil -->
                            <div class="col-lg-1 align-self-center text-end">
                                <button data-repeater-delete type="button" class="btn btn-danger text-white mt-3">Sil</button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Eğer kayıt yoksa varsayılan bir satır göster -->
                    <div data-repeater-item class="row mb-2">
                        <!-- Akademisyen -->
                        <div class="col-lg-5 me-3">
                            <label for="akademisyen" class="ps-2 mb-2"><b>Akademisyen</b></label>
                            <div class="mb-3 p-1">
                                <select name="akademisyen_id" class="form-select" required>
                                    <option value="">Lütfen Akademisyeni Seçiniz</option>
                                    @foreach($akademisyenler as $akademisyen)
                                        <option value="{{ $akademisyen->id }}">
                                            {{ $akademisyen->isim }} {{ $akademisyen->soyisim }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Günler -->
                        <div class="col-lg-5">
                            <label class="ps-2 mb-2"><b>Günler</b></label>
                            <div class="mb-3 d-flex flex-wrap gap-2 mt-2">
                                @foreach($haftanin_gunleri as $gun)
                                    @php
                                        // Benzersiz bir ID oluştur
                                        $uniqueId = uniqid('gun_');
                                    @endphp
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                            type="checkbox" 
                                            name="akademisyenler[{{ $loop->parent->index }}][gunler][]" 
                                            value="{{ $gun }}" 
                                            id="{{ $uniqueId }}">
                                        <label class="form-check-label" for="{{ $uniqueId }}">{{ $gun }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>



                        <!-- Sil -->
                        <div class="col-lg-1 align-self-center text-center">
                            <button data-repeater-delete type="button" class="btn btn-danger text-white mt-3">Sil</button>
                        </div>
                    </div>
                @endif
            </div>

            <button data-repeater-create type="button" class="btn btn-success text-white">Akademisyen Ekle</button>
            <button type="submit" class="btn btn-primary w-100 mt-4">Kaydet</button>
        </form>

        </div>
    </div>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Repeater için gerekli JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
<script src="https://unpkg.com/vue@3.2.47/dist/vue.global.js"></script>
<script>
    $(document).ready(function () {
        let uniqueIndex = 0; // Benzersiz bir index değeri

        $('.repeater').repeater({
            initEmpty: false,
            defaultValues: {
                'akademisyen_id': '',
                'gunler': [],
            },
            show: function () {
                // Yeni eleman eklenirken benzersiz ID'ler oluştur
                $(this).find('.form-check-input').each(function () {
                    uniqueIndex++; // Her yeni input için index artır
                    let uniqueId = `gun_${uniqueIndex}`; // Benzersiz ID oluştur
                    $(this).attr('id', uniqueId); // ID'yi güncelle
                    $(this).siblings('label').attr('for', uniqueId); // Label ile eşleştir
                });

                $(this).slideDown(); // Animasyonlu gösterim
            },
            hide: function (deleteElement) {
                if (confirm('Bu kaydı silmek istediğinize emin misiniz?')) {
                    $(this).slideUp(deleteElement);
                }
            },
        });

        // Mevcut öğeleri başlangıçta benzersiz ID'lerle güncelle
        $('.form-check-input').each(function () {
            uniqueIndex++;
            let uniqueId = `gun_${uniqueIndex}`;
            $(this).attr('id', uniqueId);
            $(this).siblings('label').attr('for', uniqueId);
        });
    });


    // Sadece "success" ve "danger" sınıflarına sahip alert'leri kaldırmak için
    document.addEventListener('DOMContentLoaded', function () {
        // Success ve Danger alert'leri seç
        const alerts = document.querySelectorAll('.alert-success, .alert-danger');
        
        // 2 saniye sonra alert'leri kaldır
        setTimeout(() => {
            alerts.forEach(alert => {
                alert.classList.add('fade'); // Fade-out animasyonu için fade sınıfı ekle
                setTimeout(() => alert.remove(), 500); // Fade-out tamamlanınca kaldır
            });
        }, 2000); // 2 saniye bekleme süresi
    });

</script>

<style>
        #sınıftab {
            margin-top: -80px; /* Yukarıya çekmek için negatif margin */
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.5);
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

        .akademisyen-rengi{
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin: auto;
            background-color: #563d7c;
        }

    </style>
@endsection
