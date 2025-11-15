<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Şifreyi Sıfırla</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: "Roboto", "Helvetica", "Arial", sans-serif;
            background: url('{{ asset("images/navbar.jpg") }}') no-repeat center center fixed;
            background-size: cover;
        }

        /* Siyah Katman */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1;
        }

        .card-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .card {
            display: flex;
            flex-direction: row;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 80%;
            max-width: 800px;
        }

        .card-left {
            flex: 1;
            background: url('{{ asset('images/logo.jpg') }}') no-repeat center center;
            background-size: contain;
            min-height: 300px;
        }

        .card-right {
            flex: 1;
            padding: 40px;
        }

        form i {
            font-size: 1.3rem;
        }

        form .mb-3 {
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            transition: all 0.2s ease-in-out;
        }

        form .mb-3:hover {
            border: 1px solid #4caf50;
            border-radius: 10px;
            border-left: 7px solid #4caf50;
        }

        .form-control {
            font-size: 1.1rem;
            border: none;
            outline: none;
            box-shadow: none;
            letter-spacing: 0.1rem;
        }

        .form-control:focus {
            outline: none;
            box-shadow: none;
        }

        .alert {
            display: none;
            margin-bottom: 20px;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</head>
<body>
<div class="container-fluid card-container">
    <div class="card">
        <!-- Logo kısmı -->
        <div class="card-left bg-light border-end"></div>

        <!-- Form kısmı -->
        <div class="card-right">
            <h3 class="mb-4 text-center text-primary">Şifreyi Sıfırla</h3>

            <!-- Success message -->
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Error message -->
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form id="password-reset-form" method="POST" action="{{ route('password.update') }}">
                @csrf
                <!-- Gizli token ve email alanı -->
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="form-group mb-3 d-flex ps-3 d-flex align-items-center pe-2">
                    <i class="bi bi-lock me-1"></i>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Yeni şifre" required autofocus>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-3 d-flex ps-3 d-flex align-items-center pe-2">
                    <i class="bi bi-lock me-1"></i>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Şifreyi onayla" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100">Şifreyi Sıfırla</button>
                </div>
            </form>

            <div class="mt-3 d-flex justify-content-between align-items-center">
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Alert göstermek için JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Eğer status mesajı varsa, alert kutusunu göster
        var statusMessage = "{{ session('status') }}";
        if (statusMessage) {
            document.querySelector('.alert-success').style.display = 'block';
        }

        var errorMessage = "{{ $errors->any() }}";
        if (errorMessage) {
            document.querySelector('.alert-danger').style.display = 'block';
        }
    });
</script>

</body>
</html>
