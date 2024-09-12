@extends('layout')

@section('title', 'Sınıflar')

@section('content')
    <div class="d-flex pe-5">
        <div class="col-4">
            <div class="px-5 mt-5 pt-4 ">
                <div class="bg-white border p-3 pt-5 primary-active-overlay">
                    <div class="d-flex justify-content-center" >
                        <div class="d-flex justify-content-center w-75 py-3" id="sınıftab">
                            <!-- yuvarlak img resmi yap -->
                            <img src="{{ asset('images/profil.jpg') }}" alt="Profil Fotoğrafı" class=" btn rounded-circle border shadow p-0" data-bs-toggle="modal" data-bs-target="#profilefoto" width="200" height="200" id="profileimg">
                        </div>
                    </div>
                    <div class="text-center card bg-primary text-white">
                        <h5 class="card-title mt-3">Öğrenci</h5>
                        <h4 class="card-title">Bilal Çağrı Alğan</h4>
                        <p class="card-text mt-3"></p>
                    </div>
                </div>
                <div class="card mb-3 mt-4 p-3 secondary-active-overlay">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('images/hitit-logo.png') }}" class="img-fluid rounded-start" alt="Profile Image">
                        </div>
                        <div class="col-md-8 d-flex align-items-center border-start ">
                            <div class="card-body">
                                <h6 class="card-title text-center"><b>Hitit Üniversitesi</b></h6>
                                <p class="card-text text-center"><b>Bilgisayar Mühendisliği</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-8 mt-4">
            <div class="card mt-5 p-3 success-active-overlay w-100">
                <h3 class="card-title my-4 text-center text-success"><b>Profil Bilgileri</b></h3>
                <form>
                    <div class="d-flex pe-3 mb-2">
                        <div class="mb-3 me-3 d-flex ps-3 col-6 d-flex align-items-center">
                            <i class="bi bi-person me-3"></i>
                            <input type="type" class="form-control" id="exampleInputPassword1" placeholder="İsim" value="Bilal Çağrı">
                        </div>
                        <div class="mb-3 d-flex ps-3 col-6">
                            <i class="bi bi-person me-3"></i>
                            <input type="type" class="form-control" id="exampleInputPassword1" placeholder="Soyisim" Value="ALĞAN">
                        </div>
                    </div>
                    <div class="d-flex pe-3 mb-2">
                        <div class="mb-3 me-3 d-flex ps-3 col-6 d-flex align-items-center">
                            <i class="bi bi-envelope-at me-3"></i>
                            <input type="type" class="form-control" id="exampleInputPassword1" placeholder="E-posta" Value="bilalcagrialgan@gmail.com">
                        </div>
                        <div class="mb-3 d-flex ps-3 col-6">
                        <i class="bi bi-phone me-3"></i>
                            <input type="type" class="form-control" id="exampleInputPassword1" placeholder="Telefon" Value="0545 873 3317">
                        </div>
                    </div>
                    <div class="d-flex pe-3 mb-2">
                        <div class="mb-3 me-3 d-flex ps-3 col-6 d-flex align-items-center">
                            <i class="bi bi-lock me-3"></i>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Şifre">
                        </div>
                        <div class="mb-3 d-flex ps-3 col-6">
                            <i class="bi bi-lock me-3"></i>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Şifre Tekrar">
                        </div>
                    </div>
                    <div class="d-flex pe-3 mb-2">
                        <div class="mb-3 me-3 d-flex ps-3 col-6 d-flex align-items-center">
                            <i class="bi bi-houses me-3"></i>
                            <input type="type" class="form-control" list="datalistOptions" id="exampleInputPassword1" placeholder="Üniversite" Value="Hitit Üniversitesi">
                        </div>
                        <div class="mb-3 d-flex ps-3 col-6">
                            <i class="bi bi-backpack me-3"></i>
                            <input type="type" class="form-control" id="exampleInputPassword1" placeholder="Telefon" Value="Bilgisayar Mühendisliği">
                        </div>
                    </div>
                    <div class="d-flex pe-3 mb-2">
                        <div class="mb-3 d-flex ps-3 col-12 d-flex align-items-center">
                            <i class="bi bi-person-workspace me-3"></i>
                            <select class="form-select" aria-label="Default select example">
                                <option value="1" selected>Öğrenci</option>
                                <option value="2">Arş. Gör.</option>
                                <option value="3">Dr. Öğr.</option>
                                <option value="3">Doç. Dr.</option>
                                <option value="3">Prof. Dr.</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100 text-white">Kaydet</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Profil FotoğrafıModal -->
    <div class="modal fade" id="profilefoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Profil Fotoğrafını Yükle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="imageUploadForm">
                        <div class="mb-4">
                            <label for="profileImageInput" class="form-label">Yeni Fotoğraf Yükleyin</label>
                            <input class="form-control" type="file" id="profileImageInput" accept="image/*">
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <img id="uploadedImagePreview" src="" alt="Yüklenen Fotoğraf" class="img-fluid rounded-circle mb-4" style="width: 150px; height: 150px; object-fit: cover; display: none;">
                            <span id="fileName" class="text-muted"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary">Değişiklikleri Kaydet</button>
                </div>
            </div>
        </div>
    </div>

    <datalist id="datalistOptions">
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

    <style>
        #profileimg {
            margin-top: -120px; /* Yukarıya çekmek için negatif margin */
            box-shadow: 0 4px 15px rgba(0, 172, 193, 0.5);
            object-fit: cover;
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }

        #profileimg:hover {
            opacity: 0.7;
            transform: scale(0.95); /* Hover sırasında zoom efekti */
            object-position: center; /* Hover sırasında fotoğrafı merkezde tut */
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
            border: 1px solid  #4caf50;
            border-radius: 10px;
            border-left: 7px solid #4caf50;
        }

        .form-control {
            font-size: 1.3rem;
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
            font-size: 1.3rem;
            border: none;
            outline: none;
            box-shadow: none;
            letter-spacing: 0.1rem;
        }

        .form-select:focus {
            outline: none;
            box-shadow: none;
        }
    </style>

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
@endsection
