@extends('layout')

@section('title', 'Salonlar')

@section('content')
    <div class="px-5 my-5 pt-4">
        <div class="bg-white border shadow p-3 pt-5">
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center bg-primary rounded w-75 text-white py-3" id="sınıftab">
                    <h2>Salonlar</h2>
                </div>
            </div>

            @if ($errors->has('message'))
                <div class="alert alert-warning mt-3">
                    {{ $errors->first('message') }}
                </div>
            @endif

            <div class="mt-3">
                <div class="d-flex justify-content-between my-3">
                    <div>
                        <button class="btn btn-warning text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Filtre</button>
                        <!-- Salon Filtreleme -->
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Salon Filtreleme</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                            <form method="GET" action="{{ route('sınıflar.index') }}">
                                <label for="fakulte" class="form-label">Fakülteye Göre</label>
                                <div class="mb-3 px-1">
                                    <select class="form-select" name="fakulte_id" aria-label="Fakülte Seç">
                                        <option value="">Fakülte Seçiniz</option>
                                        @foreach($fakulteler as $fakulte)
                                            <option value="{{ $fakulte->id }}" {{ request('fakulte_id') == $fakulte->id ? 'selected' : '' }}>
                                                {{ $fakulte->fakulte_isim }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <label for="isim" class="form-label">Salon İsmi</label>
                                <div class="mb-3 px-1">
                                    <input name="isim" id="isim" class="form-control" value="{{ request('isim') }}">
                                </div>

                                <button type="submit" class="btn btn-warning text-white w-100">Filtrele</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#sınıfEkleModal">Salon Ekle</button>
                        <!-- sınıf ekleme modal -->
                        <div class="modal fade" id="sınıfEkleModal" tabindex="-1" aria-labelledby="sınıfEkleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="sınıfEkleModalLabel">Salon Ekle</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('sınıflar.store') }}">
                                            @csrf
                                            <label for="createsınıfAdı" class="form-label">Sınıf Adı</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" name="isim" id="createsınıfAdı" required>
                                            </div>

                                            <label for="createfakulte" class="form-label">Fakülte</label>
                                            <div class="mb-3 px-1">
                                                <select class="form-select" name="fakulte_id" required>
                                                    <option value="">Fakülte Seçiniz</option>
                                                    @foreach($fakulteler as $fakulte)
                                                        <option value="{{ $fakulte->id }}">{{ $fakulte->fakulte_isim }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <label for="createbolum" class="form-label">Bölüm</label>
                                            <div class="mb-3 px-1">
                                                <select class="form-select" name="bolum_id" required>
                                                    @foreach($bolumler as $bolum)
                                                        <option value="{{ $bolum->id }}">{{ $bolum->bolum_isim }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <label for="createkapasite" class="form-label">Kapasite</label>
                                            <div class="mb-3 px-1">
                                                <input type="number" class="form-control" name="kapasite" id="createkapasite" required>
                                            </div>

                                            <label for="exampleColorInput" class="form-label">Salon Rengi</label>
                                            <div class="mb-3 px-1">
                                                <input type="color" class="form-control form-control-color w-100" name="renk_kodu" id="exampleColorInput" value="#563d7c" title="Renk Seçiniz" required>
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
                            <th scope="col"><b>Salon İsmi</b></th>
                            <th scope="col"><b>Fakülte</b></th>
                            <th scope="col"><b>Bölüm</b></th>
                            <th scope="col"><b>Kapasite</b></th>
                            <th scope="col"><b>Salon Rengi</b></th>
                            <th scope="col"><b>İşlemler</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($salonlar as $salon)
                            <tr>
                                <th scope="row">{{ ($salonlar->currentPage() - 1) * $salonlar->perPage() + $loop->iteration }}</th>
                                <td>{{ $salon->isim }}</td>
                                <td>{{ $salon->fakulte->fakulte_isim ?? 'Fakülte Yok' }}</td>
                                <td>{{ $salon->bolum->bolum_isim ?? 'Bölüm Yok' }}</td>
                                <td>{{ $salon->kapasite }}</td>
                                <td><div class="salon-rengi" style="background-color: {{ $salon->renk_kodu }};"></div></td>
                                <td>
                                    <div class="d-flex justify-content-start text-white">
                                        <!-- Güncelle Butonu -->
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#updatemodal-{{ $salon->guid }}">
                                            Düzenle
                                        </button>
                                        <!-- Sil Butonu -->
                                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $salon->guid }}">
                                            Sil
                                        </button>

                                        <!-- Silme Modalı -->
                                        <div class="modal fade text-dark" id="deleteModal-{{ $salon->guid }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Salon Sil</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('sınıflar.deleteSalon', $salon->guid) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="alert alert-warning">
                                                                <b>{{ $salon->isim }}</b> isimli salonu silmek istediğinize emin misiniz ?
                                                            </div>
                                                            <button type="submit" class="btn btn-danger text-white">Sil</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Güncelleme Modalı -->
                                        <div class="modal fade text-dark" id="updatemodal-{{ $salon->guid }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateModalLabel">Salon Güncelle</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('sınıflar.updateSalon', $salon->guid) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <label for="isim" class="form-label">Sınıf Adı</label>
                                                            <div class="mb-3 px-1">
                                                                <input type="text" class="form-control" name="isim" id="isim" value="{{ $salon->isim }}" required>
                                                            </div>

                                                            <label for="fakulte_id" class="form-label">Fakülte</label>
                                                            <div class="mb-3 px-1">
                                                                <select class="form-select" name="fakulte_id" required>
                                                                    <option value="">Fakülte Seçiniz</option>
                                                                    @foreach($fakulteler as $fakulte)
                                                                        <option value="{{ $fakulte->id }}" {{ $salon->fakulte_id == $fakulte->id ? 'selected' : '' }}>{{ $fakulte->fakulte_isim }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <label for="bolum_id" class="form-label">Bölüm</label>
                                                            <div class="mb-3 px-1">
                                                                <select class="form-select" name="bolum_id" required>
                                                                    @foreach($bolumler as $bolum)
                                                                        <option value="{{ $bolum->id }}" {{ $salon->bolum_id == $bolum->id ? 'selected' : '' }}>{{ $bolum->bolum_isim }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <label for="kapasite" class="form-label">Kapasite</label>
                                                            <div class="mb-3 px-1">
                                                                <input type="number" class="form-control" name="kapasite" id="kapasite" value="{{ $salon->kapasite }}" required>
                                                            </div>

                                                            <label for="renk_kodu" class="form-label">Salon Rengi</label>
                                                            <div class="mb-3 px-1">
                                                                <input type="color" class="form-control form-control-color w-100" name="renk_kodu" id="renk_kodu" value="{{ $salon->renk_kodu }}" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-success text-white w-100 mt-3">Güncelle</button>
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
                                <td colspan="7" class="text-center text-muted">Bölümünüzde salon kaydı bulunmamaktadır.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                 <!-- Pagination -->
                <nav class="d-flex justify-content-center">
                    {{ $salonlar->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                </nav>
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

        .salon-rengi{
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #563d7c;
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
