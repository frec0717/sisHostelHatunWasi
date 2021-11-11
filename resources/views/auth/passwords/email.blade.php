<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Forgot Password | UBold - Responsive Admin Dashboard Template</title>
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
                    <div class="auth-brand text-center text-lg-start">
                        <div class="auth-logo">
                            <a href="index.html" class="logo logo-dark text-center">
                                <span class="logo-lg">
                                    <img src="{{ asset('dashboard/images/logo-dark.png') }}" alt="" height="22">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light text-center">
                                <span class="logo-lg">
                                    <img src="{{ asset('dashboard/images/logo-light.png') }}" alt="" height="22">
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- title-->
                    <h4 class="mt-0">Recuperar contraseña</h4>
                    <p class="text-muted mb-4">Ingrese su dirección de correo electrónico y le enviaremos un correo electrónico con instrucciones para restablecer su contraseña.</p>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <!-- form -->
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="emailaddress" class="form-label">Correo electrónico</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correo electrónico" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="text-center d-grid">
                            <button class="btn btn-primary waves-effect waves-light" type="submit"> Restablecer la contraseña </button>
                        </div>

                    </form>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted">Regresar a<a href="{{ route('login') }}" class="text-muted ms-1"><b>Iniciar sesión</b></a></p>
                    </footer>

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3 text-white">I love the color!</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i> I've been using your theme from the previous developer for our web app, once I knew new version is out, I immediately bought with no hesitation. Great themes, good documentation with lots of customization available and sample app that really fit our need. <i class="mdi mdi-format-quote-close"></i>
                </p>
                <h5 class="text-white">
                    - Fadlisaad (Ubold Admin User)
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