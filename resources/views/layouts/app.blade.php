<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', ($pengaturan['nama_sekolah'] ?? 'SMP AL AHMAD KRIAN'))</title>
    <meta name="description" content="{{ $pengaturan['deskripsi'] ?? 'Website resmi sekolah' }}">
    <link rel="icon" type="image/png" href="{{ $pengaturan['logo_url'] ?? asset('assets/img/logo.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/app-extra.css') }}">
    @stack('styles')
</head>
<body class="@yield('body-class', '')">
    @include('layouts.partials.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <script src="{{ asset('assets/script.js') }}"></script>
    @stack('scripts')
</body>
</html>
