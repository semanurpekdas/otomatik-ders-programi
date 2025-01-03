@extends('layout')

@section('title', 'Akademisyenler')

@section('content')
    <div class="px-5 my-5 pt-4">
        <div class="bg-white border shadow p-3 pt-5">
            <div class="d-flex justify-content-center" >
                <div class="d-flex justify-content-center bg-success rounded w-75 text-white py-3" id="sınıftab">
                    <h2>Akademisyenler</h2>
                </div>
            </div>
            <div class=" mt-3">
                <div class="d-flex justify-content-between my-4">
                    <div>
                        <button class="btn btn-warning text-white warning-active-overlay" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Filtre</button>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Akademisyen Filtreleme</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <form method="GET" action="{{ route('akademisyenler') }}">
                                    <label for="bolum_id" class="form-label">Bölüme Göre</label>
                                    <div class="mb-3 px-1">
                                        <select class="form-select" name="bolum_id" aria-label="Bölüm Seçiniz">
                                            <option value="">Bölüm Seçiniz</option>
                                            @foreach($bolumler as $bolum2)
                                                <option value="{{ $bolum2->id }}" {{ request('bolum_id') == $bolum2->id ? 'selected' : '' }}>
                                                    {{ $bolum2->bolum_isim }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="isim" class="form-label">İsim Soyisim</label>
                                    <div class="mb-3 px-1">
                                        <input type="text" class="form-control" name="isim" id="isim" value="{{ request('isim') }}">
                                    </div>
                                    <label for="email" class="form-label">E-posta</label>
                                    <div class="mb-3 px-1">
                                        <input type="email" class="form-control" name="email" id="email" value="{{ request('email') }}">
                                    </div>
                                    <button type="submit" class="btn btn-warning text-white w-100">Filtrele</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('akademisyenler.gun') }}" class="btn btn-primary text-white primary-active-overlay">Akademisyen Gün Ayarları</a>
                        <button class="btn btn-secondary text-white secondary-active-overlay" data-bs-toggle="modal" data-bs-target="#akademisyengetir">Akademisyen Getir</button>
                        <div class="modal fade" id="akademisyengetir" tabindex="-1" aria-labelledby="sınıfEkleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="sınıfEkleModalLabel">Akademisyen Getir</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <label for="createEposta" class="form-label">E-Posta</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" id="createEposta">
                                            </div>
                                            <button type="submit" class="btn btn-secondary text-white w-100 mt-3">Getir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success text-white success-active-overlay" data-bs-toggle="modal" data-bs-target="#sınıfEkleModal">Akademisyen Ekle</button>
                        <!-- Akademisyen ekleme modal -->
                        <div class="modal fade" id="sınıfEkleModal" tabindex="-1" aria-labelledby="sınıfEkleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="sınıfEkleModalLabel">Akademisyen Ekle</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('akademisyenler.store') }}">
                                            @csrf
                                            <label for="createİsim" class="form-label">İsim</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" name="isim" id="createİsim" required>
                                            </div>

                                            <label for="createSoyisim" class="form-label">Soyisim</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" name="soyisim" id="createSoyisim" required>
                                            </div>

                                            <label for="createKisa" class="form-label">Kısa Kod</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" name="kisa_kod" id="createKisa" required>
                                            </div>

                                            <label for="createCinsiyet" class="form-label">Cinsiyet</label>
                                            <div class="mb-3 px-1">
                                                <select class="form-select" name="cinsiyet" required>
                                                    <option value="">Cinsiyet Seçiniz</option>
                                                    <option value="Erkek">Erkek</option>
                                                    <option value="Kadın">Kadın</option>
                                                </select>
                                            </div>

                                            <label for="createUnvan" class="form-label">Unvan</label>
                                            <div class="mb-3 px-1">
                                                <select class="form-select" name="unvan" required>
                                                    <option value="">Unvan Seçiniz</option>
                                                    <option value="Arş. Gör.">Arş. Gör.</option>
                                                    <option value="Dr. Öğr.">Dr. Öğr.</option>
                                                    <option value="Doç. Dr.">Doç. Dr.</option>
                                                    <option value="Prof. Dr.">Prof. Dr.</option>
                                                </select>
                                            </div>

                                            <label for="createBolum" class="form-label">Bölüm</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" name="bolum" value="{{ $bolum->bolum_isim }}" readonly>
                                            </div>

                                            <label for="createFakulte" class="form-label">Fakülte</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" name="fakulte" value="{{ $fakulte->fakulte_isim }}" readonly>
                                            </div>

                                            <label for="createEmail" class="form-label">Kurumsal E-posta</label>
                                            <div class="mb-3 px-1">
                                                <input type="email" class="form-control" name="email" id="createEmail" required>
                                            </div>

                                            <label for="exampleColorInput" class="form-label">Renk Kodu</label>
                                            <div class="mb-3 px-1">
                                                <input type="color" class="form-control form-control-color w-100" name="renk_kodu" id="exampleColorInput" value="#563d7c" required>
                                            </div>

                                            <button type="submit" class="btn btn-success text-white w-100 mt-3">Ekle</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><b>#</b></th>
                            <th scope="col"><b>İsmi</b></th>
                            <th scope="col"><b>Soyisim</b></th>
                            <th scope="col"><b>Kısa Kod</b></th>
                            <th scope="col"><b>Bölüm</b></th>
                            <th scope="col"><b>Kurumsal E-posta</b></th>
                            <th scope="col"><b>Renk Kodu</b></th>
                            <th scope="col"><b>İşlemler</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($akademisyenler as $akademisyen)
                            <tr>
                                <th scope="row">{{ ($akademisyenler->currentPage() - 1) * $akademisyenler->perPage() + $loop->iteration }}</th>
                                <td>{{ $akademisyen->isim }}</td>
                                <td>{{ $akademisyen->soyisim }}</td>
                                <td>{{ $akademisyen->kisa_kod }}</td>
                                <td>{{ $akademisyen->bolum->bolum_isim ?? 'Bölüm Yok' }}</td>
                                <td>{{ $akademisyen->email }}</td>
                                <td><div class="akademisyen-rengi" style="background-color: {{ $akademisyen->renk_kodu }};"></div></td>
                                <td>
                                    <div class="d-flex justify-content-start text-white">
                                        <!-- Detay Butonu -->
                                        <button class="btn btn-secondary me-2 text-white" data-bs-toggle="modal" data-bs-target="#detay-{{ $akademisyen->guid }}">
                                            Detay
                                        </button>
                                        <!-- Detay Modalı -->
                                        <div class="modal fade text-dark" id="detay-{{ $akademisyen->guid }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Akademisyen Detay</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-4 me-3 d-flex ps-3 col-12 d-flex justify-content-center align-items-center pe-2">
                                                            <img src="{{ asset('images/' . ($akademisyen->cinsiyet == 'Erkek' ? 'erkek.png' : 'kadin.png')) }}" alt="Profil Fotoğrafı" class="rounded-circle border shadow p-0" width="200" height="200" id="profileimg">
                                                        </div>
                                                        <h4 class="text-center">{{ $akademisyen->unvan }} {{ $akademisyen->isim }} {{ $akademisyen->soyisim }}</h4>
                                                        <div class="d-flex justify-content-center align-items-center p-3 border my-4 shadow">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row" class="text-end">Fakülte:</th>
                                                                        <td>{{ $akademisyen->fakulte->fakulte_isim }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row" class="text-end">Bölüm:</th>
                                                                        <td>{{ $akademisyen->bolum->bolum_isim }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row" class="text-end">Eposta:</th>
                                                                        <td>{{ $akademisyen->email }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Düzenle Butonu ve Modal -->
                                        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal-{{ $akademisyen->guid }}">
                                            Düzenle
                                        </button>

                                        <!-- Düzenleme Modalı -->
                                        <div class="modal fade text-dark" id="editModal-{{ $akademisyen->guid }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Akademisyen Düzenle</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('akademisyenler.update', $akademisyen->guid) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <label for="editİsim" class="form-label">İsim</label>
                                                            <div class="mb-3 px-1">
                                                                <input type="text" class="form-control" name="isim" value="{{ $akademisyen->isim }}" required>
                                                            </div>

                                                            <label for="editSoyisim" class="form-label">Soyisim</label>
                                                            <div class="mb-3 px-1">
                                                                <input type="text" class="form-control" name="soyisim" value="{{ $akademisyen->soyisim }}" required>
                                                            </div>

                                                            <label for="editKisaKod" class="form-label">Kısa Kod</label>
                                                            <div class="mb-3 px-1">
                                                                <input type="text" class="form-control" name="kisa_kod" value="{{ $akademisyen->kisa_kod }}" required>
                                                            </div>

                                                            <label for="editCinsiyet" class="form-label">Cinsiyet</label>
                                                            <div class="mb-3 px-1">
                                                                <select class="form-select" name="cinsiyet" required>
                                                                    <option value="Erkek" {{ $akademisyen->cinsiyet == 'Erkek' ? 'selected' : '' }}>Erkek</option>
                                                                    <option value="Kadın" {{ $akademisyen->cinsiyet == 'Kadın' ? 'selected' : '' }}>Kadın</option>
                                                                </select>
                                                            </div>

                                                            <label for="editUnvan" class="form-label">Unvan</label>
                                                            <div class="mb-3 px-1">
                                                                <select class="form-select" name="unvan" required>
                                                                    <option value="Arş. Gör." {{ $akademisyen->unvan == 'Arş. Gör.' ? 'selected' : '' }}>Arş. Gör.</option>
                                                                    <option value="Dr. Öğr." {{ $akademisyen->unvan == 'Dr. Öğr.' ? 'selected' : '' }}>Dr. Öğr.</option>
                                                                    <option value="Doç. Dr." {{ $akademisyen->unvan == 'Doç. Dr.' ? 'selected' : '' }}>Doç. Dr.</option>
                                                                    <option value="Prof. Dr." {{ $akademisyen->unvan == 'Prof. Dr.' ? 'selected' : '' }}>Prof. Dr.</option>
                                                                </select>
                                                            </div>

                                                            <label for="editEmail" class="form-label">Kurumsal E-posta</label>
                                                            <div class="mb-3 px-1">
                                                                <input type="email" class="form-control" name="email" value="{{ $akademisyen->email }}" required>
                                                            </div>

                                                            <label for="editRenkKodu" class="form-label">Renk Kodu</label>
                                                            <div class="mb-3 px-1">
                                                                <input type="color" class="form-control form-control-color w-100" name="renk_kodu" value="{{ $akademisyen->renk_kodu }}" required>
                                                            </div>

                                                            <button type="submit" class="btn btn-success text-white w-100 mt-3">Güncelle</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sil Butonu -->
                                        <button class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $akademisyen->guid }}">
                                            Sil
                                        </button>
                                        <!-- Silme Modalı -->
                                        <div class="modal fade text-dark" id="deleteModal-{{ $akademisyen->guid }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Akademisyen Sil</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('akademisyenler.delete', $akademisyen->guid) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="alert alert-warning">
                                                                <b>{{ $akademisyen->isim }} {{ $akademisyen->soyisim }}</b> isimli akademisyeni silmek istediğinize emin misiniz?
                                                            </div>
                                                            <button type="submit" class="btn btn-danger text-white">Sil</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Akademisyen kaydı bulunmamaktadır.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Pagination -->
                <nav class="d-flex justify-content-center">
                    {{ $akademisyenler->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>

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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Tüm mb-3 sınıfına sahip divleri seç
            const formGroups = document.querySelectorAll('.mb-3');

            formGroups.forEach(function (div) {
                // İçindeki input ve select elemanlarını seç
                const input = div.querySelector('.form-control');
                const select = div.querySelector('.form-select');

                // Input elemanı varsa odaklandığında stil ekle
                if (input) {
                    input.addEventListener('focus', function () {
                        div.style.border = '1px solid #034f84';
                        div.style.borderRadius = '10px';
                        div.style.borderLeft = '7px solid #034f84';
                    });

                    // Odak dışına çıkıldığında stilini sıfırla
                    input.addEventListener('blur', function () {
                        div.style.border = '1px solid rgba(0, 0, 0, 0.2)';
                        div.style.borderRadius = '10px';
                    });
                }

                // Select elemanı varsa odaklandığında stil ekle
                if (select) {
                    select.addEventListener('focus', function () {
                        div.style.border = '1px solid #034f84';
                        div.style.borderRadius = '10px';
                        div.style.borderLeft = '7px solid #034f84';
                    });

                    // Odak dışına çıkıldığında stilini sıfırla
                    select.addEventListener('blur', function () {
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
