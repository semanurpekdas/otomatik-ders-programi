@extends('layout')

@section('title', 'Kullanıcı Rolleri')

@section('content')
    <div class="px-5 mt-5 pt-4">
        <div class="bg-white border shadow p-3 pt-5">
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center bg-secondary rounded w-75 text-white py-3" id="sınıftab">
                    <h2>Roller Ve Kullanıcılar</h2>
                </div>
            </div>
            <div class="mt-3">
            <div class="d-flex justify-content-end my-3">
                    <div>
                        <a href="{{ route('admin.users') }}" class="btn btn-dark dark-active-overlay text-white">Kullanıcılar</a>
                        <a href="{{ route('admin.roller') }}" class="btn btn-info info-active-overlay text-white">Roller</a>
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
                <div class="d-flex align-items-start">
                    <!-- Roller Listesi -->
                    <div class="nav flex-column nav-pills me-3 border-end pe-3 " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach($roles as $role)
                            <a class="nav-link {{ $selectedRoleId == $role->id ? 'active' : '' }}" 
                            href="{{ route('admin.userRole', ['role_id' => $role->id]) }}" 
                            id="v-pills-{{ $role->id }}-tab" 
                            type="button" role="tab" 
                            aria-controls="v-pills-{{ $role->id }}" 
                            aria-selected="{{ $selectedRoleId == $role->id ? 'true' : 'false' }}">
                                {{ $role->isim }}
                            </a>
                        @endforeach
                    </div>
                    <!-- Kullanıcılar Tablosu -->
                    <div class="tab-content " id="v-pills-tabContent" style="width:83% !important"> <!-- tab-content %100 genişlik olarak ayarlandı -->
                        <div class="tab-pane fade show active" id="v-pills-{{ $selectedRoleId }}" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                            @if($kullanıcılar->count() > 0) <!-- Kullanıcı var mı kontrolü -->
                                <table class="table border table-hover mt-4 table-striped">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col"><b>#</b></th>
                                            <th scope="col"><b>İsim Soyisim</b></th>
                                            <th scope="col"><b>E-Mail</b></th>
                                            <th scope="col"><b>Üniversite</b></th>
                                            <th scope="col"><b>Bölüm</b></th>
                                            <th scope="col"><b>İşlemler</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kullanıcılar as $kullanıcı)
                                        <tr>
                                            <th scope="row">{{ ($kullanıcılar->currentPage() - 1) * $kullanıcılar->perPage() + $loop->iteration }}</th>
                                            <td>{{ $kullanıcı->isim }} {{ $kullanıcı->soyisim }}</td>
                                            <td>{{ $kullanıcı->email }}</td>
                                            <td>{{ optional($kullanıcı->universite)->isim ?? 'Üniversite Yok' }}</td>
                                            <td>{{ optional($kullanıcı->bolum)->bolum_isim ?? 'Bölüm Yok' }}</td>
                                            <td>
                                                <div class="d-flex justify-content-start text-white">
                                                    <!-- Güncelle Butonu -->
                                                    <a href="{{ route('admin.editUser', $kullanıcı->guid) }}" class="btn btn-primary me-2">
                                                        Düzenle
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <nav class="d-flex justify-content-center">
                                    {{ $kullanıcılar->appends(['role_id' => $selectedRoleId])->links('vendor.pagination.bootstrap-5') }}
                                </nav>
                            @else
                                <!-- Eğer kullanıcı yoksa bu alert gösterilecek -->
                                <div class="alert alert-warning text-center" role="alert">
                                    Seçtiğiniz Rolde Kullanıcı Bulunmamaktadır.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
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

        #v-pills-tab {
            min-height: 55vh !important;
        }

        #v-pills-tab .nav-link {
            font-size: 1.1rem;
            color: #4caf50;
        }

        #v-pills-tab .nav-link.active {
            background-color: #4caf50;
            color: white;
            box-shadow: 0 8px 15px rgba(76, 175, 80, 0.5); /* Işık efekti */
        }


    </style>
@endsection
