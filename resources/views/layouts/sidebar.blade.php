<style>
    body {
        font-family: "Roboto", "Helvetica", "Arial", sans-serif;
    }
    .sidebar {
        height: 100vh;
        background: url('{{ asset("images/sidebar-1.jpg") }}') no-repeat center center;
        background-size: cover;
        position: relative;
        color: white;
        padding-top: 20px;
    }
    .sidebar::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8); /* Siyah katman */
        z-index: 1;
    }
    .sidebar .nav-link {
        color: white;
        padding: 15px;
        padding-left: 30px;
        position: relative;
        z-index: 2; /* Linkler üstte kalması için */
        border-radius: 5px;
        transition: all 0.2s ease-in-out;
        font-size: 1.3rem; /* Nav link yazı boyutunu büyüttük */
    }
    .sidebar .nav-link:not(.active):hover {
        background-color: rgba(0, 0, 0, 0.4);
        color: white;
    }

    .sidebar .active {
        color: white;
    }

    .sidebar .nav-item + .nav-item {
        margin-top: 10px;
    }
    .sidebar h4 {
        font-size: 1.2rem;
        margin: 0;
    }

    .primary-active-overlay {
        box-shadow: 0 8px 15px rgba(3, 79, 132, 0.5); /* Işık efekti */
    }

    .secondary-active-overlay {
        box-shadow: 0 8px 15px rgba(156, 39, 176, 0.7); /* Işık efekti */
    }

    .success-active-overlay {
        box-shadow: 0 8px 15px rgba(76, 175, 80, 0.5); /* Işık efekti */
    }

    .info-active-overlay {
        box-shadow: 0 8px 15px rgba(0, 188, 212, 0.5); /* Işık efekti */
    }

    .warning-active-overlay {
        box-shadow: 0 8px 15px rgba(255, 152, 0, 0.5); /* Işık efekti */
    }

    .danger-active-overlay {
        box-shadow: 0 8px 15px rgba(244, 67, 54, 0.5); /* Işık efekti */
    }

    .light-active-overlay {
        box-shadow: 0 8px 15px rgba(248, 249, 250, 0.5); /* Işık efekti */
    }

    .dark-active-overlay {
        box-shadow: 0 8px 15px rgba(52, 58, 64, 0.5); /* Işık efekti */
    }

    .profile-section {
        position: relative;
        z-index: 2; /* Fotoğrafı daha önde göstermek için */
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }
    .profile-section img {
        z-index: 3; /* Fotoğrafı daha önde göstermek için */
        width: 80px;
        height: 80px;
        object-fit: cover;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9); /* Gölge ekledik */
    }
    .profile-section .name {
        margin-left: 10px;
    }

    /* Responsive ayarlar */
    @media (max-width: 768px) {
        .sidebar {
            height: auto;
            padding-top: 10px;
            padding-left: 5px;
            padding-right: 5px;
        }

        .sidebar .nav-link {
            padding: 10px;
            font-size: 1rem;
            text-align: center;
            padding-left: 0;
        }

        .sidebar .nav-link span {
            display: none;
        }

        .sidebar .nav-link i {
            font-size: 2rem; /* Küçük ekranlarda ikon boyutunu daha da büyütüyoruz */
        }

        .profile-section img {
            width: 60px;
            height: 60px;
            margin-bottom: 15px;
        }

        .profile-section h4 {
            display: none;
        }

        .sidebar h4 {
            font-size: 1rem;
            text-align: center;
        }

        .nav {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .nav-item {
            flex: 1;
            text-align: center;
            min-width: 80px;
        }

        .nav-link {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    }

    @media (max-width: 576px) {
        .sidebar {
            width: 100%;
            height: auto;
        }

        .sidebar .nav-link {
            font-size: 0.9rem;
        }

        .profile-section {
            margin-bottom: 10px;
            padding-bottom: 10px;
        }
    }
</style>

<div class="col-2 sidebar">
    <div class="text-center profile-section d-flex align-items-center justify-content-center">
        <img src="{{ asset('images/profil.jpg') }}" alt="Profil Fotoğrafı" class="rounded-circle shadow">
        <div class="d-flex flex-column">
            <h4 class="ms-3 d-none d-md-block pt-3">Bilal Çağrı ALĞAN</h4> <!-- Yalnızca orta boyut ve üzeri ekranlarda görünür -->
            <h5 class="text-warning mt-2"><b>Öğrenci</b></h5>
        </div>
    </div>
    <ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('home') ? 'active info-active-overlay bg-info' : '' }}  d-flex align-items-center" href="{{ route('home') }}">
            <i class="bi bi-grid-fill"></i>
            <span class="ms-3 d-none d-md-inline">Anasayfa</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('classes') ? 'active primary-active-overlay bg-primary' : '' }} d-flex align-items-center" href="{{ route('classes') }}">
            <i class="bi bi-house-check"></i>
            <span class="ms-3 d-none d-md-inline">Salonlar</span>
        </a>
    </li>

        <li class="nav-item">
            <a class="nav-link d-flex align-items-center {{ request()->routeIs('lessons') ? 'active secondary-active-overlay bg-secondary' : '' }}" href="{{ route('lessons') }}">
                <i class="bi bi-book"></i>
                <span class="ms-3 d-none d-md-inline">Dersler</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="#">
                <i class="bi bi-people"></i>
                <span class="ms-3 d-none d-md-inline">Akademisyen</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="#">
                <i class="bi bi-journal-text"></i>
                <span class="ms-3 d-none d-md-inline">Sınavlar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="#">
                <i class="bi bi-calendar-check"></i>
                <span class="ms-3 d-none d-md-inline">Ders Programı</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="#">
                <i class="bi bi-gear"></i>
                <span class="ms-3 d-none d-md-inline">Ayarlar</span>
            </a>
        </li>
    </ul>
</div>
