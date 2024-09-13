@extends('layout')

@section('title', 'Üniversiteler')

@section('content')
    <div class="px-5 mt-5 pt-4">
        <div class="bg-white border shadow p-3 pt-5">
            <div class="d-flex justify-content-center" >
                <div class="d-flex justify-content-center bg-secondary rounded w-75 text-white py-3" id="sınıftab">
                    <h2>Üniversiteler</h2>
                </div>
            </div>
            <div class=" mt-3">
                <div class="d-flex justify-content-between my-3">
                    <div>
                        <button class="btn btn-warning text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Filtre</button>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Üniversite Filtreleme</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                            <form action="{{ route('admin.university') }}" method="GET">
                                <label for="unisim" class="form-label">Üniversite İsmine Göre</label>
                                <div class="mb-3 px-1">
                                    <select class="form-select" name="order" aria-label="Default select example">
                                        <option value="" selected>Üniversite İsmine Göre Sırala</option>
                                        <option value="asc">A'dan Z'ye</option>
                                        <option value="desc">Z'den A'ya</option>
                                    </select>
                                </div>
                                <label for="uniadi" class="form-label">Üniversite Adı</label>
                                <div class="mb-3 px-1">
                                    <input type="text" class="form-control" name="search" id="uniadi" list="universiteler" placeholder="İsteğe Bağlı">
                                </div>
                                <button type="submit" class="btn btn-warning text-white w-100">Filtrele</button>
                            </form>

                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#sınıfEkleModal">Üniversite Ekle</button>
                        <!-- Universite ekleme modal -->
                        <div class="modal fade" id="sınıfEkleModal" tabindex="-1" aria-labelledby="sınıfEkleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="sınıfEkleModalLabel">Üniversite Ekle</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.addUniversity') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <label for="createsınıfAdı" class="form-label">Universite Adı</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" name="universite_adi" list="universiteler" id="createsınıfAdı" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="profileImageInput" class="form-label">Logo Yükleyin</label>
                                                <input class="form-control" type="file" name="universite_logo" id="profileImageInput" accept="image/*" required>
                                            </div>
                                            <div class="d-flex flex-column align-items-center">
                                                <img id="uploadedImagePreview" src="" alt="Yüklenen Fotoğraf" class="img-fluid rounded-circle mb-4" style="width: 150px; height: 150px; object-fit: cover; display: none;">
                                                <span id="fileName" class="text-muted"></span>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Ekle</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><b>#</b></th>
                            <th scope="col"><b>Logo</b></th>
                            <th scope="col"><b>Üniversite</b></th>
                            <th scope="col"><b>Resim Yolu</b></th>
                            <th scope="col"><b>İşlemler</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($universiteler as $index => $universite)
                        <tr>
                            <th scope="row">{{ $universiteler->firstItem() + $index }}</th>
                            <td>
                                <img src="{{ asset($universite->img_yolu) }}" alt="{{ $universite->isim }} Logosu" class="img-fluid" style="width: 50px; height: 50px;">
                            </td>
                            <td>{{ $universite->isim }}</td>
                            <td>{{ $universite->img_yolu }}</td>
                            <td>
                                <div class="d-flex justify-content-start text-white">
                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#update{{ $universite->id }}">
                                        Düzenle
                                    </button>
                                    <!-- Universite Güncelle Modal -->
                                    <div class="modal fade text-dark" id="update{{ $universite->id }}" tabindex="-1" aria-labelledby="updateModalLabel{{ $universite->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel{{ $universite->id }}">Üniversite Güncelle</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.updateUniversity', $universite->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <label for="updatesınıfAdı" class="form-label">Üniversite Adı</label>
                                                        <div class="mb-3 px-1">
                                                            <input type="text" class="form-control" name="universite_adi" id="updatesınıfAdı" list="universiteler" value="{{ $universite->isim }}" required>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="profileImageInput{{ $universite->id }}" class="form-label">Logo Yükleyin</label>
                                                            <input class="form-control" type="file" name="universite_logo" id="profileImageInput{{ $universite->id }}" accept="image/*">
                                                        </div>
                                                        <div class="d-flex flex-column align-items-center">
                                                        <img id="uploadedImagePreview{{ $universite->id }}" src="{{ asset($universite->img_yolu) }}" alt="Yüklenen Fotoğraf" class="img-fluid rounded-circle mb-4" style="width: 150px; height: 150px; object-fit: cover; display: none;">

                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Güncelle</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $universite->id }}">
                                        Sil
                                    </button>
                                    <!-- Universite Sil Modal -->
                                    <div class="modal fade text-dark" id="deleteModal{{ $universite->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $universite->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $universite->id }}">Üniversite Sil</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.deleteUniversity', $universite->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <label for="deletesınıfAdı" class="form-label">Üniversite Adı</label>
                                                        <div class="mb-3 px-1">
                                                            <input type="text" class="form-control" id="deletesınıfAdı" value="{{ $universite->isim }}" disabled>
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
                        @if($universiteler->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">Üniversite Bulunamadı</td>
                        </tr>
                        @endif
                        
                    </tbody>


                </table>

                <nav class="d-flex justify-content-center">
                    {{ $universiteler->links('vendor.pagination.bootstrap-5') }}
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
        <option value="Abant İzzet Baysal Üniversitesi">
        <option value="Abdullah Gül Üniversitesi">
        <option value="Acıbadem Mehmet Ali Aydınlar Üniversitesi">
        <option value="Adana Alparslan Türkeş Bilim ve Teknoloji Üniversitesi">
        <option value="Adıyaman Üniversitesi">
        <option value="Afyon Kocatepe Üniversitesi">
        <option value="Ağrı İbrahim Çeçen Üniversitesi">
        <option value="Ahi Evran Üniversitesi">
        <option value="Akdeniz Üniversitesi">
        <option value="Aksaray Üniversitesi">
        <option value="Alanya Alaaddin Keykubat Üniversitesi">
        <option value="Amasya Üniversitesi">
        <option value="Anadolu Üniversitesi">
        <option value="Ankara Hacı Bayram Veli Üniversitesi">
        <option value="Ankara Üniversitesi">
        <option value="Antalya Bilim Üniversitesi">
        <option value="Ardahan Üniversitesi">
        <option value="Artvin Çoruh Üniversitesi">
        <option value="Atatürk Üniversitesi">
        <option value="Atılım Üniversitesi">
        <option value="Avrasya Üniversitesi">
        <option value="Bahçeşehir Üniversitesi">
        <option value="Balıkesir Üniversitesi">
        <option value="Bandırma Onyedi Eylül Üniversitesi">
        <option value="Bartın Üniversitesi">
        <option value="Başkent Üniversitesi">
        <option value="Batman Üniversitesi">
        <option value="Bayburt Üniversitesi">
        <option value="Beykent Üniversitesi">
        <option value="Bezmialem Vakıf Üniversitesi">
        <option value="Bilecik Şeyh Edebali Üniversitesi">
        <option value="Bingöl Üniversitesi">
        <option value="Biruni Üniversitesi">
        <option value="Bitlis Eren Üniversitesi">
        <option value="Boğaziçi Üniversitesi">
        <option value="Bolu Abant İzzet Baysal Üniversitesi">
        <option value="Bursa Teknik Üniversitesi">
        <option value="Bursa Uludağ Üniversitesi">
        <option value="Çağ Üniversitesi">
        <option value="Çanakkale Onsekiz Mart Üniversitesi">
        <option value="Çankaya Üniversitesi">
        <option value="Çankırı Karatekin Üniversitesi">
        <option value="Çukurova Üniversitesi">
        <option value="Deniz Harp Okulu">
        <option value="Dicle Üniversitesi">
        <option value="Doğuş Üniversitesi">
        <option value="Dokuz Eylül Üniversitesi">
        <option value="Dumlupınar Üniversitesi">
        <option value="Düzce Üniversitesi">
        <option value="Ege Üniversitesi">
        <option value="Erciyes Üniversitesi">
        <option value="Erzincan Binali Yıldırım Üniversitesi">
        <option value="Erzurum Teknik Üniversitesi">
        <option value="Eskişehir Osmangazi Üniversitesi">
        <option value="Fatih Sultan Mehmet Vakıf Üniversitesi">
        <option value="Fırat Üniversitesi">
        <option value="Galatasaray Üniversitesi">
        <option value="Gazi Üniversitesi">
        <option value="Gaziantep Üniversitesi">
        <option value="Gaziosmanpaşa Üniversitesi">
        <option value="Gebze Teknik Üniversitesi">
        <option value="Giresun Üniversitesi">
        <option value="Hacettepe Üniversitesi">
        <option value="Hakkari Üniversitesi">
        <option value="Haliç Üniversitesi">
        <option value="Harran Üniversitesi">
        <option value="Hasan Kalyoncu Üniversitesi">
        <option value="Hatay Mustafa Kemal Üniversitesi">
        <option value="Hitit Üniversitesi">
        <option value="Iğdır Üniversitesi">
        <option value="İbn Haldun Üniversitesi">
        <option value="İhsan Doğramacı Bilkent Üniversitesi">
        <option value="İnönü Üniversitesi">
        <option value="İskenderun Teknik Üniversitesi">
        <option value="İstanbul Bilgi Üniversitesi">
        <option value="İstanbul Gelişim Üniversitesi">
        <option value="İstanbul Medeniyet Üniversitesi">
        <option value="İstanbul Medipol Üniversitesi">
        <option value="İstanbul Sabahattin Zaim Üniversitesi">
        <option value="İstanbul Teknik Üniversitesi">
        <option value="İstanbul Üniversitesi">
        <option value="İstanbul 29 Mayıs Üniversitesi">
        <option value="İstanbul Arel Üniversitesi">
        <option value="İstanbul Aydın Üniversitesi">
        <option value="İstanbul Beykent Üniversitesi">
        <option value="İstanbul Bilim Üniversitesi">
        <option value="İstanbul Esenyurt Üniversitesi">
        <option value="İstanbul Gelişim Üniversitesi">
        <option value="İstanbul Kavram Meslek Yüksekokulu">
        <option value="İstanbul Kent Üniversitesi">
        <option value="İstanbul Kültür Üniversitesi">
        <option value="İstanbul Medeniyet Üniversitesi">
        <option value="İstanbul Okan Üniversitesi">
        <option value="İstanbul Rumeli Üniversitesi">
        <option value="İstanbul Şehir Üniversitesi">
        <option value="İstanbul Şişli Meslek Yüksekokulu">
        <option value="İstanbul Ticaret Üniversitesi">
        <option value="İstanbul Yeni Yüzyıl Üniversitesi">
        <option value="İstinye Üniversitesi">
        <option value="İzmir Bakırçay Üniversitesi">
        <option value="İzmir Demokrasi Üniversitesi">
        <option value="İzmir Ekonomi Üniversitesi">
        <option value="İzmir Kâtip Çelebi Üniversitesi">
        <option value="İzmir Yüksek Teknoloji Enstitüsü">
        <option value="Kadir Has Üniversitesi">
        <option value="Kafkas Üniversitesi">
        <option value="Kahramanmaraş İstiklal Üniversitesi">
        <option value="Kahramanmaraş Sütçü İmam Üniversitesi">
        <option value="Kapadokya Üniversitesi">
        <option value="Karabük Üniversitesi">
        <option value="Karadeniz Teknik Üniversitesi">
        <option value="Karamanoğlu Mehmetbey Üniversitesi">
        <option value="Kastamonu Üniversitesi">
        <option value="Kırıkkale Üniversitesi">
        <option value="Kırklareli Üniversitesi">
        <option value="Kilis 7 Aralık Üniversitesi">
        <option value="Kocaeli Üniversitesi">
        <option value="Koç Üniversitesi">
        <option value="Konya Teknik Üniversitesi">
        <option value="Malatya Turgut Özal Üniversitesi">
        <option value="Mardin Artuklu Üniversitesi">
        <option value="Marmara Üniversitesi">
        <option value="Mersin Üniversitesi">
        <option value="Mevlana Üniversitesi">
        <option value="Muğla Sıtkı Koçman Üniversitesi">
        <option value="Munzur Üniversitesi">
        <option value="Mustafa Kemal Üniversitesi">
        <option value="Muş Alparslan Üniversitesi">
        <option value="Necmettin Erbakan Üniversitesi">
        <option value="Nevşehir Hacı Bektaş Veli Üniversitesi">
        <option value="Niğde Ömer Halisdemir Üniversitesi">
        <option value="Nişantaşı Üniversitesi">
        <option value="Nuh Naci Yazgan Üniversitesi">
        <option value="Ondokuz Mayıs Üniversitesi">
        <option value="Ordu Üniversitesi">
        <option value="Orta Doğu Teknik Üniversitesi">
        <option value="Osmaniye Korkut Ata Üniversitesi">
        <option value="Özyeğin Üniversitesi">
        <option value="Pamukkale Üniversitesi">
        <option value="Piri Reis Üniversitesi">
        <option value="Sabancı Üniversitesi">
        <option value="Sakarya Üniversitesi">
        <option value="Sanko Üniversitesi">
        <option value="Selçuk Üniversitesi">
        <option value="Siirt Üniversitesi">
        <option value="Sinop Üniversitesi">
        <option value="Süleyman Demirel Üniversitesi">
        <option value="Şırnak Üniversitesi">
        <option value="TED Üniversitesi">
        <option value="Tokat Gaziosmanpaşa Üniversitesi">
        <option value="Toros Üniversitesi">
        <option value="Trakya Üniversitesi">
        <option value="Tunceli Munzur Üniversitesi">
        <option value="Türk-Alman Üniversitesi">
        <option value="Ufuk Üniversitesi">
        <option value="Uşak Üniversitesi">
        <option value="Üsküdar Üniversitesi">
        <option value="Yalova Üniversitesi">
        <option value="Yaşar Üniversitesi">
        <option value="Yeditepe Üniversitesi">
        <option value="Yıldız Teknik Üniversitesi">
        <option value="Yozgat Bozok Üniversitesi">
        <option value="Zonguldak Bülent Ecevit Üniversitesi">
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
    </script>
    <script>
        document.getElementById('profileImageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const fileNameElement = document.getElementById('fileName');
            const imagePreviewElement = document.getElementById('uploadedImagePreview');
            
            if (file) {
                // Dosya adını göster
                fileNameElement.textContent = file.name;

                // Fotoğraf önizlemesini göster
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreviewElement.src = e.target.result;
                    imagePreviewElement.style.display = 'block'; // Fotoğrafı görünür yap
                }
                reader.readAsDataURL(file);
            } else {
                fileNameElement.textContent = '';
                imagePreviewElement.style.display = 'none'; // Fotoğrafı gizle
            }
        });
    </script>
    <script>
        document.querySelectorAll('[id^="profileImageInput"]').forEach(function(inputElement) {
            inputElement.addEventListener('change', function(e) {
                const file = e.target.files[0];
                const modalId = e.target.id.replace('profileImageInput', ''); // ID'den üniversite ID'sini ayır
                const imagePreviewElement = document.getElementById('uploadedImagePreview' + modalId); // Benzersiz ID'yi kullan

                if (file) {
                    // Fotoğraf önizlemesini göster
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        console.log("Dosya yüklendi:", e.target.result); // Log ile kontrol et
                        imagePreviewElement.src = e.target.result;
                        imagePreviewElement.style.display = 'block'; // Fotoğrafı görünür yap
                    }
                    reader.readAsDataURL(file);
                } else {
                    imagePreviewElement.style.display = 'none'; // Fotoğrafı gizle
                }
            });
        });
    </script>


@endsection
