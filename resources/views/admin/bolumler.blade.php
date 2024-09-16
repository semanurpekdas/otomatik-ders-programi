@extends('layout')

@section('title', 'Bolumler')

@section('content')
    <div class="px-5 mt-5 pt-4">
        <div class="bg-white border shadow p-3 pt-5">
            <div class="d-flex justify-content-center" >
                <div class="d-flex justify-content-center bg-secondary rounded w-75 text-white py-3" id="sınıftab">
                    <h2>Bolumler</h2>
                </div>
            </div>
            <div class=" mt-3">
                <div class="d-flex justify-content-between my-3">
                    <div>
                        <button class="btn btn-warning text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Filtre</button>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Bolum Filtreleme</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <!-- Filtreleme formu -->
                                <form action="{{ route('admin.bolumler') }}" method="GET" id="searchForm">
                                    <!-- Bölüm ismine göre sıralama -->
                                    <label for="bolum_siralama" class="form-label">Bölüm İsmine Göre Sırala</label>
                                    <div class="mb-3 px-1">
                                        <select class="form-select" name="fakulte_order" id="bolum_siralama">
                                            <option value="" {{ request('fakulte_order') == '' ? 'selected' : '' }}>Bölüm İsmine Göre Sırala</option>
                                            <option value="asc" {{ request('fakulte_order') == 'asc' ? 'selected' : '' }}>A'dan Z'ye</option>
                                            <option value="desc" {{ request('fakulte_order') == 'desc' ? 'selected' : '' }}>Z'den A'ya</option>
                                        </select>
                                    </div>

                                    <!-- Bölüm adı arama inputu -->
                                    <label for="bolum_adi" class="form-label">Bölüm Adı</label>
                                    <div class="mb-3 px-1">
                                        <input type="text" class="form-control" name="bolum_adi" id="bolum_adi" value="{{ request('bolum_adi') }}" placeholder="Bölüm Adı">
                                    </div>

                                    <!-- Fakülte adını datalist ile kullanıcıya sunuyoruz -->
                                    <label for="fakulte_adi" class="form-label">Fakülte Adı</label>
                                    <div class="mb-3 px-1">
                                        <input list="fakultelerList" name="fakulte_adi" id="fakulte_adi" value="{{ request('fakulte_adi') }}" class="form-control" placeholder="Fakülte Adı">
                                        <datalist id="fakultelerList">
                                            @foreach($fakulteler as $fakulte)
                                                <option value="{{ $fakulte->fakulte_isim }}"></option>
                                            @endforeach
                                        </datalist>
                                    </div>

                                    <!-- Üniversite adını datalist ile kullanıcıya sunuyoruz -->
                                    <label for="universite_adi" class="form-label">Üniversite Adı</label>
                                    <div class="mb-3 px-1">
                                        <input list="universitelerList" name="universite_adi" id="universite_adi" value="{{ request('universite_adi') }}" class="form-control" placeholder="Üniversite Adı">
                                        <datalist id="universitelerList">
                                            @foreach($universiteler as $universite)
                                                <option value="{{ $universite->isim }}"></option>
                                            @endforeach
                                        </datalist>
                                    </div>

                                    <button type="submit" class="btn btn-warning text-white w-100">Filtrele</button>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#sınıfEkleModal">Bolum Ekle</button>
                        <!-- Universite ekleme modal -->
                        <div class="modal fade" id="sınıfEkleModal" tabindex="-1" aria-labelledby="sınıfEkleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="sınıfEkleModalLabel">Bolum Ekle</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.addBolum') }}" method="POST" id="bolumForm">
                                            @csrf

                                            <!-- Üniversite seçimi için datalist -->
                                            <label for="createUniversiteAdi" class="form-label">Üniversite Adı</label>
                                            <div class="mb-3 px-1">
                                                <input list="universitelerList" name="universite_adi" id="createUniversiteAdi" class="form-control" required>
                                                <datalist id="universitelerList">
                                                    @foreach($universiteler as $universite)
                                                        <option value="{{ $universite->isim }}">
                                                    @endforeach
                                                </datalist>
                                            </div>
                                            
                                            <!-- Fakülte ve üniversite isimlerini birlikte gösteren ekleme bölümü -->
                                            <label for="createFakulteAdi" class="form-label">Fakülte Adı</label>
                                            <div class="mb-3 px-1">
                                                <input list="fakultelerList2" name="fakulte_adi" id="createFakulteAdi" class="form-control" required>
                                                <datalist id="fakultelerList2">
                                                    @foreach($fakulteler2 as $fakulte)
                                                        <option value="{{ $fakulte->fakulte_isim }} ({{ $fakulte->universite->isim }})"></option>
                                                    @endforeach
                                                </datalist>
                                            </div>

                                            <!-- Bölüm ekleme -->
                                            <label for="createBolumAdi" class="form-label">Bölüm Adı</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" name="bolum_adi" id="createBolumAdi" required>
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
                            <th scope="col"><b>Bolum Adı</b></th>
                            <th scope="col"><b>Fakülte</b></th>
                            <th scope="col"><b>Üniversite</b></th>
                            <th scope="col"><b>İşlemler</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bolumler as $bolum)
                            <tr>
                                <th scope="row">{{ ($bolumler->currentPage() - 1) * $bolumler->perPage() + $loop->iteration }}</th>
                                <td>{{ $bolum->bolum_isim }}</td>
                                <td>{{ $bolum->fakulte->fakulte_isim }}</td>
                                <td>{{ $bolum->fakulte->universite->isim }}</td>
                                <td>
                                    <div class="d-flex justify-content-start text-white">
                                        <!-- Güncelle Butonu -->
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#updateModal{{ $bolum->id }}">
                                            Düzenle
                                        </button>

                                        <!-- Bolum Güncelle Modal -->
                                        <div class="modal fade text-dark" id="updateModal{{ $bolum->id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateModalLabel">Bölüm Güncelle</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.updateBolum', $bolum->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <!-- Fakülte Adı -->
                                                            <label for="updateFakulteAdi{{ $bolum->id }}" class="form-label">Fakülte Adı</label>
                                                            <div class="mb-3 px-1">
                                                                <input list="fakultelerList2" name="fakulte_adi" id="updateFakulteAdi{{ $bolum->id }}" class="form-control" value="{{ $bolum->fakulte->fakulte_isim }} ({{ $bolum->fakulte->universite->isim }})" required>
                                                            </div>

                                                            <!-- Üniversite Adı -->
                                                            <label for="updateUniversiteAdi{{ $bolum->id }}" class="form-label">Üniversite Adı</label>
                                                            <div class="mb-3 px-1">
                                                                <input list="universitelerList" name="universite_adi" id="updateUniversiteAdi{{ $bolum->id }}" class="form-control" value="{{ $bolum->fakulte->universite->isim }}" required>
                                                            </div>

                                                            <!-- Bölüm Adı -->
                                                            <label for="updateBolumAdi{{ $bolum->id }}" class="form-label">Bölüm Adı</label>
                                                            <div class="mb-3 px-1">
                                                                <input type="text" class="form-control" name="bolum_adi" id="updateBolumAdi{{ $bolum->id }}" value="{{ $bolum->bolum_isim }}" required>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary">Güncelle</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sil Butonu -->
                                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $bolum->id }}">
                                            Sil
                                        </button>

                                        <!-- Bolum Sil Modal -->
                                        <div class="modal fade text-dark" id="deleteModal{{ $bolum->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Bölüm Sil</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.deleteBolum', $bolum->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="mb-3 px-1">
                                                                <input type="text" class="form-control d-none" value="{{ $bolum->bolum_isim }}" disabled>
                                                            </div>
                                                            <div class="alert alert-warning">
                                                                <b>{{ $bolum->fakulte->universite->isim }} {{ $bolum->bolum_isim }}</b>  bölümünü silmek istediğinize emin misiniz ?
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
                        @endforeach
                        @if($bolumler->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">Bölüm Bulunamadı</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                <!-- Pagination -->
                <nav class="d-flex justify-content-center">
                    {{ $bolumler->links('vendor.pagination.bootstrap-5') }}
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
            <option value="">
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

    <!-- JavaScript: Fakülte seçildiğinde parantez içindeki üniversite adını hemen sil -->
    <script>
        document.getElementById('createFakulteAdi').addEventListener('input', function () {
            var fakulteInput = document.getElementById('createFakulteAdi');
            var fakulteValue = fakulteInput.value;

            // Parantez içindeki üniversite adını anlık olarak silmek için regex kullanıyoruz
            fakulteValue = fakulteValue.replace(/\s*\(.*?\)\s*/g, '');
            fakulteInput.value = fakulteValue; // Fakülte adını güncelliyoruz
        });
        document.querySelectorAll('[id^="updateFakulteAdi"]').forEach(function(input) {
            input.addEventListener('input', function () {
                var fakulteValue = input.value;
                // Parantez içindeki üniversite adını anlık olarak silmek için regex kullanıyoruz
                fakulteValue = fakulteValue.replace(/\s*\(.*?\)\s*/g, '');
                input.value = fakulteValue; // Fakülte adını güncelliyoruz
            });
        });

    </script>


@endsection
