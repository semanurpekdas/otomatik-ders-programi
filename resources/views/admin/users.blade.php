@extends('layout')

@section('title', 'Users')

@section('content')
    <div class="px-5 mt-5 pt-4">
        <div class="bg-white border shadow p-3 pt-5">
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center bg-secondary rounded w-75 text-white py-3" id="sınıftab">
                    <h2>Kullanıcılar</h2>
                </div>
            </div>
            <div class="mt-3">
                <div class="d-flex justify-content-between my-3">
                    <div>
                        <button class="btn btn-warning text-white warning-active-overlay" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Filtre</button>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Kullanıcı Filtreleme</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">  
                                <!-- Filtreleme formu -->
                                <form action="{{ route('admin.users') }}" method="GET" id="searchForm">
                                    @csrf
                                    <label for="isim" class="form-label">İsim Soyisim</label>
                                    <div class="mb-3 px-1">
                                        <input name="isim" id="isim" class="form-control" value="{{ request('isim') }}">
                                    </div>

                                    <label for="email" class="form-label">E-mail</label>
                                    <div class="mb-3 px-1">
                                        <input name="email" id="email" class="form-control" value="{{ request('email') }}">
                                    </div>

                                    <label for="universite" class="form-label">Üniversite</label>
                                    <div class="mb-3 px-1">
                                        <input name="universite" id="universite" class="form-control" list="universiteList" value="{{ request('universite') }}">
                                        <datalist id="universiteList">
                                            @foreach($universiteler as $universite)
                                                <option value="{{ $universite->isim }}">
                                            @endforeach
                                        </datalist>
                                    </div>

                                    <label for="bolum" class="form-label">Bölüm</label>
                                    <div class="mb-3 px-1">
                                        <input name="bolum" id="bolum" class="form-control" list="bolumList" value="{{ request('bolum') }}">
                                        <datalist id="bolumList">
                                            @foreach($bolumler as $bolum)
                                                <option value="{{ $bolum->bolum_isim }}">
                                            @endforeach
                                        </datalist>
                                    </div>

                                    <label for="unvan" class="form-label">Unvan</label>
                                    <div class="d-flex pe-3 mb-2">
                                        <div class="mb-3 d-flex px-2 col-12 d-flex align-items-center">
                                            <select class="form-select" aria-label="Unvan seç" name="unvan">
                                                <option value="">Tüm Unvanlar</option>
                                                <option value="Öğrenci" {{ request('unvan') == 'Öğrenci' ? 'selected' : '' }}>Öğrenci</option>
                                                <option value="Arş. Gör." {{ request('unvan') == 'Arş. Gör.' ? 'selected' : '' }}>Arş. Gör.</option>
                                                <option value="Dr. Öğr." {{ request('unvan') == 'Dr. Öğr.' ? 'selected' : '' }}>Dr. Öğr.</option>
                                                <option value="Doç. Dr." {{ request('unvan') == 'Doç. Dr.' ? 'selected' : '' }}>Doç. Dr.</option>
                                                <option value="Prof. Dr." {{ request('unvan') == 'Prof. Dr.' ? 'selected' : '' }}>Prof. Dr.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-warning text-white w-100">Filtrele</button>
                                </form>
                            </div> 
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('admin.userRole') }}" class="btn btn-dark dark-active-overlay text-white">Kullanıcı Rolleri</a>
                        <a href="{{ route('admin.userscreate') }}" class="btn btn-success success-active-overlay text-white">Kullanıcı Ekle</a>
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
                            <th scope="col"><b>İsim Soyisim</b></th>
                            <th scope="col"><b>E-Mail</b></th>
                            <th scope="col"><b>Üniversite</b></th>
                            <th scope="col"><b>Bölüm</b></th>
                            <th scope="col"><b>Unvan</b></th>
                            <th scope="col"><b>İşlemler</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kullanıcılar as $kullanıcı)
                        <tr>
                            <!-- Kullanıcıların sıralı numaralandırılması -->
                            <th scope="row">{{ ($kullanıcılar->currentPage() - 1) * $kullanıcılar->perPage() + $loop->iteration }}</th>

                            <!-- İsim Soyisim -->
                            <td>{{ $kullanıcı->isim }} {{ $kullanıcı->soyisim }}</td>

                            <!-- E-Mail -->
                            <td>{{ $kullanıcı->email }}</td>

                            <!-- Üniversite -->
                            <td>{{ optional($kullanıcı->universite)->isim ?? 'Üniversite Yok' }}</td>

                            <!-- Bölüm -->
                            <td>{{ optional($kullanıcı->bolum)->bolum_isim ?? 'Bölüm Yok' }}</td>

                            <!-- Unvan -->
                            <td>{{ $kullanıcı->unvan }}</td>

                            <!-- İşlemler -->
                            <td>
                                <div class="d-flex justify-content-start text-white">
                                    <!-- Güncelle Butonu -->
                                    <a href="{{ route('admin.editUser', $kullanıcı->guid) }}" class="btn btn-primary me-2">
                                        Düzenle
                                    </a>
                                    <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $kullanıcı->guid }}">
                                            Sil
                                    </button>
                                    <!-- Rol Sil Modal -->
                                    <div class="modal fade text-dark" id="deleteModal-{{ $kullanıcı->guid }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Kullanıcı Sil</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.deleteUser', $kullanıcı->guid) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="alert alert-warning">
                                                            <b>{{ $kullanıcı->isim }} {{ $kullanıcı->soyisim }}</b> kullanıcıyı silmek istediğinize emin misiniz? <b>(Rolleri de silinecektir! )</b>
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
                    </tbody>
                </table>

                <!-- Pagination -->
                <nav class="d-flex justify-content-center">
                    {{ $kullanıcılar->links('vendor.pagination.bootstrap-5') }}
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
