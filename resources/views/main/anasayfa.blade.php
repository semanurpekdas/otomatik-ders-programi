@extends('layout')

@section('title', 'Anasayfa')
 
@section('content')

    <div class="px-5 mt-5">
        <div class="d-flex">
            <!-- Card 1 -->
            <div class="col me-3">
                <a href="{{ route('sınıflar.index') }}">
                    <div class="card" style="width: 100%; position: relative;">
                        <img src="{{ asset('images/sınıf.jpg') }}" class="card-img-top" alt="sınıf">
                        <div class="card-img-overlay d-flex align-items-center justify-content-center primary-overlay">
                            <h5 class="card-title text-white"><i class="bi bi-house-check"></i> Salonlar</h5>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Card 2 -->
            <div class="col me-3">
                <a href="{{ route('dersler') }}">
                    <div class="card" style="width: 100%; position: relative;">
                        <img src="{{ asset('images/dersler.jpg') }}" class="card-img-top" alt="sınıf">
                        <div class="card-img-overlay d-flex align-items-center justify-content-center secondary-overlay">
                            <h5 class="card-title text-white"><i class="bi bi-book"></i> Dersler</h5>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Card 3 -->
            <div class="col me-3">
                <a href="{{ route('akademisyenler') }}">
                    <div class="card" style="width: 100%; position: relative;">
                        <img src="{{ asset('images/hocalar.jpg') }}" class="card-img-top" alt="sınıf">
                        <div class="card-img-overlay d-flex align-items-center justify-content-center success-overlay">
                            <h5 class="card-title text-white"><i class="bi bi-people"></i> Akademisyen</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="d-flex mt-5">
            <!-- Card 1 -->
            <div class="col me-3">
                <a href="#">
                    <div class="card" style="width: 100%; position: relative;">
                        <img src="{{ asset('images/sınavlar.jpg') }}" class="card-img-top" alt="sınıf">
                        <div class="card-img-overlay d-flex align-items-center justify-content-center warning-overlay">
                            <h5 class="card-title text-white"><i class="bi bi-journal-text"></i> Sınavlar</h5>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Card 2 -->
            <div class="col me-3">
                <a href="#">
                    <div class="card" style="width: 100%; position: relative;">
                        <img src="{{ asset('images/dersprogramı.jpg') }}" class="card-img-top" alt="sınıf">
                        <div class="card-img-overlay d-flex align-items-center justify-content-center dark-overlay">
                            <h5 class="card-title text-white"><i class="bi bi-calendar-check"></i> Ders Programı</h5>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Card 3 -->
            <div class="col me-3">
                <a href="#">
                    <div class="card" style="width: 100%; position: relative;">
                        <img src="{{ asset('images/ayarlar.jpg') }}" class="card-img-top" alt="sınıf">
                        <div class="card-img-overlay d-flex align-items-center justify-content-center info-overlay">
                            <h5 class="card-title text-white"><i class="bi bi-gear"></i> Ayarlar</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
<style>
    .card {
        transition: box-shadow 0.3s ease, transform 0.3s ease; /* Animasyon ekledik */
    }

    .card-img-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
        background-color: rgba(0, 0, 0, 0.6); /* Sabit siyah tabaka */
        transition: box-shadow 0.3s ease, transform 0.3s ease; /* Animasyon ekledik */
    }

    .primary-overlay {
        box-shadow: 0 8px 15px rgba(3, 79, 132, 0.9); /* Işık efekti */
    }

    .secondary-overlay {
        box-shadow: 0 8px 15px rgba(156, 39, 176, 0.9); /* Işık efekti */
    }

    .success-overlay {
        box-shadow: 0 8px 15px rgba(76, 175, 80, 0.9); /* Işık efekti */
    }

    .info-overlay {
        box-shadow: 0 8px 15px rgba(0, 188, 212, 0.9); /* Işık efekti */
    }

    .warning-overlay {
        box-shadow: 0 8px 15px rgba(255, 152, 0, 0.9); /* Işık efekti */
    }

    .danger-overlay {
        box-shadow: 0 8px 15px rgba(244, 67, 54, 0.9); /* Işık efekti */
    }

    .light-overlay {
        box-shadow: 0 8px 15px rgba(248, 249, 250, 0.9); /* Işık efekti */
    }

    .dark-overlay {
        box-shadow: 0 8px 15px rgba(52, 58, 64, 0.9); /* Işık efekti */
    }

    .card-title {
        z-index: 2; /* Yazı üstte kalması için */
        font-size: 2rem;
    }

    .card:hover {
        transform: translateY(-20px);  /* Hover durumunda küçük bir büyütme efekti */
    }

    .card:hover .primary-overlay {
        box-shadow: 0 12px 20px rgba(3, 79, 132, 1); /* Hover durumunda daha belirgin ışık efekti */
    }

    .card:hover .secondary-overlay {
        box-shadow: 0 12px 20px rgba(156, 39, 176, 1); /* Hover durumunda daha belirgin ışık efekti */
    }

    .card:hover .success-overlay {
        box-shadow: 0 12px 20px rgba(76, 175, 80, 1); /* Hover durumunda daha belirgin ışık efekti */
    }

    .card:hover .info-overlay {
        box-shadow: 0 12px 20px rgba(0, 188, 212, 1); /* Hover durumunda daha belirgin ışık efekti */
    }

    .card:hover .warning-overlay {
        box-shadow: 0 12px 20px rgba(255, 152, 0, 1); /* Hover durumunda daha belirgin ışık efekti */
    }

    .card:hover .danger-overlay {
        box-shadow: 0 12px 20px rgba(244, 67, 54, 1); /* Hover durumunda daha belirgin ışık efekti */
    }

    .card:hover .light-overlay {
        box-shadow: 0 12px 20px rgba(248, 249, 250, 1); /* Hover durumunda daha belirgin ışık efekti */
    }

    .card:hover .dark-overlay {
        box-shadow: 0 12px 20px rgba(52, 58, 64, 1); /* Hover durumunda daha belirgin ışık efekti */
    }

</style>

@endsection
