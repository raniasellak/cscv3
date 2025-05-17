<!DOCTYPE html>
<html lang="fr">
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- NAVBAR USER, STYLES, etc. --}}
</head>
<body>

    @yield('content')
    
</body>
</html>
