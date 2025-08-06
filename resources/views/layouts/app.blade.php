<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    @include('layouts.header')
</head>

<body>
    <div class="wrapper">
        @if(Auth::check() && Auth::user()->role === 'admin')
            @include('layouts.adminnavbar')
        @elseif(Auth::check() && Auth::user()->role === 'user')
            @include('layouts.usernavbar')
        @endif

        @yield('content')
    </div>

    @include('layouts.footer')
    @stack('scripts')
    @stack('styles')
</body>
</html>
