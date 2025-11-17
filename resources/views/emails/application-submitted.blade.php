<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        .container {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table td {
            padding: 6px;
            border-bottom: 1px solid #eee;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="title">Permohonan Pinjaman Peralatan Anda Telah Dihantar</div>

        <p>Hai <strong>{{ $application->applicant_name }}</strong>,</p>
        <p>Berikut adalah butiran permohonan pinjaman peralatan anda:</p>

        <div class="section-title">Maklumat Permohonan</div>
        <table class="table">
            <tr>
                <td><strong>Nama</strong></td>
                <td>{{ $application->applicant_name }}</td>
            </tr>
            <tr>
                <td><strong>No Matrik</strong></td>
                <td>{{ $application->applicant_matric_no }}</td>
            </tr>
            <tr>
                <td><strong>Sektor</strong></td>
                <td>{{ $application->applicant_sector }}</td>
            </tr>
            <tr>
                <td><strong>Tarikh Pinjam</strong></td>
                <td>
                    {{ \Carbon\Carbon::parse($application->date_borrow)->format('d-m-Y') }}
                    ({{ \Carbon\Carbon::parse($application->time_borrow)->format('h:i A') }})
                </td>
            </tr>

            <tr>
                <td><strong>Tarikh Pulang</strong></td>
                <td>
                    {{ \Carbon\Carbon::parse($application->date_return)->format('d-m-Y') }}
                    ({{ \Carbon\Carbon::parse($application->time_return)->format('h:i A') }})
                </td>
            </tr>

        </table>

        <div class="section-title">Senarai Peralatan Dipinjam</div>
        <ul>
            @foreach ($equipmentList as $equip)
            <li>{{ $equip->name }}</li>
            @endforeach
        </ul>

        <p style="margin-top: 20px;">
            ❗ <strong>Ingat!</strong> Semua peralatan perlu dipulangkan <strong>sebelum tarikh & masa pulang</strong>
            seperti dinyatakan di atas.
        </p>

        <div class="footer">
            Emel ini dijana secara automatik. Sila abaikan jika anda tidak membuat permohonan ini.
        </div>
    </div>
</body>

</html>