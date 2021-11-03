<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IT Inventory') }}</title>
    <meta name="description" content="Bangabandhu Safari Park" />
    <meta name="keywords" content="Bangabandhu Safari Park" />
    <meta name="author" content="Bangabandhu Safari Park"/>
    <meta name="author" content="Arnob"/>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{url('favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{url('favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{url('favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{url('favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{url('favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{url('favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{url('favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{url('favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{url('favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    <!--alerts CSS -->
    <link href="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <!-- Data table CSS -->
    <link href="{{ asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- select2 CSS -->
    <link href="{{ asset('vendors/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendors/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Bootstrap Wysihtml5 css -->
    <link rel="stylesheet" href="{{ asset('vendors/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.css') }}" />
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/messagebox.min.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <!--Preloader-->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!--/Preloader-->
    <div class="wrapper theme-1-active pimary-color-green">

        <!-- Top Menu Items -->
        @include('layouts.partial.top_menu')
        <!-- /Top Menu Items -->

        <!-- Left Sidebar Menu -->
        @include('layouts.partial.sidebar')
        <!-- /Left Sidebar Menu -->


        <!-- Main Content -->
        <div class="page-wrapper">

            <div class="container-fluid">
                @include('layouts.partial.errorOrSuccess')
                @yield('content')
                <!-- Title -->


                <!-- /Title -->


            </div>

            <!-- Footer -->
            <footer class="footer container-fluid pl-30 pr-30">
                <div class="row">
                    <div class="col-sm-12">
                        <p>{{date('Y')}} &copy; Developed by <a href="https://www.padmabankbd.com/">Padma Bank Limited</a></p>
                    </div>
                </div>
            </footer>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

        @include('layouts.partial.change_password')
    </div>
    <!-- /#wrapper -->

    <!-- JavaScript -->

    <!-- jQuery -->
    <script src="{{url('vendors/bower_components/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Moment JavaScript -->
    <script type="text/javascript" src="{{url('vendors/bower_components/moment/min/moment-with-locales.min.js')}}"></script>

    <!-- Data table JavaScript -->
    <script src="{{url('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('dist/js/dataTables-data.js')}}"></script>

    <!-- Gallery JavaScript -->
    <script src="{{url('dist/js/isotope.js')}}"></script>
    <script src="{{url('dist/js/lightgallery-all.js')}}"></script>
    <script src="{{url('dist/js/gallery-data.js')}}"></script>

    <!-- Slimscroll JavaScript -->
    <script src="{{url('dist/js/jquery.slimscroll.js')}}"></script>

    <!-- Owl JavaScript -->
    <script src="{{url('vendors/bower_components/owl.carousel/dist/owl.carousel.min.js')}}"></script>

    <!-- Switchery JavaScript -->
    <script src="{{url('vendors/bower_components/switchery/dist/switchery.min.js')}}"></script>

    <!-- Select2 JavaScript -->
    <script src="{{url('vendors/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

    <!-- Sweet-Alert  -->
    <script src="{{url('vendors/bower_components/sweetalert/dist/sweetalert.min.js')}}"></script>

    <!-- Bootstrap Datepicker JavaScript -->
    <script type="text/javascript" src="{{url('vendors/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{url('dist/js/dropdown-bootstrap-extended.js')}}"></script>

    <!-- wysuhtml5 Plugin JavaScript -->


    <script src="{{url('vendors/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.js')}}"></script>

    <!-- Bootstrap Wysuhtml5 Init JavaScript -->
    <script src="{{url('dist/js/bootstrap-wysuhtml5-data.js')}}"></script>


    <!-- Init JavaScript -->
    <script src="{{url('dist/js/init.js')}}"></script>
    <script src="{{url('js/highlight-nav.js')}}"></script>
    <script src="{{url('js/show-hide-sweet-alert.js')}}"></script>
    <script src="{{url('js/typeahead.bundle.js')}}"></script>
    <script src="{{url('js/custom.js')}}"></script>

    <script src="{{url('js/messagebox.min.js')}}"></script>


    <script>
        $(document).ready(function () {
            $(".select2").select2();

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                autoclose: true,
                orientation: "bottom left"

            });
            $('.datepicker-back-date-off').datepicker({
                format: 'yyyy-mm-dd',
                startDate: '0d',
                todayHighlight: true,
                autoclose: true

            });
        });
    </script>


    @stack('scripts')

</body>

</html>
