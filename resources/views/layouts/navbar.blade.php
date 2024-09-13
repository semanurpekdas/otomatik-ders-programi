<style>
        .navbar {
            background: url('{{ asset("images/navbar.jpg") }}') no-repeat center center;
            background-size: cover;
            position: relative;
        }
        .navbar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8); /* Siyah Katman */
            z-index: 1;
        }
        .navbar .container-fluid {
            position: relative;
            z-index: 2;
        }
        .dropdown-toggle {
            box-shadow: 0 4px 15px rgba(0, 172, 193, 0.7); /* Işık efekti */
        }

        .dropdown-menu {
            box-shadow: 0 4px 15px rgba(0, 172, 193, 0.3); /* Işık efekti */
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-light w-100">
        <div class="container-fluid">
            <!-- Sol Taraftaki Yatay Fotoğraf -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.jpg') }}" class="object-fit-cover border rounded" alt="Logo" height="94">
            </a>

            <!-- Sağ Taraftaki Dropdown -->
            <div class="dropdown ms-auto">
                <button class="btn btn-warning dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('images/profil.jpg') }}" alt="Profil Fotoğrafı" class="rounded-circle object-fit-cover " width="40" height="40">
                    <span class="ms-2">Bilal Çağrı ALĞAN</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('admin.university') }}"><i class="bi bi-person-vcard me-2"></i> Admin Universiteler</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.fakulteler') }}"><i class="bi bi-person-vcard me-2"></i> Admin Fakülteler</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi bi-person me-2"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>