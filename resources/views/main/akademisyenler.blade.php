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
                <div class="d-flex justify-content-between my-3">
                    <div>
                        <button class="btn btn-warning text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Filtre</button>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Akademisyen Filtreleme</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <form>
                                    <label for="createkapasite" class="form-label">Fakülteye Göre</label>
                                    <div class="mb-3 px-1">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Fakülte Seçiniz</option>
                                            <option value="1">İlahiyat Fakültesi</option>
                                            <option value="2">Mühendislik Fakültesi</option>
                                        </select>
                                    </div>
                                    <label for="createkapasite" class="form-label">Bölüme Göre</label>
                                    <div class="mb-3 px-1">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Bölüm Seçiniz</option>
                                            <option value="1">Bilgisayar Mühendisliği</option>
                                            <option value="1">Elektrik Elektronik Mühendisliği</option>
                                            <option value="2">Bilgisayar Programcılığı</option>
                                        </select>
                                    </div>
                                    <label for="createkapasite" class="form-label">Cinsiyete Göre</label>
                                    <div class="mb-3 px-1">
                                        <select class="form-select">
                                            <option selected>Cinsiyet Seçiniz</option>
                                            <option value="1">Erkek</option>
                                            <option value="2">Kadın</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-warning text-white w-100">Filtrele</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#akademisyengetir">Akademisyen Getir</button>
                        <div class="modal fade" id="akademisyengetir" tabindex="-1" aria-labelledby="sınıfEkleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="sınıfEkleModalLabel">Akademisyen Getir</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <label for="createEposta" class="form-label">E-Posta</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" id="createEposta">
                                            </div>
                                            <button type="submit" class="btn btn-secondary text-white w-100 mt-3">Getir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#sınıfEkleModal">Akademisyen Ekle</button>
                        <!-- Akademisyen ekleme modal -->
                        <div class="modal fade" id="sınıfEkleModal" tabindex="-1" aria-labelledby="sınıfEkleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="sınıfEkleModalLabel">Akademisyen Ekle</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <label for="createİsim" class="form-label">İsim</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" id="createİsim">
                                            </div>
                                            <label for="createSoyisim" class="form-label">Soyisim</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" id="createSoyisim">
                                            </div>
                                            <label for="createKısa" class="form-label">Kısa Kod</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" id="createKısa">
                                            </div>
                                            <label for="createkapasite" class="form-label">Cinsiyet</label>
                                            <div class="mb-3 px-1">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected disabled>Cinsiyet Seçiniz</option>
                                                    <option value="1">Erkek</option>
                                                    <option value="2">Kadın</option>
                                                </select>
                                            </div>
                                            <label for="createkapasite" class="form-label">Unvan</label>
                                            <div class="mb-3 px-1">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected disabled>Unvan Seçiniz</option>
                                                    <option value="1">Arş. Gör.</option>
                                                    <option value="2">Dr. Öğr.</option>
                                                    <option value="2">Doç. Dr.</option>
                                                    <option value="2">Prof. Dr.</option>
                                                </select>
                                            </div>
                                            <label for="createKısa" class="form-label">Bölüm</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" id="createKısa" list="bolumler">
                                            </div>
                                            <label for="createtelefon" class="form-label">Fakülte</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" id="createtelefon">
                                            </div>
 
                                            <label for="createEposta" class="form-label">Kurumsal E-Posta</label>
                                            <div class="mb-3 px-1">
                                                <input type="text" class="form-control" id="createEposta">
                                            </div>
                                            
                                            <label for="exampleColorInput" class="form-label">Renk Kodu</label>
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
                            <th scope="col"><b>İsmi</b></th>
                            <th scope="col"><b>Soyisim</b></th>
                            <th scope="col"><b>Kısa Kod</b></th>
                            <th scope="col"><b>Bölüm</b></th>
                            <th scope="col"><b>Kurumsal E-posta</b></th>
                            <th scope="col"><b>Renk Kodu</b></th>
                            <th scope="col"><b>İşlemler</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Hakan</td>
                            <td>KÖR</td>
                            <td>HK</td>
                            <td>Bilgisayar Müh.</td>
                            <td>hakankör@hitit.edu.tr</td>
                            <td><div class="akademisyen-rengi" style="background-color: #034f84;"></div></td>
                            <td>
                                <div class="d-flex justify-content-start text-white">
                                    <a href="#" class="btn btn-secondary me-2 text-white ">Detay</a>
                                    <a href="#" class="btn btn-primary me-2 ">Düzenle</a>
                                    <a href="#" class="btn btn-danger text-white">Sil</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Ömer Faruk</td>
                            <td>Akmeşe</td>
                            <td>OFA</td>
                            <td>Bilgisayar Müh.</td>
                            <td>omerfarukakmese@hitit.edu.tr</td>
                            <td><div class="akademisyen-rengi" style="background-color: #9c27b0;"></div></td>
                            <td>
                                <div class="d-flex justify-content-start text-white">
                                    <a href="#" class="btn btn-secondary me-2 text-white ">Detay</a>
                                    <a href="#" class="btn btn-primary me-2 ">Düzenle</a>
                                    <a href="#" class="btn btn-danger text-white">Sil</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <datalist id="fakulteler">
        <option value="Fen-Edebiyat Fakültesi">
        <option value="Mühendislik Fakültesi">
        <option value="Mimarlık Fakültesi">
        <option value="İktisadi ve İdari Bilimler Fakültesi">
        <option value="Sağlık Bilimleri Fakültesi">
        <option value="Eğitim Fakültesi">
        <option value="Tıp Fakültesi">
        <option value="Hukuk Fakültesi">
        <option value="Diş Hekimliği Fakültesi">
        <option value="Güzel Sanatlar Fakültesi">
        <option value="İlahiyat Fakültesi">
        <option value="Ziraat Fakültesi">
        <option value="Eczacılık Fakültesi">
        <option value="Spor Bilimleri Fakültesi">
        <option value="Su Ürünleri Fakültesi">
        <option value="İletişim Fakültesi">
        <option value="Veteriner Fakültesi">
        <option value="Orman Fakültesi">
        <option value="Diş Hekimliği Fakültesi">
        <option value="Denizcilik Fakültesi">
    </datalist>


    <datalist Id="bolumler">
        <option value="Aci̇l Yardim Ve Afet Yöneti̇mi̇">
        <option value="Adli̇ Bi̇li̇mler">
        <option value="Adli̇ Bi̇li̇şi̇m Mühendi̇sli̇ği̇">
        <option value="Ağaç İşleri̇ Endüstri̇ Mühendi̇sli̇ği̇">
        <option value="Ai̇le Ve Tüketi̇ci̇ Bi̇li̇mleri̇">
        <option value="Aktüerya Bi̇li̇mleri̇">
        <option value="Alman Di̇li̇ Ve Edebi̇yati">
        <option value="Almanca Müterci̇m Ve Tercümanlik">
        <option value="Almanca Öğretmenli̇ği̇">
        <option value="Ameri̇kan Kültürü Ve Edebi̇yati">
        <option value="Antrenörlük Eği̇ti̇mi̇">
        <option value="Antropoloji̇">
        <option value="Arap Di̇li̇ Ve Edebi̇yati">
        <option value="Arapça Müterci̇m Ve Tercümanlik">
        <option value="Arapça Öğretmenli̇ği̇">
        <option value="Arkeoloji̇">
        <option value="Arkeoloji̇ Ve Sanat Tari̇hi̇">
        <option value="Arnavut Di̇li̇ Ve Edebi̇yati">
        <option value="Astronomi̇ Ve Uzay Bi̇li̇mleri̇">
        <option value="Ayakkabi Tasarimi Ve Üreti̇mi̇">
        <option value="Azerbaycan Türkçesi̇ Ve Edebi̇yati">
        <option value="Bahçe Bi̇tki̇leri̇">
        <option value="Balikçilik Teknoloji̇si̇ Mühendi̇sli̇ği̇">
        <option value="Bankacilik">
        <option value="Bankacilik Ve Fi̇nans">
        <option value="Bankacilik Ve Si̇gortacilik">
        <option value="Basim Teknoloji̇leri̇">
        <option value="Basin Ve Yayin">
        <option value="Bati Di̇lleri̇">
        <option value="Beden Eği̇ti̇mi̇ Ve Spor Öğretmenli̇ği̇">
        <option value="Beslenme Ve Di̇yeteti̇k">
        <option value="Bilgi Güvenli̇ği̇ Teknoloji̇si̇">
        <option value="Bilgi Ve Belge Yöneti̇mi̇">
        <option value="Bilgisayar Bi̇li̇mleri̇">
        <option value="Bilgisayar Mühendi̇sli̇ği̇">
        <option value="Bilgisayar Teknoloji̇si̇ Ve Bi̇li̇şi̇m Si̇stemleri̇">
        <option value="Bilgisayar Ve Öğreti̇m Teknoloji̇leri̇ Öğretmenli̇ği̇">
        <option value="Bilim Tari̇hi̇">
        <option value="Bilişim Si̇stemleri̇ Mühendi̇sli̇ği̇">
        <option value="Bilişim Si̇stemleri̇ Ve Teknoloji̇leri̇">
        <option value="Bi̇tki̇ Koruma">
        <option value="Bi̇tki̇sel Üreti̇m Ve Teknoloji̇leri̇">
        <option value="Bi̇yoki̇mya">
        <option value="Bi̇yoloji̇">
        <option value="Bi̇yoloji̇ Öğretmenli̇ği̇">
        <option value="Bi̇yomedi̇kal Mühendi̇sli̇ği̇">
        <option value="Bi̇yomühendi̇sli̇k">
        <option value="Bi̇yosi̇stem Mühendi̇sli̇ği̇">
        <option value="Bi̇yoteknoloji̇">
        <option value="Boşnak Di̇li̇ Ve Edebi̇yati">
        <option value="Bulgar Di̇li̇ Ve Edebi̇yati">
        <option value="Bulgarca Müterci̇m Ve Tercümanlik">
        <option value="Çağdaş Türk Lehçeleri̇ Ve Edebi̇yatlari">
        <option value="Çağdaş Yunan Di̇li̇ Ve Edebi̇yati">
        <option value="Çalişma Ekonomi̇si̇ Ve Endüstri̇ İli̇şki̇leri̇">
        <option value="Çerkez Di̇li̇ Ve Kültürü">
        <option value="Cevher Hazirlama Mühendi̇sli̇ği̇">
        <option value="Çevi̇ri̇bi̇li̇mi̇">
        <option value="Çevre Mühendi̇sli̇ği̇">
        <option value="Çi̇n Di̇li̇ Ve Edebi̇yati">
        <option value="Çi̇nce Müterci̇m Ve Tercümanlik">
        <option value="Çi̇zgi̇ Fi̇lm Ve Ani̇masyon">
        <option value="Çocuk Geli̇şi̇mi̇">
        <option value="Coğrafya">
        <option value="Coğrafya Öğretmenli̇ği̇">
        <option value="Deni̇z Ulaştirma İşletme Mühendi̇sli̇ği̇">
        <option value="Deni̇zci̇li̇k İşletmeleri̇ Yöneti̇mi̇">
        <option value="Deri̇ Mühendi̇sli̇ği̇">
        <option value="Di̇ji̇tal Oyun Tasarimi">
        <option value="Di̇l Ve Konuşma Terapi̇si̇">
        <option value="Di̇lbi̇li̇mi̇">
        <option value="Di̇ş Heki̇mli̇ği̇">
        <option value="Doğu Di̇lleri̇">
        <option value="Ebeli̇k">
        <option value="Eczacilik">
        <option value="Egzersi̇z Ve Spor Bi̇li̇mleri̇">
        <option value="Ekonometri̇">
        <option value="Ekonomi̇">
        <option value="Ekonomi̇ Ve Fi̇nans">
        <option value="El Sanatlari">
        <option value="Elektri̇k Mühendi̇sli̇ği̇">
        <option value="Elektri̇k-Elektroni̇k Mühendi̇sli̇ği̇">
        <option value="Elektroni̇k Mühendi̇sli̇ği̇">
        <option value="Elektroni̇k Ti̇caret Ve Yöneti̇mi̇">
        <option value="Elektroni̇k Ve Haberleşme Mühendi̇sli̇ği̇">
        <option value="Emlak Ve Emlak Yöneti̇mi̇">
        <option value="Endüstri̇ Mühendi̇sli̇ği̇">
        <option value="Endüstri̇yel Tasarim Mühendi̇sli̇ği̇">
        <option value="Endüstri̇yel Tasarim">
        <option value="Enerji̇ Bi̇li̇mi̇ Ve Teknoloji̇leri̇">
        <option value="Enerji̇ Si̇stemleri̇ Mühendi̇sli̇ği̇">
        <option value="Enerji̇ Yöneti̇mi̇">
        <option value="Ergoterapi̇">
        <option value="Ermeni̇ Di̇li̇ Ve Kültürü">
        <option value="Eski̇ Yunan Di̇li̇ Ve Edebi̇yati">
        <option value="Fars Di̇li̇ Ve Edebi̇yati">
        <option value="Farsça Müterci̇m Ve Tercümanlik">
        <option value="Felsefe">
        <option value="Felsefe Grubu Öğretmenli̇ği̇">
        <option value="Fen Bi̇lgi̇si̇ Öğretmenli̇ği̇">
        <option value="Fi̇lm Tasarimi Ve Yazarliği">
        <option value="Fi̇lm Tasarimi Ve Yöneti̇mi̇">
        <option value="Fi̇lm Tasarimi Ve Yönetmenli̇ği̇">
        <option value="Fi̇nans Ve Bankacilik">
        <option value="Fi̇zi̇k">
        <option value="Fi̇zi̇k Mühendi̇sli̇ği̇">
        <option value="Fi̇zi̇k Öğretmenli̇ği̇">
        <option value="Fi̇zyoterapi̇ Ve Rehabi̇li̇tasyon">
        <option value="Fotoğraf">
        <option value="Fotoğraf Ve Vi̇deo">
        <option value="Fotoni̇k">
        <option value="Fransiz Di̇li̇ Ve Edebi̇yati">
        <option value="Fransizca Müterci̇m Ve Tercümanlik">
        <option value="Fransizca Öğretmenli̇ği̇">
        <option value="Gastronomi̇ Ve Mutfak Sanatlari">
        <option value="Gayri̇menkul Geli̇şti̇rme Ve Yöneti̇mi̇">
        <option value="Gazeteci̇li̇k">
        <option value="Geleneksel Türk Sanatlari">
        <option value="Gemi̇ İnşaati Ve Gemi̇ Maki̇neleri̇ Mühendi̇sli̇ği̇">
        <option value="Gemi̇ Maki̇neleri̇ İşletme Mühendi̇sli̇ği̇">
        <option value="Gemi̇ Ve Deni̇z Teknoloji̇si̇ Mühendi̇sli̇ği̇">
        <option value="Gemi̇ Ve Yat Tasarimi">
        <option value="Geneti̇k Ve Bi̇yomühendi̇sli̇k">
        <option value="Geneti̇k Ve Yaşam Bi̇li̇mleri̇ Programlari">
        <option value="Geomati̇k Mühendi̇sli̇ği̇">
        <option value="Gerontoloji̇">
        <option value="Gida Mühendi̇sli̇ği̇">
        <option value="Gida Teknoloji̇si̇">
        <option value="Gi̇ri̇şi̇mci̇li̇k">
        <option value="Görsel İleti̇şi̇m Tasarimi">
        <option value="Görsel Sanatlar">
        <option value="Görsel Sanatlar Ve İleti̇şi̇m Tasarimi">
        <option value="Grafi̇k">
        <option value="Grafi̇k Sanatlar">
        <option value="Grafi̇k Tasarimi">
        <option value="Gümrük İşletme">
        <option value="Gürcü Di̇li̇ Ve Edebi̇yati">
        <option value="Halkbi̇li̇mi̇">
        <option value="Halkla İli̇şki̇ler Ve Reklamcilik">
        <option value="Halkla İli̇şki̇ler Ve Tanitim">
        <option value="Hari̇ta Mühendi̇sli̇ği̇">
        <option value="Havacilik Elektri̇k Ve Elektroni̇ği̇">
        <option value="Havacilik Ve Uzay Mühendi̇sli̇ği̇">
        <option value="Havacilik Yöneti̇mi̇">
        <option value="Hayvansal Üreti̇m Ve Teknoloji̇leri̇">
        <option value="Hemşi̇reli̇k">
        <option value="Hi̇drojeoloji̇ Mühendi̇sli̇ği̇">
        <option value="Hi̇ndoloji̇">
        <option value="Hi̇ti̇toloji̇">
        <option value="Hukuk">
        <option value="Hungaroloji̇">
        <option value="İbrani̇ Di̇li̇ Ve Kültürü">
        <option value="İç Mi̇marlik">
        <option value="İç Mi̇marlik Ve Çevre Tasarimi">
        <option value="İkti̇sadi̇ Ve İdari̇ Bi̇li̇mler Programlari">
        <option value="İkti̇sadi̇ Ve İdari̇ Programlar">
        <option value="İkti̇sat">
        <option value="İlahi̇yat">
        <option value="İleti̇şi̇m">
        <option value="İleti̇şi̇m Bi̇li̇mleri̇">
        <option value="İleti̇şi̇m Sanatlari">
        <option value="İleti̇şi̇m Tasarimi Ve Yöneti̇mi̇">
        <option value="İleti̇şi̇m Ve Tasarimi">
        <option value="İlköğreti̇m Matemati̇k Öğretmenli̇ği̇">
        <option value="İmalat Mühendi̇sli̇ği̇">
        <option value="İngi̇li̇z Di̇lbi̇li̇mi̇">
        <option value="İngi̇li̇z Di̇li̇ Ve Edebi̇yati">
        <option value="İngi̇li̇z Ve Rus Di̇lleri̇ Ve Edebi̇yatlari">
        <option value="İngi̇li̇zce Müterci̇m Ve Tercümanlik">
        <option value="İngi̇li̇zce Öğretmenli̇ği̇">
        <option value="İngi̇li̇zce, Fransizca Müterci̇m Ve Tercümanlik">
        <option value="İnşaat Mühendi̇sli̇ği̇">
        <option value="İnşaat Mühendi̇sli̇ği̇(M.T.O.K.)">
        <option value="İnsan Kaynaklari Yöneti̇mi̇">
        <option value="İş Sağliği Ve Güvenli̇ği̇">
        <option value="İslam Bi̇li̇mleri̇">
        <option value="İslam İkti̇sadi Ve Fi̇nans">
        <option value="İslami̇ İli̇mler">
        <option value="İşletme">
        <option value="İşletme Mühendi̇sli̇ği̇">
        <option value="İspanyol Di̇li̇ Ve Edebi̇yati">
        <option value="İstati̇sti̇k">
        <option value="İstati̇sti̇k Ve Bi̇lgi̇sayar Bi̇li̇mleri̇">
        <option value="İtalyan Di̇li̇ Ve Edebi̇yati">
        <option value="Japon Di̇li̇ Ve Edebi̇yati">
        <option value="Japonca Müterci̇m Ve Tercümanlik">
        <option value="Japonca Öğretmenli̇ği̇">
        <option value="Jeofi̇zi̇k Mühendi̇sli̇ği̇">
        <option value="Jeoloji̇ Mühendi̇sli̇ği̇">
        <option value="Kamu Yöneti̇mi̇">
        <option value="Kamu Yöneti̇mi̇(Açiköğreti̇m)">
        <option value="Kanatli Hayvan Yeti̇şti̇ri̇ci̇li̇ği̇">
        <option value="Karşilaştirmali Edebi̇yat">
        <option value="Kazak Di̇li̇ Ve Edebi̇yati">
        <option value="Kentsel Tasarim Ve Peyzaj Mi̇marliği">
        <option value="Ki̇mya">
        <option value="Ki̇mya Mühendi̇sli̇ği̇">
        <option value="Ki̇mya Öğretmenli̇ği̇">
        <option value="Ki̇mya-Bi̇yoloji̇ Mühendi̇sli̇ği̇">
        <option value="Klasi̇k Arkeoloji̇">
        <option value="Kontrol Ve Otomasyon Mühendi̇sli̇ği̇">
        <option value="Kore Di̇li̇ Ve Edebi̇yati">
        <option value="Kültür Varliklarini Koruma Ve Onarim">
        <option value="Kültür Ve İleti̇şi̇m Bi̇li̇mleri̇">
        <option value="Küresel Si̇yaset Ve Uluslararasi İli̇şki̇ler">
        <option value="Kurgu, Ses Ve Görüntü Yöneti̇mi̇">
        <option value="Kuyumculuk Ve Mücevher Tasarimi">
        <option value="Lati̇n Di̇li̇ Ve Edebi̇yati">
        <option value="Leh Di̇li̇ Ve Edebi̇yati">
        <option value="Loji̇sti̇k Yöneti̇mi̇">
        <option value="Maden Mühendi̇sli̇ği̇">
        <option value="Maki̇ne Mühendi̇sli̇ği̇">
        <option value="Mali̇ye">
        <option value="Malzeme Bi̇li̇mi̇ Ve Mühendi̇sli̇ği̇">
        <option value="Malzeme Bi̇li̇mi̇ Ve Nanoteknoloji̇ Mühendi̇sli̇ği̇">
        <option value="Malzeme Bi̇li̇mi̇ Ve Teknoloji̇leri̇">
        <option value="Matemati̇k">
        <option value="Matemati̇k Mühendi̇sli̇ği̇">
        <option value="Matemati̇k Öğretmenli̇ği̇">
        <option value="Matemati̇k Ve Bi̇lgi̇sayar Bi̇li̇mleri̇">
        <option value="Medya Ve Görsel Sanatlar">
        <option value="Medya Ve İleti̇şi̇m">
        <option value="Mekatroni̇k Mühendi̇sli̇ği̇">
        <option value="Metalurji̇ Ve Malzeme Mühendi̇sli̇ği̇">
        <option value="Meteoroloji̇ Mühendi̇sli̇ği̇">
        <option value="Mi̇marlik">
        <option value="Moda Tasarimi">
        <option value="Moleküler Bi̇yoloji̇ Ve Geneti̇k">
        <option value="Moleküler Bi̇yoteknoloji̇">
        <option value="Muhasebe Ve Fi̇nans Yöneti̇mi̇">
        <option value="Mühendi̇sli̇k Programlari">
        <option value="Mühendi̇sli̇k Ve Doğa Bi̇li̇mleri̇ Programlari">
        <option value="Müterci̇m-Tercümanlik">
        <option value="Müzeci̇li̇k">
        <option value="Nanobi̇li̇m Ve Nanoteknoloji̇">
        <option value="Nanoteknoloji̇ Mühendi̇sli̇ği̇">
        <option value="Nükleer Enerji̇ Mühendi̇sli̇ği̇">
        <option value="Odyoloji̇">
        <option value="Okul Öncesi̇ Öğretmenli̇ği̇">
        <option value="Opti̇k Ve Akusti̇k Mühendi̇sli̇ği̇">
        <option value="Organi̇k Tarim İşletmeci̇li̇ği̇">
        <option value="Orman Endüstri̇si̇ Mühendi̇sli̇ği̇">
        <option value="Orman Mühendi̇sli̇ği̇">
        <option value="Ortez Ve Protez">
        <option value="Otel Yöneti̇ci̇li̇ği̇">
        <option value="Otomoti̇v Mühendi̇sli̇ği̇">
        <option value="Özel Eği̇ti̇m Öğretmenli̇ği̇">
        <option value="Pazarlama">
        <option value="Perfüzyon">
        <option value="Petrol Ve Doğalgaz Mühendi̇sli̇ği̇">
        <option value="Peyzaj Mi̇marliği">
        <option value="Pi̇lotaj">
        <option value="Poli̇mer Malzeme Mühendi̇sli̇ği̇">
        <option value="Poli̇ti̇ka Ve Ekonomi̇">
        <option value="Protohi̇storya Ve Ön Asya Arkeoloji̇si̇">
        <option value="Psi̇koloji̇">
        <option value="Psi̇koloji̇k Danişmanlik Ve Rehberli̇k">
        <option value="Psi̇koloji̇k Danişmanlik Ve Rehberli̇k Öğretmenli̇ği̇">
        <option value="Radyo, Televi̇zyon Ve Si̇nema">
        <option value="Rayli Si̇stemler Mühendi̇sli̇ği̇">
        <option value="Rehberli̇k Ve Psi̇koloji̇k Danişmanlik">
        <option value="Reklam Tasarimi Ve İleti̇şi̇mi̇">
        <option value="Reklamcilik">
        <option value="Rekreasyon Yöneti̇mi̇">
        <option value="Rekreasyon">
        <option value="Rus Di̇li̇ Ve Edebi̇yati">
        <option value="Rus Di̇li̇ Ve Edebi̇yati Öğretmenli̇ği̇">
        <option value="Rus Ve İngi̇li̇z Di̇lleri̇ Ve Edebi̇yatlari">
        <option value="Rusça Müterci̇m Ve Tercümanlik">
        <option value="Sağlik Yöneti̇mi̇">
        <option value="Sanat Tari̇hi̇">
        <option value="Sanat Ve Kültür Yöneti̇mi̇">
        <option value="Sanat Ve Sosyal Bi̇li̇mler Programlari">
        <option value="Şehi̇r Ve Bölge Planlama">
        <option value="Sermaye Pi̇yasasi">
        <option value="Seyahat İşletmeci̇li̇ği̇">
        <option value="Seyahat İşletmeci̇li̇ği̇ Ve Turi̇zm Rehberli̇ği̇">
        <option value="Si̇gortacilik Ve Aktüerya Bi̇li̇mleri̇">
        <option value="Si̇gortacilik Ve Ri̇sk Yöneti̇mi̇">
        <option value="Si̇gortacilik Ve Sosyal Güvenli̇k">
        <option value="Si̇gortacilik">
        <option value="Si̇nema Ve Di̇ji̇tal Medya">
        <option value="Si̇nema Ve Televi̇zyon">
        <option value="Sinif Öğretmenli̇ği̇">
        <option value="Si̇noloji̇">
        <option value="Si̇yasal Bi̇li̇mler">
        <option value="Si̇yaset Bi̇li̇mi̇">
        <option value="Si̇yaset Bi̇li̇mi̇ Ve Kamu Yöneti̇mi̇">
        <option value="Si̇yaset Bi̇li̇mi̇ Ve Uluslararasi İli̇şki̇ler">
        <option value="Sosyal Bi̇lgi̇ler Öğretmenli̇ği̇">
        <option value="Sosyal Hi̇zmet">
        <option value="Sosyoloji̇">
        <option value="Spor Yöneti̇ci̇li̇ği̇">
        <option value="Su Bi̇li̇mleri̇ Ve Mühendi̇sli̇ği̇">
        <option value="Su Ürünleri̇ Mühendi̇sli̇ği̇">
        <option value="Sümeroloji̇">
        <option value="Süryani̇ Di̇li̇ Ve Edebi̇yati">
        <option value="Süt Teknoloji̇si̇">
        <option value="Taki Tasarimi İmalati">
        <option value="Taki Tasarimi">
        <option value="Tapu Kadastro">
        <option value="Tari̇h">
        <option value="Tari̇h Öğretmenli̇ği̇">
        <option value="Tari̇h Öncesi̇ Arkeoloji̇si̇">
        <option value="Tarim Ekonomi̇si̇">
        <option value="Tarim Maki̇neleri̇ Ve Teknoloji̇leri̇ Mühendi̇sli̇ği̇">
        <option value="Tarim Ti̇careti̇ Ve İşletmeci̇li̇ği̇">
        <option value="Tarimsal Bi̇yoteknoloji̇">
        <option value="Tarimsal Geneti̇k Mühendi̇sli̇ği̇">
        <option value="Tarimsal Yapilar Ve Sulama">
        <option value="Tarla Bi̇tki̇leri̇">
        <option value="Teknoloji̇ Ve Bi̇lgi̇ Yöneti̇mi̇">
        <option value="Teksti̇l Mühendi̇sli̇ği̇">
        <option value="Teksti̇l Tasarimi">
        <option value="Teksti̇l Ve Moda Tasarimi">
        <option value="Televi̇zyon Haberci̇li̇ği̇ Ve Programciliği">
        <option value="Tip">
        <option value="Tip Mühendi̇sli̇ği̇">
        <option value="Ti̇yatro Eleşti̇rmenli̇ği̇ Ve Dramaturji̇">
        <option value="Tohum Bi̇li̇mi̇ Ve Teknoloji̇si̇">
        <option value="Toprak Bi̇li̇mi̇ Ve Bi̇tki̇ Besleme">
        <option value="Turi̇zm İşletmeci̇li̇ği̇">
        <option value="Turi̇zm Rehberli̇ği̇">
        <option value="Turi̇zm Ve Otel İşletmeci̇li̇ği̇">
        <option value="Türk Di̇li̇ Ve Edebi̇yati">
        <option value="Türk Di̇li̇ Ve Edebi̇yati Öğretmenli̇ği̇">
        <option value="Türk Halkbi̇li̇mi̇">
        <option value="Türk İslam Arkeoloji̇si̇">
        <option value="Türkçe Öğretmenli̇ği̇">
        <option value="Türkoloji̇">
        <option value="Tütün Eksperli̇ği̇">
        <option value="Uçak Bakim Ve Onarim">
        <option value="Uçak Elektri̇k Ve Elektroni̇ği̇">
        <option value="Uçak Gövde Ve Motor Bakimi">
        <option value="Uçak Mühendi̇sli̇ği̇">
        <option value="Ukrayna Di̇li̇ Ve Edebi̇yati">
        <option value="Uluslararasi Fi̇nans">
        <option value="Uluslararasi Fi̇nans Ve Bankacilik">
        <option value="Uluslararasi Gi̇ri̇şi̇mci̇li̇k">
        <option value="Uluslararasi İli̇şki̇ler">
        <option value="Uluslararasi İşletme Yöneti̇mi̇">
        <option value="Uluslararasi Ti̇caret Ve Fi̇nans">
        <option value="Uluslararasi Ti̇caret Ve Fi̇nansman">
        <option value="Uluslararasi Ti̇caret Ve İşletmeci̇li̇k">
        <option value="Uluslararasi Ti̇caret Ve Loji̇sti̇k">
        <option value="Uluslararasi Ti̇caret">
        <option value="Urdu Di̇li̇ Ve Edebi̇yati">
        <option value="Uzay Bi̇li̇mleri̇ Ve Teknoloji̇leri̇">
        <option value="Uzay Mühendi̇sli̇ği̇">
        <option value="Uzay Ve Uydu Mühendi̇sli̇ği̇">
        <option value="Veteri̇nerli̇k">
        <option value="Yaban Hayati Ekoloji̇si̇ Ve Yöneti̇mi̇">
        <option value="Yapay Zeka Mühendi̇sli̇ği̇">
        <option value="Yapay Zeka Ve Veri̇ Mühendi̇sli̇ği̇">
        <option value="Yazılım Geli̇şti̇rme">
        <option value="Yazılım Mühendi̇sli̇ği̇">
        <option value="Yeni̇ Medya Ve İleti̇şi̇m">
        <option value="Yeni̇ Medya">
        <option value="Yerel Yöneti̇mler">
        <option value="Yi̇yecek Ve İçecek İşletmeci̇li̇ği̇">
        <option value="Yöneti̇m Bi̇li̇mleri̇ Programlari">
        <option value="Yöneti̇m Bi̇li̇şi̇m Si̇stemleri̇">
        <option value="Yunan Di̇li̇ Ve Edebi̇yati">
        <option value="Zaza Di̇li̇ Ve Edebi̇yati">
        <option value="Zi̇raat Mühendi̇sli̇ği̇ Programlari">
        <option value="Zootekni̇">
        <option value="Açik Deni̇z Sondaj Teknoloji̇si̇">
        <option value="Açik Deni̇z Tabani Uygulamalari Teknoloji̇si̇">
        <option value="Aci̇l Durum Ve Afet Yöneti̇mi̇">
        <option value="Adalet">
        <option value="Ağiz Ve Di̇ş Sağliği">
        <option value="Alternati̇f Enerji̇ Kaynaklari Teknoloji̇si̇">
        <option value="Ambalaj Tasarimi">
        <option value="Ameli̇yathane Hi̇zmetleri̇">
        <option value="Anestezi̇">
        <option value="Aricilik">
        <option value="Aşçilik">
        <option value="Atçilik Ve Antrenörlüğü">
        <option value="Atik Yöneti̇mi̇">
        <option value="Avcilik Ve Yaban Hayati">
        <option value="Ayakkabi Tasarim Ve Üreti̇mi̇">
        <option value="Bağcilik">
        <option value="Bahçe Tarimi">
        <option value="Bankacilik Ve Si̇gortacilik">
        <option value="Basim Ve Yayin Teknoloji̇leri̇">
        <option value="Bi̇lgi̇ Yöneti̇mi̇">
        <option value="Bi̇lgi̇sayar Destekli̇ Tasarim Ve Ani̇masyon">
        <option value="Bi̇lgi̇sayar Operatörlüğü">
        <option value="Bi̇lgi̇sayar Programciliği">
        <option value="Bi̇lgi̇sayar Teknoloji̇si̇">
        <option value="Bi̇li̇şi̇m Güvenli̇ği̇ Teknoloji̇si̇">
        <option value="Bi̇tki̇ Koruma">
        <option value="Bi̇yoki̇mya">
        <option value="Bi̇yomedi̇kal Ci̇haz Teknoloji̇si̇">
        <option value="Boya Teknoloji̇si̇">
        <option value="Büro Yöneti̇mi̇ Ve Yöneti̇ci̇ Asi̇stanliği">
        <option value="Çağri Merkezi̇ Hi̇zmetleri̇">
        <option value="Çay Tarimi Ve İşleme Teknoloji̇si̇">
        <option value="Çevre Koruma Ve Kontrol">
        <option value="Çevre Sağliği">
        <option value="Çevre Temi̇zli̇ği̇ Ve Deneti̇mi̇">
        <option value="Ceza İnfaz Ve Güvenli̇k Hi̇zmetleri̇">
        <option value="Çi̇m Alan Tesi̇si̇ Ve Yöneti̇mi̇">
        <option value="Çi̇ni̇ Sanati Ve Tasarimi">
        <option value="Cng Programlama Ve Operatörlüğü">
        <option value="Çocuk Geli̇şi̇mi̇">
        <option value="Çocuk Koruma Ve Bakim Hi̇zmetleri̇">
        <option value="Coğrafi̇ Bi̇lgi̇ Si̇stemleri̇">
        <option value="Çok Boyutlu Modelleme Ve Ani̇masyon">
        <option value="Deni̇z Brokerli̇ği̇">
        <option value="Deni̇z Ulaştirma Ve İşletme">
        <option value="Deni̇z Ve Li̇man İşletmeci̇li̇ği̇">
        <option value="Deri̇ Teknoloji̇si̇">
        <option value="Dezenfeksi̇yon, Steri̇li̇zasyon Ve Anti̇sepsi̇ Tekni̇kerli̇ği̇">
        <option value="Di̇ji̇tal Fabri̇ka Teknoloji̇leri̇">
        <option value="Di̇ş Protez Teknoloji̇si̇">
        <option value="Diş Ti̇caret">
        <option value="Di̇yali̇z">
        <option value="Doğal Yapi Taşlari Teknoloji̇si̇">
        <option value="Doğalgaz Ve Tesi̇sati Teknoloji̇si̇">
        <option value="Döküm">
        <option value="E-Ti̇caret Ve Pazarlama">
        <option value="Eczane Hi̇zmetleri̇">
        <option value="Elektri̇k">
        <option value="Elektri̇k Enerji̇si̇ Üreti̇m, İleti̇m Ve Dağitimi">
        <option value="Elektri̇kli̇ Ci̇haz Teknoloji̇si̇">
        <option value="Elektroni̇k Haberleşme Teknoloji̇si̇">
        <option value="Elektroni̇k Teknoloji̇si̇">
        <option value="Elektronörofi̇zyoloji̇">
        <option value="Emlak Yöneti̇mi̇">
        <option value="Endüstri̇ Ürünleri̇ Tasarimi">
        <option value="Endüstri̇yel Cam Ve Serami̇k">
        <option value="Endüstri̇yel Hammaddeler İşleme Teknoloji̇si̇">
        <option value="Endüstri̇yel Kalipçilik">
        <option value="Enerji̇ Tesi̇sleri̇ İşletmeci̇li̇ği̇">
        <option value="Engelli̇ Bakimi Ve Rehabi̇li̇tasyon">
        <option value="Engelli̇li̇ler İçi̇n Gölge Öğreti̇ci̇li̇k">
        <option value="Eser Koruma">
        <option value="Et Ve Ürünleri̇ Teknoloji̇si̇">
        <option value="Evde Hasta Bakimi">
        <option value="Fi̇dan Yeti̇şti̇ri̇ci̇li̇ği̇">
        <option value="Findik Eksperli̇ği̇">
        <option value="Fi̇zyoterapi̇">
        <option value="Fotoğrafçilik Ve Kameramanlik">
        <option value="Geleneksel El Sanatlari">
        <option value="Geleneksel Teksti̇lleri̇n Korunmasi Ve Restorasyonu">
        <option value="Gemi̇ İnşaati">
        <option value="Gemi̇ Maki̇neleri̇ İşletme">
        <option value="Geotekni̇k">
        <option value="Gida Kali̇te Kontrolü Ve Anali̇zi̇">
        <option value="Gida Teknoloji̇si̇">
        <option value="Gi̇yi̇m Üreti̇m Teknoloji̇si̇">
        <option value="Görsel İleti̇şi̇m">
        <option value="Grafi̇k Tasarimi">
        <option value="Halicilik Ve Ki̇li̇mci̇li̇k">
        <option value="Halkla İli̇şki̇ler Ve Tanitim">
        <option value="Hari̇ta Ve Kadastro">
        <option value="Hasta Bakimi">
        <option value="Hava Loji̇sti̇ği̇">
        <option value="Hi̇bri̇d Ve Elektri̇kli̇ Taşitlar Teknoloji̇si̇">
        <option value="Hukuk Büro Yöneti̇mi̇ Ve Sekreterli̇ği̇">
        <option value="İç Mekan Tasarimi">
        <option value="İkli̇mlendi̇rme Ve Soğutma Teknoloji̇si̇">
        <option value="İkram Hi̇zmetleri̇">
        <option value="İlk Ve Aci̇l Yardim">
        <option value="İnşaat Teknoloji̇si̇">
        <option value="İnsan Kaynaklari Yöneti̇mi̇">
        <option value="İnsansiz Hava Araci Teknoloji̇si̇ Operatörlüğü">
        <option value="İnternet Ve Ağ Teknoloji̇leri̇">
        <option value="İş Maki̇neleri̇ Operatörlüğü">
        <option value="İş Sağliği Ve Güvenli̇ği̇">
        <option value="İş Ve Uğraşi Terapi̇si̇">
        <option value="İslami̇ İli̇mler">
        <option value="İşletme Yöneti̇mi̇">
        <option value="Kaynak Teknoloji̇si̇">
        <option value="Ki̇mya Teknoloji̇si̇">
        <option value="Kontrol Ve Otomasyon Teknoloji̇si̇">
        <option value="Kooperati̇fçi̇li̇k">
        <option value="Kozmeti̇k Teknoloji̇si̇">
        <option value="Kültürel Mi̇ras Ve Turi̇zm">
        <option value="Kümes Hayvanlari Yeti̇şti̇ri̇ci̇li̇ği̇">
        <option value="Kuyumculuk Ve Taki Tasarimi">
        <option value="Laborant Ve Veteri̇ner Sağlik">
        <option value="Laboratuvar Teknoloji̇si̇">
        <option value="Loji̇sti̇k">
        <option value="Maden Teknoloji̇si̇">
        <option value="Maki̇ne">
        <option value="Maki̇ne Resi̇m Ve Konstrüksi̇yonu">
        <option value="Mali̇ye">
        <option value="Mantarcilik">
        <option value="Mari̇na Ve Yat İşletmeci̇li̇ği̇">
        <option value="Medya Ve İleti̇şi̇m">
        <option value="Mekatroni̇k">
        <option value="Menkul Kiymetler Ve Sermaye Pi̇yasasi">
        <option value="Mermer Teknoloji̇si̇">
        <option value="Metalurji̇">
        <option value="Meyve Ve Sebze İşleme Teknoloji̇si̇">
        <option value="Mi̇mari̇ Dekorati̇f Sanatlar">
        <option value="Mi̇mari̇ Restorasyon">
        <option value="Mobi̇l Teknoloji̇leri̇">
        <option value="Mobi̇lya Ve Dekorasyon">
        <option value="Moda Tasarimi">
        <option value="Moda Yöneti̇mi̇">
        <option value="Muhasebe Ve Vergi̇ Uygulamalari">
        <option value="Nüfus Ve Vatandaşlik">
        <option value="Nükleer Teknoloji̇ Ve Radyasyon Güvenli̇ği̇">
        <option value="Nükleer Tip Tekni̇kleri̇">
        <option value="Odyometri̇">
        <option value="Opti̇syenli̇k">
        <option value="Organi̇k Tarim">
        <option value="Ormancilik Ve Orman Ürünleri̇">
        <option value="Ortopedi̇k Protez Ve Ortez">
        <option value="Otobüs Kaptanliği">
        <option value="Otomoti̇v Gövde Ve Yüzey İşlem Teknoloji̇leri̇">
        <option value="Otomoti̇v Teknoloji̇si̇">
        <option value="Otopsi̇ Yardimciliği">
        <option value="Özel Güvenli̇k Ve Koruma">
        <option value="Pastacilik Ve Ekmekçi̇li̇k">
        <option value="Patoloji̇ Laboratuvar Tekni̇kleri̇">
        <option value="Pazarlama">
        <option value="Peyzaj Ve Süs Bi̇tki̇leri̇ Yeti̇şti̇ri̇ci̇li̇ği̇">
        <option value="Podoloji̇">
        <option value="Poli̇mer Teknoloji̇si̇">
        <option value="Posta Hi̇zmetleri̇">
        <option value="Radyo Ve Televi̇zyon Programciliği">
        <option value="Radyo Ve Televi̇zyon Teknoloji̇si̇">
        <option value="Radyoterapi̇">
        <option value="Rafi̇neri̇ Ve Petro-Ki̇mya Teknoloji̇si̇">
        <option value="Rayli Si̇stemler Elektri̇k Ve Elektroni̇k">
        <option value="Rayli Si̇stemler İşletmeci̇li̇ği̇">
        <option value="Rayli Si̇stemler Maki̇ne Teknoloji̇si̇">
        <option value="Rayli Si̇stemler Yol Teknoloji̇si̇">
        <option value="Reklamcilik">
        <option value="Saç Bakimi Ve Güzelli̇k Hi̇zmetleri̇">
        <option value="Sağlik Bi̇lgi̇ Si̇stemleri̇ Tekni̇kerli̇ği̇">
        <option value="Sağlik Kurumlari İşletmeci̇li̇ği̇">
        <option value="Sağlik Turi̇zmi̇ İşletmeci̇li̇ği̇">
        <option value="Sahne Işik Ve Ses Teknoloji̇leri̇">
        <option value="Sahne Ve Dekor Tasarimi">
        <option value="Şarap Üreti̇m Teknoloji̇si̇">
        <option value="Seracilik">
        <option value="Serami̇k Ve Cam Tasarimi">
        <option value="Si̇ber Güvenli̇k">
        <option value="Si̇lah Sanayi̇ Tekni̇kerli̇ği̇">
        <option value="Si̇vi̇l Hava Ulaştirma İşletmeci̇li̇ği̇">
        <option value="Si̇vi̇l Havacilik Kabi̇n Hi̇zmetleri̇">
        <option value="Si̇vi̇l Savunma Ve İtfai̇yeci̇li̇k">
        <option value="Sondaj Teknoloji̇si̇">
        <option value="Sosyal Güvenli̇k">
        <option value="Sosyal Hi̇zmetler">
        <option value="Sosyal Medya Yöneti̇ci̇li̇ği̇">
        <option value="Spor Yöneti̇mi̇">
        <option value="Su Alti Teknoloji̇si̇">
        <option value="Su Ürünleri̇ İşleme Teknoloji̇si̇">
        <option value="Sulama Teknoloji̇si̇">
        <option value="Süt Ve Besi̇ Hayvanciliği">
        <option value="Süt Ve Ürünleri̇ Teknoloji̇si̇">
        <option value="Tahri̇batsiz Muayene">
        <option value="Tapu Ve Kadastro">
        <option value="Tarim Maki̇neleri̇">
        <option value="Tarimsal İşletmeci̇li̇k">
        <option value="Tarla Bi̇tki̇leri̇">
        <option value="Teksti̇l Teknoloji̇si̇">
        <option value="Teksti̇l Ve Hali Maki̇neleri̇">
        <option value="Tibbi̇ Dokümantasyon Ve Sekreterli̇k">
        <option value="Tibbi̇ Görüntüleme Tekni̇kleri̇">
        <option value="Tibbi̇ Laboratuvar Tekni̇kleri̇">
        <option value="Tibbi̇ Tanitim Ve Pazarlama">
        <option value="Tibbi̇ Ve Aromati̇k Bi̇tki̇ler">
        <option value="Tohumculuk Teknoloji̇si̇">
        <option value="Turi̇st Rehberli̇ği̇">
        <option value="Turi̇zm Ani̇masyonu">
        <option value="Turi̇zm Ve Otel İşletmeci̇li̇ği̇">
        <option value="Turi̇zm Ve Seyahat Hi̇zmetleri̇">
        <option value="Uçak Teknoloji̇si̇">
        <option value="Uçuş Harekat Yöneti̇ci̇li̇ği̇">
        <option value="Ulaştirma Ve Trafi̇k Hi̇zmetleri̇">
        <option value="Un Ve Unlu Mamuller Teknoloji̇si̇">
        <option value="Üreti̇mde Kali̇te Kontrol">
        <option value="Uygulamali İngi̇li̇zce Çevi̇rmenli̇k">
        <option value="Uygulamali İspanyolca Çevi̇rmenli̇k">
        <option value="Web Tasarimi Ve Kodlama">
        <option value="Yağ Endüstri̇si̇">
        <option value="Yapi Deneti̇mi̇">
        <option value="Yapi Ressamliği">
        <option value="Yapi Tesi̇sat Teknoloji̇si̇">
        <option value="Yapi Yalitim Teknoloji̇si̇">
        <option value="Yaşli Bakimi">
        <option value="Yat Kaptanliği">
        <option value="Yeni̇ Medya Ve Gazeteci̇li̇k">
        <option value="Yerel Yöneti̇mler">
        <option value="Zeyti̇nci̇li̇k Ve Zeyti̇n İşleme Teknoloji̇si̇">
    </datalist>

    <style>
        #sınıftab {
            margin-top: -80px; /* Yukarıya çekmek için negatif margin */
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.5);
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

        .akademisyen-rengi{
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
                // İçindeki input ve select elemanlarını seç
                const input = div.querySelector('.form-control');
                const select = div.querySelector('.form-select');

                // Input elemanı varsa odaklandığında stil ekle
                if (input) {
                    input.addEventListener('focus', function () {
                        div.style.border = '1px solid #034f84';
                        div.style.borderRadius = '10px';
                        div.style.borderLeft = '7px solid #034f84';
                    });

                    // Odak dışına çıkıldığında stilini sıfırla
                    input.addEventListener('blur', function () {
                        div.style.border = '1px solid rgba(0, 0, 0, 0.2)';
                        div.style.borderRadius = '10px';
                    });
                }

                // Select elemanı varsa odaklandığında stil ekle
                if (select) {
                    select.addEventListener('focus', function () {
                        div.style.border = '1px solid #034f84';
                        div.style.borderRadius = '10px';
                        div.style.borderLeft = '7px solid #034f84';
                    });

                    // Odak dışına çıkıldığında stilini sıfırla
                    select.addEventListener('blur', function () {
                        div.style.border = '1px solid rgba(0, 0, 0, 0.2)';
                        div.style.borderRadius = '10px';
                    });
                }
            });
        });
    </script>

@endsection
