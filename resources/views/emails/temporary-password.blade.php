<!DOCTYPE html>
<html lang="ms">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kata Laluan Sementara</title>

    <style>
        body {
            background: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-color: #fafafa;
        }

        .header {
            background: #0d6efd;
            padding: 20px;
            color: #ffffff;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        .content {
            padding: 25px;
            font-size: 16px;
            color: #333333;
            line-height: 1.6;
        }

        .password-box {
            background: #f1f1f1;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin: 20px 0;
            border-radius: 8px;
            border-left: 5px solid #0d6efd;
            letter-spacing: 1px;
        }

        .footer {
            padding: 15px;
            background: #fafafa;
            text-align: center;
            font-size: 14px;
            color: #666666;
        }
    </style>
</head>

<body>

    <div class="email-container">

        <div class="header">
            Reset Kata Laluan
        </div>

        <div class="content">
            <p>Hai <strong>{{ $user->fullname ?? 'Pengguna' }}</strong>,</p>

            <p>Kami telah menjana <strong>kata laluan sementara</strong> untuk akaun anda.</p>

            <p>Sila gunakan kata laluan berikut untuk log masuk:</p>

            <div class="password-box">
                {{ $password }}
            </div>

            <p>
                Demi keselamatan, sila <strong>tukar kata laluan</strong> anda selepas berjaya log masuk.
            </p>
        </div>

        <div class="footer">
            Sistem e-SportHub © {{ date('Y') }}
        </div>

    </div>

</body>

</html>