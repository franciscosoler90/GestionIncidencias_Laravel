<!doctype html>
<html lang="es-ES">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Francisco José Soler Conchello">
		<title>¿Has olvidado la contraseña?</title>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

		@vite(['resources/css/login.css'])
		@vite(['resources/js/app.js'])
		@vite(['resources/css/colors.css'])
		
    </head>
	<body>
		<section class="vh-100 gradient">
			<div class="container py-5 h-100">
				<div class="row d-flex justify-content-center align-items-center h-100">
					<div class="col col-xl-10">
						<div class="card">
							<div class="row g-0">

								<div class="col-md-6 col-lg-5 d-none d-md-block">
									<img src="{{ asset('img/1.jpg') }}" alt="login form" class="img-fluid" >
                                </div>
                                
								<div class="col-md-6 col-lg-7 d-flex align-items-center">
									<div class="card-body p-4 p-lg-5 text-black">

										<h1 class="umbra logo text-center text-primary mb-3">ACK</h1>

										<form method="POST" action="{{ route('resetPassword') }}">
                                            @csrf

                                            <p>Introduce tu correo electrónico para buscar tu cuenta.</p>
											
											<div class="form-floating mb-4">
												<input type="text" class="form-control" id="email" name="email" placeholder="Correo electrónico" value="" autocomplete="on" required>
												<label for="email">Correo electrónico</label>
                                            </div>
											
											<div class="gap-2 d-md-flex justify-content-md-end mb-4 text-end">
                                                <a class="btn btn-secondary btn-lg" href="{{ route('login') }}" role="button">Cancelar</a>
												<button class="btn btn-primary btn-lg" type="submit">Buscar</button>
                                            </div>
											
											<div class="d-grid gap-2 d-md-flex justify-content-md-end">
												<span class="badge bg-secondary" id="error-message"></span>
                                            </div>

                                        </form>

										@if ($errors->any())
											@include('components.popup')
            								@yield('content')
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	</body>
</html>