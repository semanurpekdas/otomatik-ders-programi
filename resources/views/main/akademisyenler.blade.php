@extends('layout')

@section('title', 'Dersler')

@section('content')
    <div class="px-5 mt-5 pt-4">
        <div class="bg-white border shadow p-3 pt-5">
            <div class="d-flex justify-content-center" >
                <div class="d-flex justify-content-center bg-success rounded w-75 text-white py-3" id="sınıftab">
                    <h2>Akademisyenler</h2>
                </div>
            </div>
            <div class=" mt-3">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#sınıfEkleModal">Akademisyen Ekle</button>
                    <!-- sınıf ekleme modal -->
                    <div class="modal fade" id="sınıfEkleModal" tabindex="-1" aria-labelledby="sınıfEkleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="sınıfEkleModalLabel">Akademisyen Ekle</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <label for="createsınıfAdı" class="form-label">İsim</label>
                                        <div class="mb-3 px-1">
                                            <input type="text" class="form-control" id="createsınıfAdı">
                                        </div>
                                        <label for="createfakulte" class="form-label">Soyisim</label>
                                        <div class="mb-3 px-1">
                                            <input type="text" class="form-control" id="createfakulte">
                                        </div>
                                        <label for="createfakulte" class="form-label">Kısa Kod</label>
                                        <div class="mb-3 px-1">
                                            <input type="text" class="form-control" id="createfakulte">
                                        </div>
                                        <label for="createfakulte" class="form-label">E-Posta</label>
                                        <div class="mb-3 px-1">
                                            <input type="text" class="form-control" id="createfakulte">
                                        </div>
                                        <label for="createfakulte" class="form-label">Telefon</label>
                                        <div class="mb-3 px-1">
                                            <input type="text" class="form-control" id="createfakulte">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Ekle</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><b>#</b></th>
                            <th scope="col"><b>İsmi</b></th>
                            <th scope="col"><b>Soyisim</b></th>
                            <th scope="col"><b>Kısa Kod</b></th>
                            <th scope="col"><b>E-posta</b></th>
                            <th scope="col"><b>Telefon</b></th>
                            <th scope="col"><b>İşlemler</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Hakan</td>
                            <td>KÖR</td>
                            <td>HK</td>
                            <td>hakankör@hitit.edu.tr</td>
                            <td>0545 987 52 52</td>
                            <td>
                                <div class="d-flex justify-content-start text-white">
                                    <a href="#" class="btn btn-primary me-2 ">Düzenle</a>
                                    <a href="#" class="btn btn-danger">Sil</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Ömer Faruk</td>
                            <td>Akmeşe</td>
                            <td>OFA</td>
                            <td>omerfarukakmese@hitit.edu.tr</td>
                            <td>0531 543 23 52</td>
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
    </script>
@endsection
