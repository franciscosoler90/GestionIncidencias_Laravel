<!doctype html>
<html lang="es-ES">	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Francisco José Soler Conchello">
		<title>@yield('title') - ACK</title>		
		<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/apple-icon-57x57.png') }}">
		<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/apple-icon-60x60.png') }}">
		<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/apple-icon-72x72.png') }}">
		<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon-76x76.png') }}">
		<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/apple-icon-114x114.png') }}">
		<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/apple-icon-120x120.png') }}">
		<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/apple-icon-144x144.png') }}">
		<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/apple-icon-152x152.png') }}">
		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-icon-180x180.png') }}">
		<link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('img/android-icon-192x192.png') }}">
		<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
		<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon-96x96.png') }}">
		<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
		<link rel="manifest" href="{{ asset('img/manifest.json') }}">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="{{ asset('img/ms-icon-144x144.png') }}">
		<meta name="theme-color" content="#ffffff">	
		<meta name="csrf-token" content="{{ csrf_token() }}">
		
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

		<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css">
		<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

		@vite(['resources/css/AdminKit.css'])
		@vite(['resources/js/AdminKit.js'])
		@vite(['resources/js/AdminKit2.js'])
		@vite(['resources/css/app.css'])
		@vite(['resources/css/colors.css'])

		<script>
			$(document).ready(function() {
				
				var toastElList = [].slice.call(document.querySelectorAll('.toast'))
				var toastList = toastElList.map(function(toastEl) {
					return new bootstrap.Toast(toastEl)
				});

				var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
				var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
				return new bootstrap.Tooltip(tooltipTriggerEl)
				})
				
				@if(session('success'))
					var toast = toastList[0];
					toast.show();
				@endif
				
			});
		</script>

	</head>

	<body>
		
		<div class="wrapper">
			
			@include('dashboard.sidebar')
			
			<div class="main">
				
				@include('dashboard.navbar')
				
				<main class="content">
					<div class="container-fluid p-0">
						@yield('content')
					</div>
				</main>
				
				@include('dashboard.footer')
				
			</div>
			
		</div>
		
		<div class="toast-container">
			
			@if ($errors->any())
				@include('components.flash')
			@endif
			
			@if (session('success'))
				@include('components.flash')
			@endif
			
		</div>

	</body>

</html>						