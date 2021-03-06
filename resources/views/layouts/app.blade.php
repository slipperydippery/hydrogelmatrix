<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
          rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
</head>
<body class="font-sans leading-tight">
    <div id="app" class="bg-gray-200">

        @include('layouts.partials.nav')

        <main class="">
            @yield('content')
        </main>

        @include('layouts.partials.footer')

        <portal-target name="card">
        </portal-target>
        <portal-target name="deck">
        </portal-target>
        <portal-target name="profile">
        </portal-target>
    </div>

    {{-- scripts  --}}
    @yield('additional-scripts')
</body>
</html>
