@extends('layout')

@section('title', 'Roller')

@section('content')
    <div class="px-5 mt-5 pt-4">
        <div class="bg-white border shadow p-3 pt-5">
            <div class="d-flex justify-content-center" >
                <div class="d-flex justify-content-center bg-secondary rounded w-75 text-white py-3" id="sınıftab">
                    <h2>Roller</h2>
                </div>
            </div>
            <div class=" mt-3">
                <div class="d-flex justify-content-between my-3">
                    <div>
                        <button class="btn btn-warning text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Filtre</button>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Rol Filtreleme</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body"> 
                                <!-- Filtreleme formu -->
                                <form action="{{ route('admin.roller') }}" method="GET" id="searchForm">
                                    @csrf
                                    <label for="roladi" class="form-label">Rol Adı</label>
                                    <div class="mb-3 px-1">
                                        <input name="rol_adi" id="roladi" class="form-control" value="{{ request('rol_adi') }}">
                                    </div>

                                    <!-- Yetkiler için checkboxlar -->
                                    <div class="mb-4">
                                        <label for="permissions" class="form-label">Yetkiler</label>
                                        @php
                                            $permissions = ['universite', 'fakulte', 'bolum', 'dersprogramı', 'dersler', 'salonlar', 'user', 'role', 'ayar', 'akademisyen'];
                                        @endphp
                                        @foreach($permissions as $permission)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="{{ $permission }}" id="{{ $permission }}" {{ request($permission) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="{{ $permission }}">{{ ucfirst($permission) }} Yönetimi</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button type="submit" class="btn btn-warning text-white w-100">Filtrele</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('admin.userRole') }}" class="btn btn-dark dark-active-overlay text-white">Kullanıcı Rolleri</a>
                        <button class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#roleklemodal">Rol Ekle</button>
                        <div class="modal fade" id="roleklemodal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="roleklemodalLabel">Rol Ekle</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.addRole') }}" method="POST" id="rolform">
                                            @csrf
                                            <label for="roladi" class="form-label">Rol Adı</label>
                                            <div class="mb-3 px-1">
                                                <input name="rol_adi" id="roladi" class="form-control" required>
                                            </div>

                                            <!-- Yetkiler için checkboxlar -->
                                            <div class="mb-4">
                                                <label for="permissions" class="form-label">Yetkiler</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="user" id="createuser">
                                                    <label class="form-check-label" for="createuser">Kullanıcı Yönetimi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="role" id="createrole">
                                                    <label class="form-check-label" for="createrole">Rol Yönetimi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="universite" id="createuniversite">
                                                    <label class="form-check-label" for="createuniversite">Üniversite Yönetimi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="fakulte" id="createfakulte">
                                                    <label class="form-check-label" for="createfakulte">Fakülte Yönetimi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="bolum" id="createbolum">
                                                    <label class="form-check-label" for="createbolum">Bölüm Yönetimi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="dersprogramı" id="createdersprogramı">
                                                    <label class="form-check-label" for="createdersprogramı">Ders Programı Yönetimi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="dersler" id="createdersler">
                                                    <label class="form-check-label" for="createdersler">Dersler Yönetimi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="salonlar" id="createsalonlar">
                                                    <label class="form-check-label" for="createsalonlar">Salonlar Yönetimi</label>
                                                </div>
                                                
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="ayar" id="createayar">
                                                    <label class="form-check-label" for="createayar">Ayarlar Yönetimi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="akademisyen" id="createakademisyen">
                                                    <label class="form-check-label" for="createakademisyen">Akademisyen Yönetimi</label>
                                                </div>
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
                            <th scope="col"><b>Rol</b></th>
                            <th scope="col"><b>Yetkiler</b></th>
                            <th scope="col"><b>İşlemler</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <th scope="row">{{ ($roles->currentPage() - 1) * $roles->perPage() + $loop->iteration }}</th>
                                <td>{{ $role->isim }}</td>
                                <td>
                                    @if($role->universite)
                                        <span class="badge rounded-pill text-bg-primary">universite</span>
                                    @endif
                                    @if($role->fakulte)
                                        <span class="badge rounded-pill text-bg-primary">fakulte</span>
                                    @endif
                                    @if($role->bolum)
                                        <span class="badge rounded-pill text-bg-primary">bolum</span>
                                    @endif
                                    @if($role->dersprogramı)
                                        <span class="badge rounded-pill text-bg-primary">dersprogramı</span>
                                    @endif
                                    @if($role->dersler)
                                        <span class="badge rounded-pill text-bg-primary">dersler</span>
                                    @endif
                                    @if($role->salonlar)
                                        <span class="badge rounded-pill text-bg-primary">salonlar</span>
                                    @endif
                                    @if($role->user)
                                        <span class="badge rounded-pill text-bg-primary">user</span>
                                    @endif
                                    @if($role->role)
                                        <span class="badge rounded-pill text-bg-primary">role</span>
                                    @endif
                                    @if($role->ayar)
                                        <span class="badge rounded-pill text-bg-primary">ayar</span>
                                    @endif
                                    @if($role->akademisyen)
                                        <span class="badge rounded-pill text-bg-primary">akademisyen</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-start text-white">
                                        <!-- Güncelle Butonu -->
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#updateModal-{{ $role->id }}">
                                            Düzenle
                                        </button>

                                        <!-- Rol Güncelle Modal -->
                                        <div class="modal fade text-dark" id="updateModal-{{ $role->id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateModalLabel">Rol Güncelle</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.updateRole', $role->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3 px-2">
                                                                <input type="text" name="rol_adi" id="rol_adi_{{ $role->id }}" class="form-control" value="{{ $role->isim }}" required>
                                                            </div>
                                                            <!-- Yetkiler için checkbox'lar -->
                                                            @php
                                                                $permissions = ['user', 'role', 'universite', 'fakulte', 'bolum', 'dersprogramı', 'dersler', 'salonlar', 'ayar', 'akademisyen'];
                                                            @endphp
                                                            <div class="mb-4">
                                                                <label for="permissions" class="form-label">Yetkiler</label>
                                                                @foreach($permissions as $permission)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="{{ $permission }}" id="{{ $permission }}_{{ $role->id }}" 
                                                                        @if($role->$permission) checked @endif>
                                                                        <label class="form-check-label" for="{{ $permission }}_{{ $role->id }}">{{ $permission }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Güncelle</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sil Butonu -->
                                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $role->id }}">
                                            Sil
                                        </button>

                                        <!-- Rol Sil Modal -->
                                        <div class="modal fade text-dark" id="deleteModal-{{ $role->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Rol Sil</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.deleteRole', $role->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="alert alert-warning">
                                                                <b>{{ $role->isim }}</b> rolünü silmek istediğinize emin misiniz?
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
                    {{ $roles->links('vendor.pagination.bootstrap-5') }}
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
