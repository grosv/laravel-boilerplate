<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>
    @livewireStyles
    <script src="https://kit.fontawesome.com/10061d64d6.js" crossorigin="anonymous"></script>
</head>
<body class="bg-{{ config('theme.color', 'gray') }}-100 h-screen antialiased leading-none">



@include('layouts.' . config('theme.app_layout', 'droopy'));



<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
@livewireScripts
</body>
</html>
