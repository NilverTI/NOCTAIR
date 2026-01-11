<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('img/logo-noctair.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/logo-noctair.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo-noctair-180.png') }}">

    <title>NOCTAIR | Perfumes con presencia</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome (WhatsApp icon) --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-[#05060a] text-white antialiased">
    @yield('content')
</body>
</html>
