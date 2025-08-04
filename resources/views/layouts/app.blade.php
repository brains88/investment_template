<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- CSS and JS links -->
    @include('layouts.header')
</head>

<body>
    <div class="wrapper">
        @include('layouts.usernavbar')

        @yield('content')
        <!-- This is where your page content will go -->
    </div>

    @include('layouts.footer')
    <!-- If you have one -->

    @stack('scripts')
    @stack('styles')
</body>