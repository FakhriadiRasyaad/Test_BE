<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Kursus - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">Katalog Kursus</a>
            <div class="navbar-nav ms-auto">
                @auth
                    @if(auth()->user()->role === 'ADMIN')
                        <a class="nav-link" href="/admin/dashboard">Dashboard Admin</a>
                    @endif
                    <a class="nav-link" href="/logout">Logout ({{ auth()->user()->name }})</a>
                @else
                    <a class="nav-link" href="/login">Login</a>
                    <a class="nav-link" href="/register">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.botpress.cloud/webchat/v3.6/inject.js"></script>
    <script src="https://files.bpcontent.cloud/2026/02/20/08/20260220081449-S645Q0KI.js" defer></script>
</body>
</html>