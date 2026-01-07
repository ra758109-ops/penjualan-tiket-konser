<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - KPOP TIX</title>

    {{-- FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- CSS ADMIN --}}
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f3f4f6;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 250px;
            background: #1f2937;
            color: #fff;
            padding: 20px;
        }

        .admin-logo {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #9333ea;
        }

        .admin-nav a {
            display: block;
            color: #e5e7eb;
            text-decoration: none;
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 6px;
        }

        .admin-nav a:hover,
        .admin-nav a.active {
            background: #9333ea;
            color: #fff;
        }

        .logout-btn {
            margin-top: 20px;
            background: none;
            border: none;
            color: #f87171;
            cursor: pointer;
        }

        .admin-content {
            flex: 1;
            padding: 30px;
        }
    </style>
</head>
<body>

<div class="admin-wrapper">

    {{-- SIDEBAR DIPISAH --}}
    <x-sidebar/>

    {{-- ISI HALAMAN --}}
    <div class="admin-content">
        {{ $slot }}
    </div>

</div>

</body>
</html>
