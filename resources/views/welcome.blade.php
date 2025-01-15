<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Primary SEO Meta Tags -->
    <meta name="description"
        content="Equitify Trades LC is a leading AI-driven trading and investment company. Maximize your returns with advanced AI algorithms and automated trading bots. Join us for secure and profitable investments." />
    <meta name="keywords"
        content="AI trading, automated trading, investment platform, crypto trading, stock trading, AI investment, secure trading, high returns, automated bots, Equitify Trades" />

    <!-- Favicon and Icons -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/logo.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('assets/img/logo.png') }}" />

    <title>Equitify Trades LC | AI-Driven Trading & Investments</title>

    <!-- Social Media / Open Graph Tags -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Equitify Trades LC | AI-Driven Trading & Investments" />
    <meta property="og:description"
        content="Discover a smarter way to trade and invest. Equitify Trades LC uses AI-powered trading and automated bots for consistent profits and secure investments. Join today." />
    <meta property="og:image" content="{{ asset('assets/img/logo.png') }}" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:url" content="https://www.equitifytrades.com" />
    <meta property="og:site_name" content="Equitify Trades LC" />

    <!-- Schema.org / Google Structured Data -->
    <meta itemprop="name" content="Equitify Trades LC | AI-Driven Trading & Investments" />
    <meta itemprop="description"
        content="Equitify Trades LC is a cutting-edge trading company using AI and automation for optimal investment strategies and high returns." />
    <meta itemprop="image" content="{{ asset('assets/img/logo.png') }}" />

    <!-- Mobile Optimization -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="Equitify Trades LC | AI Investments" />

    <!-- Additional Meta Tags -->
    <meta name="robots" content="index, follow" />
    <meta name="author" content="Equitify Trades" />
    <meta name="theme-color" content="#0044cc" />
    <script src="https://www.google.com/recaptcha/api.js?render=explicit" async defer></script>

    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="assets/img/logo.png">
    <!--icofont icon css-->
    <link rel="stylesheet" href="assets/css/icofont.min.css">
    <!--magnific popup css-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!--animated headline css-->
    <link rel="stylesheet" href="./assets/css/animated-headline.css">
    <!--google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <!--main css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <style>
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #ffffff;
        /* Background color while loading */
        background-image: url('/assets/img/preloder.gif');
        background-repeat: no-repeat;
        background-position: center;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    </style>
    <!--Start Preloader-->
    <div class="preloader" id="preloader"
        style="background-image: url(/assets/img/preloder.gif) no-repeat 50% !important"></div>
    <!--End Preloader-->
    <div id="app"></div>
</body>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- The Captcha -->
<script src="https://js.hcaptcha.com/1/api.js" async defer></script>

<!-- The Tido -->
<script src="//code.tidio.co/8qzi9njq6nkeeus10esgfv7ricxyjadv.js" async></script>
<!-- The end of Tido -->

<script src="assets/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"
    integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

</html>
