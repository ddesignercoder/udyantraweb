<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Udyantra') - Udyantra</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/image/favicon.png') }}"> 
    @yield('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans min-h-screen w-full">
   {{-- @include('partials.header') --}}
    <main>
        @yield('content')
    </main>
   {{--    @include('partials.footer') --}}
    @include('partials.toast-script')
</body>
</html>