<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="@yield('canonical', url()->current())" />
    <title>@yield('title', 'Udyantra')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/image/favicon.png') }}"> 
    <meta name="description" content="@yield('description', 'Default meta description')">
    
    <meta property="og:title" content="@yield('title', 'Udyantra')" />
    <meta property="og:site_name" content="Udyantra" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:description" content="@yield('description', 'Udyantra platform')" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset('assets/image/Udyantra-logo.svg') }}" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('title', 'Udyantra')" />
    <meta name="twitter:description" content="@yield('description', 'Udyantra platform')" />
    <meta name="twitter:image" content="{{ asset('assets/image/Udyantra-logo.svg') }}" />
    <meta name="twitter:image:alt" content="Udyantra Career Assessment Platform" />
    
  
    @yield('css')
    @yield('schema')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body class="font-sans min-h-screen w-full">

    @include('partials.header')
    <main>
        @yield('content')
    </main>
    @include('partials.footer')
    @include('partials.toast-script')
   
</body>
</html>