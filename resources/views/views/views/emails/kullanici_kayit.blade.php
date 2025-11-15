<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-posta Doğrulama</title>
    <style>
        /* Genel stiller */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            color: #333;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        .email-header {
            background-color: #4CAF50;
            padding: 20px;
            text-align: center;
        }

        .email-header img {
            width: 150px;
            height: auto;
        }

        .email-body {
            padding: 20px;
        }

        .email-body h1 {
            font-size: 24px;
            margin-top: 0;
        }

        .email-body p {
            font-size: 16px;
            line-height: 1.5;
        }

        .email-footer {
            background-color: #f9f9f9;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }

        .email-footer a {
            color: #4CAF50;
            text-decoration: none;
        }

        .btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 25px;
            margin: 20px 0;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Logo ve Başlık -->
        <div class="email-header">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo">
        </div>

        <!-- E-posta İçeriği -->
        <div class="email-body">
            <h1>Merhaba, {{ $isim }}!</h1>
            <p>Kayıt işleminizi başarıyla tamamladınız. Lütfen aşağıdaki butona tıklayarak e-posta adresinizi doğrulayın.</p>
            <a href="{{ $url }}" class="btn">E-postanızı doğrulayın</a>
            <p>Teşekkür ederiz, iyi günler dileriz!</p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>Bu e-posta otomatik olarak gönderilmiştir, yanıtlamayın.</p>
            <p>Herhangi bir sorunuz varsa <a href="mailto:bilalcagrialgan@gmail.com">destek ekibimize</a> ulaşabilirsiniz.</p>
        </div>
    </div>
</body>
</html>
