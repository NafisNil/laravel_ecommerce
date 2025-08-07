<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Yoga Studio Template">
    <meta name="keywords" content="Yoga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Violet | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('frontend')}}/css/bootstrap.min.css" type="text/css">

    <link rel="stylesheet" href="{{asset('frontend')}}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    
    @include('frontend.layouts.header')
    <!-- Header Info End -->
    <!-- Header End -->
    @yield('content')

    @include('frontend.layouts.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->

    <script src="{{asset('frontend')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{asset('frontend')}}/js/bootstrap.min.js"></script>

    <script src="{{asset('frontend')}}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{asset('frontend')}}/js/jquery.slicknav.js"></script>
    <script src="{{asset('frontend')}}/js/owl.carousel.min.js"></script>
    <script src="{{asset('frontend')}}/js/jquery.nice-select.min.js"></script>
    <script src="{{asset('frontend')}}/js/mixitup.min.js"></script>
    <script src="{{asset('frontend')}}/js/main.js"></script>
</body>

</html>