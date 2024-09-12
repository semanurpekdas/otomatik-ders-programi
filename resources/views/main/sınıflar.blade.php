@extends('layout')

@section('title', 'Salonlar')

@section('content')
    <div class="px-5 mt-5 pt-4">
        <div class="bg-white border shadow p-3 pt-5">
            <div class="d-flex justify-content-center" >
                <div class="d-flex justify-content-center bg-primary rounded w-75 text-white py-3" id="sınıftab">
                    <h2>Salonlar</h2>
                </div>
            </div>
            <div class=" mt-3">
                <div class="d-flex justify-content-between my-3">
                    <div>
                        <button class="btn btn-warning text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Filtre</button>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Salon Filtreleme</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <form>
                                    <label for="createkapasite" class="form-label">Fakulteye Göre</label>
                                    <div class="mb-3 px-1">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Fakülte Seçiniz</option>
                                            <option value="1">Mühendislik Fakültesi</option>
                                            <option value="2">İlahiyat Fakültesi</option>
                                        </select>
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
                                        <h5 class="modal-title" id="sınıfEkleModalLabel">Sınıf Ekle</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            
                                            <label for="createsınıfAdı" class="form-label">Sınıf Adı</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" id="createsınıfAdı">
                                            </div>
                                            <label for="createfakulte" class="form-label">Fakülte</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" id="createfakulte">
                                            </div>
                                            <label for="createkapasite" class="form-label">Kapasite</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" id="createkapasite">
                                            </div>
                                            <label for="exampleColorInput" class="form-label">Ders Rengi</label>
                                            <div class="mb-3 px-1">
                                                <input type="color" class="form-control form-control-color w-100" id="exampleColorInput" value="#563d7c" title="Choose your color">
                                            </div>
                                            <button type="submit" class="btn btn-success text-white w-100 mt-3">Ekle</button>
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
                            <th scope="col"><b>Salon İsmi</b></th>
                            <th scope="col"><b>Fakülte</b></th>
                            <th scope="col"><b>Kişi Sayısı</b></th>
                            <th scope="col"><b>Salon Rengi</b></th>
                            <th scope="col"><b>İşlemler</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>206</td>
                            <td>Mühendislik Fakültesi</td>
                            <td>56</td>
                            <td><div class="salon-rengi" style="background-color: #034f84;"></div></td>
                            <td>
                                <div class="d-flex justify-content-start text-white">
                                    <a href="#" class="btn btn-primary me-2 ">Düzenle</a>
                                    <a href="#" class="btn btn-danger">Sil</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>207</td>
                            <td>Mühendislik Fakültesi</td>
                            <td>56</td>
                            <td><div class="salon-rengi" style="background-color: #9c27b0;"></div></td>
                            <td>
                                <div class="d-flex justify-content-start text-white">
                                    <a href="#" class="btn btn-primary me-2 ">Düzenle</a>
                                    <a href="#" class="btn btn-danger">Sil</a>
                                </div>
                            </td>
                        </tr> 
                        <tr>
                            <th scope="row">3</th>
                            <td>İlahiyat Lab 1</td>
                            <td>İlahiyat Fakültesi</td>
                            <td>40</td>
                            <td><div class="salon-rengi" style="background-color: #9c27b0;"></div></td>
                            <td>
                                <div class="d-flex justify-content-start text-white">
                                    <a href="#" class="btn btn-primary me-2 ">Düzenle</a>
                                    <a href="#" class="btn btn-danger">Sil</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>İlahiyat Lab 2</td>
                            <td>İlahiyat Fakültesi</td>
                            <td>40</td>
                            <td><div class="salon-rengi" style="background-color: #4caf50;"></div></td>
                            <td>
                                <div class="d-flex justify-content-start text-white">
                                    <a href="#" class="btn btn-primary me-2 ">Düzenle</a>
                                    <a href="#" class="btn btn-danger">Sil</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
    </script>
       
@endsection
