<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Iniciar sesión | Hatun Wasi Hostel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('dashboard/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('dashboard/css/config/material/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('dashboard/css/config/material/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('dashboard/css/config/material/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('dashboard/css/config/material/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('dashboard/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="loading auth-fluid-pages pb-0">

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">

                    <!-- Logo -->
                    <div style="margin-left: 4rem;" class="auth-brand text-center text-lg-start">
                        <div class="auth-logo">
                            <a href="index.html" class="logo logo-dark text-center">
                                <span class="logo-lg">
                                    <img src="{{ asset('dashboard/images/logo-dark.svg') }}" alt="" height="22">
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- title-->
                    <h4 class="mt-0">Iniciar sesión</h4>
                    <p class="text-muted mb-4">Ingrese su dirección de correo electrónico y contraseña para acceder a la cuenta.</p>

                    <!-- form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="emailaddress" class="form-label">Correo Electrónico</label>
                            <input class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" type="email" required="" placeholder="Correo eletrónico" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-muted float-end">
                                <small>¿Olvidaste tu contraseña?</small>
                            </a>
                            @endif
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group input-group-merge">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" name="password" required autocomplete="current-password">
                                <div class="input-group-text" data-password="false">
                                    <span class="password-eye"></span>
                                </div>
                            </div>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                <label class="form-check-label" for="checkbox-signin">Recuérdame</label>
                            </div>
                        </div>
                        <div class="text-center d-grid">
                            <button class="btn btn-primary" type="submit">Iniciar sesión</button>
                        </div>
                        <!-- social-->
                        <!-- <div class="text-center mt-4">
                            <p class="text-muted font-16">Sign in with</p>
                            <ul class="social-list list-inline mt-3">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                </li>
                            </ul>
                        </div> -->
                    </form>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted">¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-muted ms-1"><b>Registrate</b></a></p>
                    </footer>

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3 text-white">Hatun Wasi Hostel</h2>
                <p class="lead">El mejor hostel de toda la región Áncash.</p>
                <h5 class="text-white">
                    Fundado en 2003.
                </h5>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->

    <!-- Vendor js -->
    <script src="{{ asset('dashboard/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('dashboard/js/app.min.js') }}"></script>

</body>

</html>