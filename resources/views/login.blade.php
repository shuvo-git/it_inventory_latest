<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'IT Inventory') }}</title>
        <meta name="description" content="Bangabandhu Safari Park" />
        <meta name="keywords" content="Bangabandhu Safari Park" />
        <meta name="author" content="Bangabandhu Safari Park"/>
        <meta name="author" content="Arnob"/>
        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- vector map CSS -->
        <link href="{{asset('vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>

        <!--alerts CSS -->
        <link href="{{asset('vendors/bower_components/sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css">
        <!-- Custom CSS -->
        <link href="{{asset('dist/css/style.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <!--Preloader-->
        <div class="preloader-it">
            <div class="la-anim-1"></div>
        </div>
        <!--/Preloader-->

        <div class="wrapper pa-0">
            <header class="sp-header">
                <div class="sp-logo-wrap pull-left">
                    <a href="{{route('login')}}">
                        <img class="brand-img mr-10" src="{{asset('bank_logo.png')}}" alt="brand" width="400px" />
                    </a>
                </div>
                <div class="form-group mb-0 pull-right">
<!--                    <span class="inline-block pr-10">Don't have an account?</span>
                    <a class="inline-block btn btn-info btn-success btn-rounded btn-outline" href="signup.html">Sign Up</a>-->
                </div>
                <div class="clearfix"></div>
            </header>

            <!-- Main Content -->
            <div class="page-wrapper pa-0 ma-0 auth-page">
                <div class="container-fluid">
                    <!-- Row -->
                    <div class="table-struct full-width full-height">
                        <div class="table-cell vertical-align-middle auth-form-wrap">
                            <div class="auth-form  ml-auto mr-auto no-float">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="mb-30">
                                            <h3 class="text-center txt-dark mb-10">Sign in to {{ config('app.name', 'IT Inventory') }}</h3>
                                        </div>	
                                        <div class="form-wrap">
                                            {{Form::open(['route'=>'login','method'=>'post'])}}
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="exampleInputEmail_2">Mobile No.</label>
                                                {{Form::text('mobile_no',null,['required','class'=>'form-control','autocomplete'=>'mobile_no','autofocus'])}}
                                                @error('mobile_no')
                                                <span style="color: red">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Password</label>
                                              
                                                {{Form::password('password',['required','class'=>'form-control'])}}
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-info btn-success btn-rounded">sign in</button>
                                                
                                                <a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="{{ route('forget-password') }}">forgot password ?</a>
                                            </div>
                                            {{Form::close()}}
                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Row -->	
                </div>
            </div>
            <!-- /Main Content -->

        </div>
        <!-- /#wrapper -->

        <!-- JavaScript -->

        <!-- jQuery -->
        <script src="{{asset('vendors/bower_components/jquery/dist/jquery.min.js')}}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js')}}"></script>

        <!-- Slimscroll JavaScript -->
        <script src="{{asset('dist/js/jquery.slimscroll.js')}}"></script>

        <!-- Sweet-Alert  -->
        <script src="{{asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js')}}"></script>
        <!-- Init JavaScript -->
        <script src="{{asset('dist/js/init.js')}}"></script>
        <script src="{{asset('js/show-hide-sweet-alert.js')}}"></script>
        <script>        
            @if(session('success'))
            showBasicSweetAlert('success', '{{  session('success')}}')
            @endif

            @if($errors->any())
            <?php $html = '';?>
            @foreach ($errors->all() as $error)
            <?php $html .= $error.'. ';?>
            @endforeach
            showBasicSweetAlert('error', '{!! $html !!}')
            @endif
        </script>
    </body>
</html>
