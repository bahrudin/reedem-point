<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Fonts -->
    @stack('styles')
    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
<!-- Primary Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    @include('layouts.partials.logo')
</nav>

<!-- Secondary Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient">
    @include('layouts.partials.navigation')
</nav>

<!-- Page Content -->
<main class="container py-3">
    {{ $slot }}
</main>

<div class="container-fluid my-5">
    @include('layouts.partials.footer')
</div>

@stack('scripts')
</body>
</html>
