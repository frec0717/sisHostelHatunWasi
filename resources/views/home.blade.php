<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard | UBold - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('dashboard/images/favicon.ico') }}">

    <!-- Sweet Alert-->
    <link href="{{ asset('dashboard/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('dashboard/css/config/material/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('dashboard/css/config/material/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('dashboard/css/config/material/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('dashboard/css/config/material/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- Plugins css -->
    <link href="{{ asset('dashboard/libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/libs/clockpicker/bootstrap-clockpicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />


    <link href="{{ asset('dashboard/libs/select2/css/select2.min.css') }}"  rel="stylesheet" type="text/css"/>


    <!-- icons -->
    <link href="{{ asset('dashboard/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<!-- body start -->

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <div id="app">
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            @include('plantilla.topbar')
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('plantilla.leftsidebar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    @include('contenido.contenido')
                    <!-- container -->
                    <!-- <example-component></example-component> -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                2021 &copy; UBold theme by <a href="">Coderthemes</a>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-sm-block">
                                    <a href="javascript:void(0);">About Us</a>
                                    <a href="javascript:void(0);">Help</a>
                                    <a href="javascript:void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>

    </div>
    <!-- END wrapper -->

    @include('plantilla.rightsidebar')
    <script src="{{ asset('/js/app.js') }}"></script>

    <!-- Vendor js -->
    <script src="{{ asset('dashboard/js/vendor.min.js') }}"></script>


    <!-- App js-->
    <script src="{{ asset('dashboard/js/app.min.js') }}"></script>


    <!-- Sweet Alerts js -->
    <script src="{{ asset('dashboard/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('dashboard/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/clockpicker/bootstrap-clockpicker.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
    <!-- Init js-->
    <script src="{{ asset('dashboard/js/pages/form-pickers.init.js') }}"></script>

    <script src="{{ asset('dashboard/libs/select2/js/select2.min.js') }}"></script>




</body>

</html>
