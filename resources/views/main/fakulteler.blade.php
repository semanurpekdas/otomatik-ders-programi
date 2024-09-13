@extends('layout')

@section('title', 'Fakülteler')

@section('content')
    <div class="px-5 mt-5 pt-4">
        <div class="bg-white border shadow p-3 pt-5">
            <div class="d-flex justify-content-center" >
                <div class="d-flex justify-content-center bg-secondary rounded w-75 text-white py-3" id="sınıftab">
                    <h2>Fakülteler</h2>
                </div>
            </div>
            <div class=" mt-3">
                <div class="d-flex justify-content-between my-3">
                    <div>
                        <button class="btn btn-warning text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Filtre</button>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Fakülte Filtreleme</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <form action="{{ route('admin.fakulteler') }}" method="GET">
                                    <label for="fakulte_siralama" class="form-label">Fakülte İsmine Göre</label>
                                    <div class="mb-3 px-1">
                                        <select class="form-select" name="fakulte_order" id="fakulte_siralama">
                                            <option value="" selected>Fakülte İsmine Göre Sırala</option>
                                            <option value="asc">A'dan Z'ye</option>
                                            <option value="desc">Z'den A'ya</option>
                                        </select>
                                    </div>
                                    
                                    <label for="universite_siralama" class="form-label">Üniversite İsmine Göre</label>
                                    <div class="mb-3 px-1">
                                        <select class="form-select" name="universite_order" id="universite_siralama">
                                            <option value="" selected>Üniversite İsmine Göre Sırala</option>
                                            <option value="asc">A'dan Z'ye</option>
                                            <option value="desc">Z'den A'ya</option>
                                        </select>
                                    </div>
                                    
                                    <label for="fakulte_adi" class="form-label">Fakülte Adı</label>
                                    <div class="mb-3 px-1">
                                        <input type="text" class="form-control" name="fakulte_adi" id="fakulte_adi" placeholder="İsteğe Bağlı">
                                    </div>
                                    
                                    <label for="universite_adi" class="form-label">Üniversite Adı</label>
                                    <div class="mb-3 px-1">
                                        <input type="text" class="form-control" name="universite_adi" id="universite_adi" list="universiteler" placeholder="İsteğe Bağlı">
                                    </div>
                                    
                                    <button type="submit" class="btn btn-warning text-white w-100">Filtrele</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#sınıfEkleModal">Fakülte Ekle</button>
                        <!-- Universite ekleme modal -->
                        <div class="modal fade" id="sınıfEkleModal" tabindex="-1" aria-labelledby="sınıfEkleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="sınıfEkleModalLabel">Fakülte Ekle</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.addFakulte') }}" method="POST">
                                            @csrf
                                            <label for="createFakulteadi" class="form-label">Fakülte Adı</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" name="fakulte_adi" id="createFakulteadi" required>
                                            </div>
                                            <label for="createuniversiteadi" class="form-label">Üniversite</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" name="universite_adi" list="universiteler" id="createuniversiteadi" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Ekle</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th scope="col"><b>#</b></th>
                            <th scope="col"><b>Fakülte</b></th>
                            <th scope="col"><b>Üniversite</b></th>
                            <th scope="col"><b>İşlemler</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fakulteler as $index => $fakulte)
                            <tr>
                            <th scope="row">{{ ($fakulteler->currentPage() - 1) * $fakulteler->perPage() + $loop->iteration }}</th>
                                <td>{{ $fakulte->fakulte_isim }}</td>
                                <td>{{ $fakulte->universite->isim }}</td>
                                <td>
                                    <div class="d-flex justify-content-start text-white">
                                        <!-- Güncelle Butonu -->
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#update{{ $fakulte->id }}">
                                            Düzenle
                                        </button>

                                        <!-- Fakülte Güncelle Modal -->
                                        <div class="modal fade text-dark" id="update{{ $fakulte->id }}" tabindex="-1" aria-labelledby="updateModalLabel{{ $fakulte->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateModalLabel{{ $fakulte->id }}">Fakülte Güncelle</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.updateFakulte', $fakulte->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <label for="updateFakulteadi{{ $fakulte->id }}" class="form-label">Fakülte Adı</label>
                                                            <div class="mb-3 px-1">
                                                                <input type="text" class="form-control" name="fakulte_adi" id="updateFakulteadi{{ $fakulte->id }}" value="{{ $fakulte->fakulte_isim }}" required>
                                                            </div>
                                                            <label for="updateuniversiteadi{{ $fakulte->id }}" class="form-label">Üniversite</label>
                                                            <div class="mb-3 px-1">
                                                                <input type="text" class="form-control" name="universite_adi" list="universiteler" id="updateuniversiteadi{{ $fakulte->id }}" value="{{ $fakulte->universite->isim }}" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Güncelle</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sil Butonu -->
                                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $fakulte->id }}">
                                            Sil
                                        </button>

                                        <!-- Fakülte Sil Modal -->
                                        <div class="modal fade text-dark" id="deleteModal{{ $fakulte->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $fakulte->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $fakulte->id }}">Fakülte Sil</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.deleteFakulte', $fakulte->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <label for="deleteFakulteadi{{ $fakulte->id }}" class="form-label">Fakülte Adı</label>
                                                            <div class="mb-3 px-1">
                                                                <input type="text" class="form-control" id="deleteFakulteadi{{ $fakulte->id }}" value="{{ $fakulte->fakulte_isim }}" disabled>
                                                            </div>
                                                            <button type="submit" class="btn btn-danger">Sil</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if($fakulteler->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">Fakülte Bulunamadı</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                <!-- Pagination -->
                <nav class="d-flex justify-content-center">
                    {{ $fakulteler->links('vendor.pagination.bootstrap-5') }}
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

        .ders-rengi{
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin: auto;
            background-color: #563d7c;
        }

    </style>

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



@endsection
