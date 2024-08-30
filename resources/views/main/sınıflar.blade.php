@extends('layout')

@section('title', 'Sınıflar')

@section('content')
    <div class="px-5 mt-5 pt-4">
        <div class="bg-white border shadow p-3 pt-5">
            <div class="d-flex justify-content-center" >
                <div class="d-flex justify-content-center bg-primary rounded w-75 text-white py-3" id="sınıftab">
                    <h2>Sınıflar</h2>
                </div>
            </div>
            <div class=" mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><b>#</b></th>
                            <th scope="col"><b>Sınıf İsmi</b></th>
                            <th scope="col"><b>Kişi Sayısı</b></th>
                            <th scope="col"><b>İşlemler</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>206</td>
                            <td>56</td>
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
                            <td>56</td>
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
                            <td>40</td>
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
                            <td>40</td>
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
    </style>
@endsection
