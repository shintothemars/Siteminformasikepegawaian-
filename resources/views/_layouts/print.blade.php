<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>WorkSync</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        h1, h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
        }
        th {
            text-align: center;
        }
        td {
            text-align: left;
        }
        .header, .footer {
            text-align: center;
            font-size: 12px;
        }
        .no-print {
            display: none;
        }
        .profile-photo {
            display: block;
            margin: 0 auto;
            max-width: 150px;
            max-height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body onload="window.print()" onafterprint="window.history.back()">
    @yield('content')
</body>
</html>