@extends('layout')

@section('title', 'Dersler')

@section('content') 
    <div class="px-5 mt-5 pt-4">
        <div class="bg-white border shadow p-3 pt-5">
            <div class="d-flex justify-content-center" >
                <div class="d-flex justify-content-center bg-secondary rounded w-75 text-white py-3" id="sınıftab">
                    <h2>Dersler</h2>
                </div>
            </div>
            <div class=" mt-3">
                <div class="d-flex justify-content-between my-3">
                    <div>
                        <button class="btn btn-warning text-white warning-active-overlay" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Filtre</button>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Ders Filtreleme</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <form method="GET" action="{{ route('dersler') }}">
                                    <label for="isim" class="form-label">Ders İsmi</label>
                                    <div class="mb-3 px-1">
                                        <input type="text" class="form-control" name="isim" id="isim" value="{{ request('isim') }}">
                                    </div>

                                    <label for="hoca_id" class="form-label">Ders Hocasına Göre</label>
                                    <div class="mb-3 px-1">
                                        <select class="form-select" name="hoca_id" id="hoca_id">
                                            <option value="">Ders Hocasını Seçiniz</option>
                                            @foreach($akademisyenler as $akademisyen)
                                                <option value="{{ $akademisyen->id }}" {{ request('hoca_id') == $akademisyen->id ? 'selected' : '' }}>
                                                    {{ $akademisyen->unvan }} {{ $akademisyen->isim }} {{ $akademisyen->soyisim }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <label for="donem" class="form-label">Döneme Göre</label>
                                    <div class="mb-3 px-1">
                                        <select class="form-select" name="donem" id="donem">
                                            <option value="">Dönem Seçiniz</option>
                                            <option value="Güz" {{ request('donem') == 'Güz' ? 'selected' : '' }}>Güz</option>
                                            <option value="Bahar" {{ request('donem') == 'Bahar' ? 'selected' : '' }}>Bahar</option>
                                        </select>
                                    </div>

                                    <label for="sinif" class="form-label">Sınıfa Göre</label>
                                    <div class="mb-3 px-1">
                                        <select class="form-select" name="sinif" id="sinif">
                                            <option value="">Sınıf Seçiniz</option>
                                            @for($i = 1; $i <= 6; $i++)
                                                <option value="{{ $i }}" {{ request('sinif') == $i ? 'selected' : '' }}>{{ $i }}. Sınıf</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <label for="secmeli_durumu" class="form-label">Seçmeli / Zorunlu</label>
                                    <div class="mb-3 px-1">
                                        <select class="form-select" name="secmeli_durumu" id="secmeli_durumu">
                                            <option value="">Seçmeli / Zorunlu seçimi yapınız</option>
                                            <option value="1" {{ request('secmeli_durumu') == '1' ? 'selected' : '' }}>Seçmeli</option>
                                            <option value="0" {{ request('secmeli_durumu') == '0' ? 'selected' : '' }}>Zorunlu</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-warning text-white w-100">Filtrele</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success text-white success-active-overlay" data-bs-toggle="modal" data-bs-target="#dersEkleModal">Ders Ekle</button>
                        <!-- Ders Ekle Modal -->
                        <div class="modal fade" id="dersEkleModal" tabindex="-1" aria-labelledby="dersEkleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="dersEkleModalLabel">Ders Ekle</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" id="derseklemeform" action="{{ route('addDers') }}">
                                            @csrf

                                            <!-- Gizli alanları ekliyoruz -->
                                            <input type="hidden" name="ders_sinif" value="">

                                            <!-- Ders Adı -->
                                            <label for="createDersAdi" class="form-label">Ders Adı</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" name="ders_adi" id="createDersAdi" required>
                                            </div>

                                            <!-- Kısa İsim -->
                                            <label for="createKisaIsim" class="form-label">Kısa İsim</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" name="kisa_isim" id="createKisaIsim" required>
                                            </div>

                                            <!-- Dönem -->
                                            <label for="createDonem" class="form-label">Dönem</label>
                                            <div class="mb-3 px-1">
                                                <select class="form-select" name="donem" id="createDonem" required>
                                                    <option value="">Dönem Seçiniz</option>
                                                    <option value="Güz">Güz</option>
                                                    <option value="Bahar">Bahar</option>
                                                </select>
                                            </div>

                                            <!-- Ders Sayısı -->
                                            <label for="createDersSayisi" class="form-label">Ders Sayısı</label>
                                            <div class="mb-3 px-1">
                                                <select class="form-select" name="ders_sayisi" id="createDersSayisi" required>
                                                    <option value="">Ders Sayısı Seçiniz</option>
                                                    @for($i = 1; $i <= 10; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <!-- Ders Kaça Bölünsün -->
                                            <label for="createDersParcasi" class="form-label">Ders Kaça Bölünsün</label>
                                            <div class="mb-3 px-1">
                                                <select class="form-select" name="ders_parcasi" id="createDersParcasi" required>
                                                    <option value="">Kaça Bölünsün</option>
                                                    @for($i = 1; $i <= 9; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>



                                            <!-- Kaçıncı Sınıf Dersi -->
                                            <label for="createSinif" class="form-label">Kaçıncı Sınıf Dersi</label>
                                            <div class="mb-3 px-1">
                                                <select class="form-select" name="sinif" id="createSinif" required>
                                                    @for($i = 1; $i <= 9; $i++)
                                                        <option value="{{ $i }}">{{ $i }}. Sınıf</option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <!-- Alan Kişi Sayısı -->
                                            <label for="createAlanKisiSayisi" class="form-label">Alan Kişi Sayısı</label>
                                            <div class="mb-3 px-1">
                                                <input type="number" class="form-control" name="alan_kisi_sayisi" id="createAlanKisiSayisi" required>
                                            </div> 

                                            <!-- Dersin Hocası -->
                                            <label for="createHoca" class="form-label">Dersin Hocası</label>
                                            <div class="mb-3 px-1">
                                                <select class="form-select" name="hoca_id" id="createHoca" required>
                                                    <option value="">Ders Hocasını Seçiniz</option>
                                                    @foreach($akademisyenler as $akademisyen)
                                                        <option value="{{ $akademisyen->id }}">{{ $akademisyen->unvan }} {{ $akademisyen->isim }} {{ $akademisyen->soyisim }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Dinamik Salon Seçimi -->
                                            <div id="salon-container"></div>

                                            <!-- Renk Kodu -->
                                            <label for="createRenkKodu" class="form-label">Ders Rengi</label>
                                            <div class="mb-3 px-1">
                                                <input type="color" class="form-control form-control-color w-100" name="renk_kodu" id="createRenkKodu" value="#563d7c" required>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <!-- Seçmeli Durumu -->
                                                    <label for="secmeliDurumu" class="form-label">Seçmeli Durumu</label>
                                                    <div class="mb-4 px-1">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="secmeli_durumu" id="zorunlu" value="0" required checked>
                                                            <label class="form-check-label" for="zorunlu">Zorunlu</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="secmeli_durumu" id="secmeli" value="1" required>
                                                            <label class="form-check-label" for="secmeli">Seçmeli</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label for="uzaktanEgitim" class="form-label">Online Ders Mi</label>
                                                    <div class="mb-4 px-1">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="uzaktan_egitim" id="yuzyuze" value="0" required checked>
                                                            <label class="form-check-label" for="yuzyuze">Yüzyüze</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="uzaktan_egitim" id="online" value="1" required>
                                                            <label class="form-check-label" for="online">Online</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Ekle Butonu -->
                                            <button type="submit" class="btn btn-primary w-100">Ekle</button>
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
                            <th scope="col"><b>Ders İsmi</b></th>
                            <th scope="col"><b>Kısa İsim</b></th>
                            <th scope="col"><b>Dönem</b></th>
                            <th scope="col"><b>Ders Hocası</b></th>
                            <th scope="col"><b>Ders Sayısı</b></th>
                            <th scope="col"><b>Sınıf</b></th>
                            <th scope="col"><b>Zorunlu / Seçmeli</b></th>
                            <th scope="col"><b>Ders Rengi</b></th>
                            <th scope="col"><b>İşlemler</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dersler as $ders)
                            <tr>
                                <th scope="row">{{ ($dersler->currentPage() - 1) * $dersler->perPage() + $loop->iteration }}</th>
                                <td>{{ $ders->ders_adi }}</td>
                                <td>{{ $ders->kisa_isim }}</td>
                                <td>{{ $ders->donem }}</td>
                                <td>{{ $ders->hoca->unvan }} {{ $ders->hoca->isim }} {{ $ders->hoca->soyisim }}</td>
                                <td>{{ $ders->ders_sayisi }}</td>
                                <td>{{ $ders->sinif }}.Sınıf</td>
                                <td class="ps-5">{{ $ders->secmeli_durumu ? 'Seçmeli' : 'Zorunlu' }}</td>
                                <td><div class="ders-rengi" style="background-color: {{ $ders->renk_kodu }};"></div></td>
                                <td>
                                    <div class="d-flex justify-content-start text-white">
                                        <!-- Düzenle Butonu -->
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#dersGuncelleModal-{{ $ders->id }}">
                                            Düzenle
                                        </button>

                                        <!-- Sil Butonu -->
                                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $ders->id }}">
                                            Sil
                                        </button>
                                    </div>

                                    <!-- Ders Güncelleme Modalı -->
                                    <div class="modal fade" id="dersGuncelleModal-{{ $ders->id }}" tabindex="-1" aria-labelledby="dersGuncelleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="dersGuncelleModalLabel">Ders Güncelle</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" id="updateDersForm-{{ $ders->id }}" action="{{ route('updateDers', $ders->id) }}">
                                                        @csrf
                                                        @method('PUT')

                                                        <!-- Gizli Alan -->
                                                        <input type="hidden" name="ders_sinif" id="updateDersSinif-{{ $ders->id }}">


                                                        <!-- Ders Adı -->
                                                        <label for="ders_adi" class="form-label">Ders Adı</label>
                                                        <div class="mb-3 px-1">
                                                            <input type="text" class="form-control" name="ders_adi" id="ders_adi" value="{{ $ders->ders_adi }}" required>
                                                        </div>

                                                        <!-- Kısa İsim -->
                                                        <label for="kisa_isim" class="form-label">Kısa İsim</label>
                                                        <div class="mb-3 px-1">
                                                            <input type="text" class="form-control" name="kisa_isim" id="kisa_isim" value="{{ $ders->kisa_isim }}" required>
                                                        </div>

                                                        <!-- Dönem -->
                                                        <label for="donem" class="form-label">Dönem</label>
                                                        <div class="mb-3 px-1">
                                                            <select class="form-select" name="donem" id="donem" required>
                                                                <option value="Güz" {{ $ders->donem == 'Güz' ? 'selected' : '' }}>Güz</option>
                                                                <option value="Bahar" {{ $ders->donem == 'Bahar' ? 'selected' : '' }}>Bahar</option>
                                                            </select>
                                                        </div>

                                                       <!-- Ders Sayısı -->
                                                        <label for="updateDersSayisi-{{ $ders->id }}" class="form-label">Ders Sayısı</label>
                                                        <div class="mb-3 px-1">
                                                            <select class="form-select" name="ders_sayisi" id="updateDersSayisi-{{ $ders->id }}" required>
                                                                @for($i = 1; $i <= 10; $i++)
                                                                    <option value="{{ $i }}" {{ $ders->ders_sayisi == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>

                                                        <!-- Ders Kaça Bölünsün -->
                                                        <label for="updateDersParcasi-{{ $ders->id }}" class="form-label">Ders Kaça Bölünsün</label>
                                                        <div class="mb-3 px-1">
                                                            <select class="form-select" name="ders_parcasi" id="updateDersParcasi-{{ $ders->id }}" required>
                                                                @for($i = 1; $i <= 9; $i++)
                                                                    <option value="{{ $i }}" {{ $ders->ders_parcasi == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>

                                                        <!-- Kaçıncı Sınıf Dersi -->
                                                        <label for="updateSinif" class="form-label">Kaçıncı Sınıf Dersi</label>
                                                        <div class="mb-3 px-1">
                                                            <select class="form-select" name="sinif" id="updateSinif" required>
                                                                @for($i = 1; $i <= 9; $i++)
                                                                    <option value="{{ $i }}" {{ $ders->sinif == $i ? 'selected' : '' }}>{{ $i }}. Sınıf</option>
                                                                @endfor
                                                            </select>
                                                        </div>


                                                        <!-- Alan Kişi Sayısı -->
                                                        <label for="alan_kisi_sayisi" class="form-label">Alan Kişi Sayısı</label>
                                                        <div class="mb-3 px-1">
                                                            <input type="number" class="form-control" name="alan_kisi_sayisi" id="alan_kisi_sayisi" value="{{ $ders->alan_kisi_sayisi }}" required>
                                                        </div>

                                                        <!-- Dersin Hocası -->
                                                        <label for="hoca_id" class="form-label">Dersin Hocası</label>
                                                        <div class="mb-3 px-1">
                                                            <select class="form-select" name="hoca_id" id="hoca_id" required>
                                                                @foreach($akademisyenler as $hoca)
                                                                    <option value="{{ $hoca->id }}" {{ $ders->hoca_id == $hoca->id ? 'selected' : '' }}>
                                                                        {{ $hoca->unvan }} {{ $hoca->isim }} {{ $hoca->soyisim }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Dinamik Salon Seçimi -->
                                                        <div id="update-salon-container-{{ $ders->id }}">
                                                            @php
                                                                $dersSinifList = json_decode($ders->ders_sinif, true);
                                                                $sinifIdList = json_decode($ders->sinif_id, true);
                                                            @endphp
                                                            @if($dersSinifList && $sinifIdList && is_array($dersSinifList) && is_array($sinifIdList))
                                                                @foreach($dersSinifList as $index => $dersSinif)
                                                                    <label for="salon_id_{{ $index }}" class="form-label">
                                                                        {{ $dersSinif }} saatlik ders için Salon Seçimi
                                                                    </label>
                                                                    <div class="mb-3 px-1">
                                                                        <select class="form-select" name="salon_id[]" id="salon_id_{{ $index }}">
                                                                            <option value="" {{ is_null($sinifIdList[$index]) ? 'selected' : '' }}>Salon Seçmeyin (Boş)</option>
                                                                            @foreach($salonlar as $salon)
                                                                                <option value="{{ $salon->id }}" {{ $sinifIdList[$index] == $salon->id ? 'selected' : '' }}>
                                                                                    {{ $salon->isim }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <!-- Eğer sinif_id ve ders_sinif yoksa, boş bir seçenek göster -->
                                                                <label class="form-label">Dersin 1. Parçası için Salon</label>
                                                                <div class="mb-3 px-1">
                                                                    <select class="form-select" name="salon_id[]">
                                                                        <option value="">Salon Seçmeyin (Boş)</option>
                                                                        @foreach($salonlar as $salon)
                                                                            <option value="{{ $salon->id }}">{{ $salon->isim }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <!-- Ders Rengi -->
                                                        <label for="renk_kodu" class="form-label">Ders Rengi</label>
                                                        <div class="mb-3 px-1">
                                                            <input type="color" class="form-control form-control-color w-100" name="renk_kodu" id="renk_kodu" value="{{ $ders->renk_kodu }}" required>
                                                        </div>

                                                        <!-- Seçmeli Durumu ve Uzaktan Eğitim -->
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <label for="secmeliDurumu" class="form-label">Seçmeli Durumu</label>
                                                                <div class="mb-4 px-1">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="secmeli_durumu" id="zorunlu-{{ $ders->id }}" value="0" {{ $ders->secmeli_durumu == 0 ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="zorunlu-{{ $ders->id }}">Zorunlu</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="secmeli_durumu" id="secmeli-{{ $ders->id }}" value="1" {{ $ders->secmeli_durumu == 1 ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="secmeli-{{ $ders->id }}">Seçmeli</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label for="uzaktanEgitim" class="form-label">Online Ders Mi</label>
                                                                <div class="mb-4 px-1">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="uzaktan_egitim" id="yuzyuze-{{ $ders->id }}" value="0" {{ $ders->uzaktan_egitim == 0 ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="yuzyuze-{{ $ders->id }}">Yüzyüze</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="uzaktan_egitim" id="online-{{ $ders->id }}" value="1" {{ $ders->uzaktan_egitim == 1 ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="online-{{ $ders->id }}">Online</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Güncelleme Butonu -->
                                                        <button type="submit" class="btn btn-primary w-100 mt-3">Güncelle</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sil Modalı -->
                                    <div class="modal fade text-dark" id="deleteModal-{{ $ders->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Ders Sil</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('deleteDers', $ders->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="alert alert-warning">
                                                            <b>{{ $ders->ders_adi }}</b> isimli dersi silmek istediğinize emin misiniz?
                                                        </div>
                                                        <button type="submit" class="btn btn-danger text-white">Sil</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Kayıtlı ders bulunmamaktadır.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <nav class="d-flex justify-content-center">
                    {{ $dersler->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
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

    <!-- Create işlemi için salon seçimlerini dinamik olarak oluşturduk -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const salonlar = @json($salonlar);

            // Dinamik salon seçimleri oluşturma
            document.getElementById('createDersParcasi').addEventListener('change', function () {
                const dersParcasi = parseInt(this.value);
                const dersSayisi = parseInt(document.getElementById('createDersSayisi').value);
                const salonContainer = document.getElementById('salon-container');
                salonContainer.innerHTML = '';

                if (dersParcasi > 0 && dersSayisi > 0) {
                    const parcalar = Array(dersParcasi).fill(Math.floor(dersSayisi / dersParcasi));
                    for (let i = 0; i < dersSayisi % dersParcasi; i++) {
                        parcalar[i] += 1;
                    }

                    parcalar.forEach((parca, index) => {
                        const div = document.createElement('div');
                        div.classList.add('mb-3', 'px-1');

                        const label = document.createElement('label');
                        label.classList.add('form-label');
                        label.textContent = `${parca} saatlik Dersin ${index + 1}. Parçası için Salon Seçimi`;

                        const select = document.createElement('select');
                        select.classList.add('form-select');
                        select.name = `salon_id[]`;

                        const defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.textContent = 'Salon Seçiniz';
                        select.appendChild(defaultOption);

                        salonlar.forEach(salon => {
                            const option = document.createElement('option');
                            option.value = salon.id.toString();
                            option.textContent = salon.isim;
                            select.appendChild(option);
                        });

                        div.appendChild(label);
                        div.appendChild(select);
                        salonContainer.appendChild(div);
                    });
                }
            });

            // Form gönderimi sırasında ders_sinif ve sinif_id verilerini gizli inputlara ekleme
            const form = document.getElementById('derseklemeform');
            form.addEventListener('submit', function (event) {
                const salonSelects = document.querySelectorAll('select[name="salon_id[]"]');
                const sinifIdList = [];
                const dersSinifList = [];

                const dersParcasi = parseInt(document.getElementById('createDersParcasi').value);
                const dersSayisi = parseInt(document.getElementById('createDersSayisi').value);

                const parcalar = Array(dersParcasi).fill(Math.floor(dersSayisi / dersParcasi));
                for (let i = 0; i < dersSayisi % dersParcasi; i++) {
                    parcalar[i] += 1;
                }

                salonSelects.forEach((select, index) => {
                    if (select.value) {
                        sinifIdList.push(select.value);
                        dersSinifList.push(parcalar[index].toString());
                    }
                });

                // Gizli inputları formda ayarlıyoruz
                let dersSinifInput = document.querySelector('input[name="ders_sinif"]');
                if (!dersSinifInput) {
                    dersSinifInput = document.createElement('input');
                    dersSinifInput.type = 'hidden';
                    dersSinifInput.name = 'ders_sinif';
                    form.appendChild(dersSinifInput);
                }
                dersSinifInput.value = JSON.stringify(dersSinifList);

                // Konsola yazdırma (kontrol amaçlı)
                console.log('Gönderilecek ders_sinif:', dersSinifInput.value);
            });
        });
    </script>








    <!-- Güncelleme işlemi için salon seçimlerini dinamik olarak oluşturduk -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Dinamik salon seçimleri için event listener ekliyoruz
            document.querySelectorAll('[id^="updateDersParcasi"]').forEach(function (selectElement) {
                selectElement.addEventListener('change', function () {
                    const dersParcasi = parseInt(this.value);
                    const dersAdi = this.id.replace('updateDersParcasi-', '');
                    const salonContainerId = `update-salon-container-${dersAdi}`;
                    const salonContainer = document.getElementById(salonContainerId);
                    salonContainer.innerHTML = '';

                    const dersSayisi = parseInt(document.getElementById(`updateDersSayisi-${dersAdi}`).value);
                    const parcalar = Array(dersParcasi).fill(Math.floor(dersSayisi / dersParcasi));
                    for (let i = 0; i < dersSayisi % dersParcasi; i++) {
                        parcalar[i] += 1;
                    }

                    const salonlar = @json($salonlar);

                    parcalar.forEach((parca, index) => {
                        const div = document.createElement('div');
                        div.classList.add('mb-3', 'px-1');

                        const label = document.createElement('label');
                        label.classList.add('form-label');
                        label.textContent = `${parca} saatlik Dersin ${index + 1}. Parçası için Salon Seçimi`;

                        const select = document.createElement('select');
                        select.classList.add('form-select');
                        select.name = 'salon_id[]';

                        const defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.textContent = 'Salon Seçiniz';
                        select.appendChild(defaultOption);

                        salonlar.forEach(salon => {
                            const option = document.createElement('option');
                            option.value = salon.id.toString();
                            option.textContent = salon.isim;
                            select.appendChild(option);
                        });

                        div.appendChild(label);
                        div.appendChild(select);
                        salonContainer.appendChild(div);
                    });
                });
            });

            // Form submit edilirken ders_sinif değerini güncelle
            document.querySelectorAll('[id^="updateDersForm"]').forEach(form => {
                form.addEventListener('submit', function (event) {
                    const dersParcasi = parseInt(document.getElementById(`updateDersParcasi-${form.id.split('-')[1]}`).value);
                    const dersSayisi = parseInt(document.getElementById(`updateDersSayisi-${form.id.split('-')[1]}`).value);

                    const parcalar = Array(dersParcasi).fill(Math.floor(dersSayisi / dersParcasi));
                    for (let i = 0; i < dersSayisi % dersParcasi; i++) {
                        parcalar[i] += 1;
                    }

                    const dersSinifInput = document.getElementById(`updateDersSinif-${form.id.split('-')[1]}`);
                    dersSinifInput.value = JSON.stringify(parcalar);
                });
            });
        });
    </script>





@endsection
