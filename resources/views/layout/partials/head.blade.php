<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- CSS here -->
    <link rel="stylesheet" href={{ asset('assets/css/bootstrap.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/owl.carousel.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/ticker-style.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/flaticon.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/slicknav.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/animate.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/magnific-popup.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/fontawesome-all.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/themify-icons.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/slick.css') }}>
    {{-- <link rel="stylesheet" href={{ asset('assets/css/nice-select.css') }}> --}}
    <link rel="stylesheet" href={{ asset('assets/css/style.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/responsive.css') }}>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @vite('resources/js/app.js')

</head>
