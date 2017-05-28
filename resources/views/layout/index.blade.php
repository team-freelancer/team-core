
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{isset($titlePage) ? $titlePage : $title}}</title>
<link rel="stylesheet" type="text/css" href="{{asset('html/css/style.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('html/css/responsive.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('html/css/owl.carousel.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('html/css/bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('html/css/font-awesome.min.css')}}"/>
@yield('css')
@yield('script')
<script src="{{asset('html/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('html/js/bootstrap.min.js')}}"></script>
<script src="{{asset('html/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('html/js/jquery.bxslider.min.js')}}"></script>
<script src="{{asset('html/js/script.min.js')}}"></script>
</head>

<body>
	<!--header-->
    @include('layout.header')
	<!-- content -->
	@yield('content')
	<!-- footer -->
	 @include('layout.footer')
</body>
</html>
