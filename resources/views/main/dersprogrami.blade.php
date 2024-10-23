@extends('layout')

@section('title', 'Ders Programı')

@section('content')


    <div class="px-5 my-5 pt-4">
        <div class="bg-white border shadow p-3 pt-5">
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center bg-dark rounded w-75 text-white py-3" id="sınıftab">
                    <h2>Ders Programı Oluştur</h2>
                </div>
            </div>

            <div class="mt-3">
                <div id="response-message" class="alert d-none text-center"></div>

                <form id="dersProgramiForm">
                    <div class="mt-3">
                        <div class="d-flex pe-3 my-4">
                            <!-- Sınıflar Çakışmasın -->
                            <div class="col-4  d-flex align-items-center justify-content-center">
                                <div class="mb-2">
                                    <label for="sinifcakismasi" class="form-label">
                                        <b>
                                            Sınıflar Çakışmasın
                                            <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Bir ders saatine aynı sınıfın dersini koymaz. (1.sınıf,2.sınıf..)"></i>
                                        </b>
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sinifcakismasi" id="sinifcakismasievet" value="1" {{ isset($dersProgramiSartlari) && $dersProgramiSartlari->sinif_cakismamasi == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sinifcakismasievet">Evet</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sinifcakismasi" id="sinifcakismasihayir" value="0" {{ isset($dersProgramiSartlari) && $dersProgramiSartlari->sinif_cakismamasi == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sinifcakismasihayir">Hayır</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Akademisyenler Çakışmasın -->
                            <div class="col-4  d-flex align-items-center justify-content-center">
                                <div class="mb-2">
                                    <label for="akademisyencakismasi" class="form-label">
                                        <b>
                                            Akademisyenler Çakışmasın
                                            <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Bir ders saatine iki akademisyen yerleştirmez."></i>
                                        </b>
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="akademisyencakismasi" id="akademisyencakismasievet" value="1" {{ isset($dersProgramiSartlari) && $dersProgramiSartlari->akademisyen_cakismamasi == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="akademisyencakismasievet">Evet</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="akademisyencakismasi" id="akademisyencakismasihayir" value="0" {{ isset($dersProgramiSartlari) && $dersProgramiSartlari->akademisyen_cakismamasi == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="akademisyencakismasihayir">Hayır</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Salonlar Çakışmasın -->
                            <div class="col-4  d-flex align-items-center justify-content-center">
                                <div class="mb-2">
                                    <label for="salonlarcakismasi" class="form-label">
                                        <b>
                                            Salonlar Çakışmasın 
                                            <i class="bi bi-info-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="2 dersi bir salona yerleştirmez."></i>
                                        </b>
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="salonlarcakismasi" id="salonlarcakismasievet" value="1" {{ isset($dersProgramiSartlari) && $dersProgramiSartlari->salon_cakismamasi == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="salonlarcakismasievet">Evet</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="salonlarcakismasi" id="salonlarcakismasihayir" value="0" {{ isset($dersProgramiSartlari) && $dersProgramiSartlari->salon_cakismamasi == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="salonlarcakismasihayir">Hayır</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Şart Sayısı -->
                        <div class="card">
                            <div class="card-header text-center">
                                <h4 class="m-0 p-0 d-flex align-items-center justify-content-center">
                                    <b>Ders Yerleştir</b>
                                    <div class="mb-3 mt-3 ms-3 px-1" style="width:10vh;">
                                        <input type="number" class="form-control" id="sartsayisi" name="sart_sayisi" min="1" max="30" value="{{ isset($dersProgramiSartlari) ? $dersProgramiSartlari->sart_sayisi : 1 }}" placeholder="Şart Sayısı Girin">
                                    </div>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-primary text-center" role="alert">
                                    Lütfen şartlar bölümünden kaç ders yerleştireceğinizi belirleyiniz.
                                </div>
                                <!-- Dinamik olarak eklenecek şartların görüneceği yer -->
                                <div id="conditions-container" class="mt-3"></div>
                            </div>
                        </div>

                        <!-- Submit Butonu -->
                        <button type="button" class="btn btn-primary w-100 mt-3" id="submit-button">Kaydet</button>
                    </div>
                </form>
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
            font-size: 1.2rem;
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
            font-size: 1.2rem;
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
            font-size:  1.1rem;
            border: none;
            outline: none;
            box-shadow: none;
            letter-spacing: 0.1rem;
        }

        .form-select:focus {
            outline: none;
            box-shadow: none;
        }

        /* Checkbox*/
        .custom-checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .custom-checkbox {
            position: relative;
            margin-right: 15px;
        }

        .custom-checkbox input[type="checkbox"] {
            opacity: 0;
            position: absolute;
            z-index: -1;
        }

        .custom-checkbox label {
            position: relative;
            display: inline-flex;
            align-items: center;
            padding-left: 35px;
            font-size: 15px;
            cursor: pointer;
            color: #333;
            user-select: none;
            transition: all 0.3s ease;
        }

        .custom-checkbox label::before {
            content: '';
            position: absolute;
            left: 0;
            width: 20px;
            height: 20px;
            border: 2px solid #aaa;
            border-radius: 4px;
            background-color: transparent;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .custom-checkbox input[type="checkbox"]:checked + label::before {
            background-color: #6c63ff;
            border-color: #6c63ff;
        }

        .custom-checkbox label::after {
            content: '✓';
            position: absolute;
            top: -1px;
            left: 4px;
            font-size: 18px;
            color: #fff;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .custom-checkbox input[type="checkbox"]:checked + label::after {
            opacity: 1;
        }

        .custom-checkbox label:hover::before {
            border-color: #6c63ff;
        }

    </style>

    
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        // Mevcut kayıtlardan ders_sartlari varsa onları alalım
        const existingDersSartlari = {!! json_encode($dersProgramiSartlari->ders_sartlari ?? null) !!};
    </script>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>

    <script>
        // Ders programı ve günler verilerini PHP'den alıp JavaScript değişkenlerine atıyoruz
        const dersProgrami = @json($dersProgrami);
        const gunler = @json($gunler);
        const maxDersSaati = {{ $ayarlar->gunluk_ders_saati }};

        document.addEventListener('DOMContentLoaded', function() {
            const sartsayisiInput = document.getElementById('sartsayisi');
            const conditionsContainer = document.getElementById('conditions-container');
            const submitButton = document.getElementById('submit-button');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const responseMessage = document.getElementById('response-message');

            // Sayfa yüklendiğinde localStorage'dan verileri al ve yükle
            const storedConditions = JSON.parse(localStorage.getItem('conditions')) || {};
            let currentSartsayisi = parseInt(sartsayisiInput.value) || 1;

            // Şartları oluştur
            generateConditions(currentSartsayisi);

            // Şart sayısı değiştiğinde verileri sakla ve yeni inputlar oluştur
            sartsayisiInput.addEventListener('input', function() {
                storeConditions(); // Mevcut verileri sakla
                currentSartsayisi = parseInt(sartsayisiInput.value) || 1;
                generateConditions(currentSartsayisi);
            });

            // Şartları oluşturma fonksiyonu
            function generateConditions(count) {
                conditionsContainer.innerHTML = ''; // Mevcut içerikleri temizle

                for (let i = 1; i <= count; i++) {
                    const conditionDiv = document.createElement('div');
                    conditionDiv.classList.add('d-flex', 'pe-3', 'my-4');

                    conditionDiv.innerHTML = `
                        <div class="col-6">
                            <label for="ders_akademisyen_${i}" class="form-label">Ders - Akademisyen</label>
                            <div class="mb-3 me-3 ps-3 pe-1 d-flex align-items-center">
                                <select class="form-select" id="ders_akademisyen_${i}" name="ders_akademisyen[]">
                                    <option value="">Lütfen Ders ve Akademisyeni Seçiniz</option>
                                    ${dersProgrami.map(ders => `<option value="${ders.id}" data-ders-saati="${ders.ders_saati}">${ders.ders_adi} (${ders.hoca_isim} ${ders.hoca_soyisim})</option>`).join('')}
                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            <label for="gun_${i}" class="form-label">Gün</label>
                            <div class="mb-3 me-3 ps-3 pe-1 d-flex align-items-center">
                                <select class="form-select" id="gun_${i}" name="gun[]">
                                    <option value="">Gün Seçiniz</option>
                                    ${gunler.map(gun => `<option value="${gun}">${gun}</option>`).join('')}
                                </select>
                            </div>
                        </div>

                        <div class="col-2">
                            <label for="ders_saati_${i}" class="form-label">Ders Saati</label>
                            <div class="mb-3 d-flex ps-3 pe-1 col-12 align-items-center">
                                <select class="form-select" id="ders_saati_${i}" name="ders_saati[]">
                                    <option value="">Ders Saati Seçiniz</option>
                                    ${Array.from({ length: maxDersSaati }, (_, j) => `<option value="${j + 1}">${j + 1}</option>`).join('')}
                                </select>
                            </div>
                        </div>
                    `;

                    // Şartlar container'a eklenir
                    conditionsContainer.appendChild(conditionDiv);

                    // Eğer storedConditions'da veri varsa, select'lere geri yükle
                    if (storedConditions[`ders_akademisyen_${i}`]) {
                        document.getElementById(`ders_akademisyen_${i}`).value = storedConditions[`ders_akademisyen_${i}`];
                        document.getElementById(`gun_${i}`).value = storedConditions[`gun_${i}`];
                        document.getElementById(`ders_saati_${i}`).value = storedConditions[`ders_saati_${i}`];
                    }

                    // Verileri sakla (Her select değişiminde)
                    document.getElementById(`ders_akademisyen_${i}`).addEventListener('change', storeConditions);
                    document.getElementById(`gun_${i}`).addEventListener('change', storeConditions);
                    document.getElementById(`ders_saati_${i}`).addEventListener('change', storeConditions);
                }
            }

            // Verileri localStorage'a kaydetme fonksiyonu
            function storeConditions() {
                let conditionsData = {};
                
                for (let i = 1; i <= currentSartsayisi; i++) {
                    conditionsData[`ders_akademisyen_${i}`] = document.getElementById(`ders_akademisyen_${i}`).value;
                    conditionsData[`gun_${i}`] = document.getElementById(`gun_${i}`).value;
                    conditionsData[`ders_saati_${i}`] = document.getElementById(`ders_saati_${i}`).value;
                }

                // Veriyi localStorage'a kaydet
                localStorage.setItem('conditions', JSON.stringify(conditionsData));
            }

            // Formu gönderme fonksiyonu
            function submitForm() {
                const dersSartlari = [];
                let hataVar = false;

                for (let i = 1; i <= currentSartsayisi; i++) {
                    const dersSelect = document.getElementById(`ders_akademisyen_${i}`);
                    const dersSaati = parseInt(dersSelect.options[dersSelect.selectedIndex].dataset.dersSaati);
                    const baslangicSaati = parseInt(document.getElementById(`ders_saati_${i}`).value);

                    // Başlangıç saati + ders saati, günlük maksimum ders saatini aşıyor mu kontrol ediyoruz
                    if ((baslangicSaati + dersSaati - 1) > maxDersSaati) {
                        hataVar = true;
                        alert(`Seçtiğiniz ders, ${baslangicSaati}. saatten başlayarak ${dersSaati} saat sürecektir ve maksimum günlük ders saati olan ${maxDersSaati} saati aşmaktadır.`);
                        break;
                    }

                    const gunId = document.getElementById(`gun_${i}`).value;

                    // Eğer hata yoksa ders şartlarını kaydediyoruz
                    if (!hataVar && dersSelect.value && gunId && baslangicSaati) {
                        dersSartlari.push([dersSelect.value, gunId, baslangicSaati]);
                    }
                }

                if (!hataVar) {
                    // Form verilerini toplama ve AJAX ile gönderme
                    const formData = new FormData();
                    formData.append('ders_sartlari', JSON.stringify(dersSartlari));

                    // Diğer form verilerini ekleme
                    formData.append('sinifcakismasi', document.querySelector('input[name="sinifcakismasi"]:checked').value);
                    formData.append('akademisyencakismasi', document.querySelector('input[name="akademisyencakismasi"]:checked').value);
                    formData.append('salonlarcakismasi', document.querySelector('input[name="salonlarcakismasi"]:checked').value);
                    formData.append('sart_sayisi', document.getElementById('sartsayisi').value);

                    // AJAX ile sunucuya veri gönderiyoruz
                    fetch('{{ route('ders_programi.store') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Mesajı gösteriyoruz
                        if (data.success) {
                            responseMessage.classList.remove('d-none', 'alert-danger');
                            responseMessage.classList.add('alert-success');
                            responseMessage.innerHTML = `<b>${data.message}</b>`;
                        } else {
                            responseMessage.classList.remove('d-none', 'alert-success');
                            responseMessage.classList.add('alert-danger');
                            responseMessage.innerHTML = `<b>${data.message}</b>`;
                        }

                        // 4 saniye sonra mesajı gizle
                        setTimeout(() => {
                            responseMessage.classList.add('d-none');
                        }, 4000); // 4 saniye sonra gizle
                    })
                    .catch(error => {
                        console.error('Hata:', error);
                        responseMessage.classList.remove('d-none', 'alert-success');
                        responseMessage.classList.add('alert-danger');
                        responseMessage.innerHTML = `<b>Bir hata oluştu: ${error.message}</b>`;

                        // 4 saniye sonra hata mesajını gizle
                        setTimeout(() => {
                            responseMessage.classList.add('d-none');
                        }, 4000); // 4 saniye sonra gizle
                    });
                }
            }

            submitButton.addEventListener('click', submitForm);
        });

    </script>

       
@endsection


