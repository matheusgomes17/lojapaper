<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Laravel 5 Boilerplate')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        <!-- Font awesome -->
        <link href="{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- SmartMenus jQuery Bootstrap Addon CSS -->
        <link href="{{ asset('css/frontend/jquery.smartmenus.bootstrap.css') }}" rel="stylesheet">
        <!-- Theme color -->
        <link id="switcher" href="{{ asset('css/frontend/theme-color/orange-theme.css') }}" rel="stylesheet">
        <!-- Main style sheet -->
        <link href="{{ asset('css/frontend/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/frontend/custom.css') }}" rel="stylesheet">

        @yield('after-styles')

        <!-- Google Font -->
        <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body>
    <!-- wpf loader Two
<div id="wpf-loader-two">
<div class="wpf-loader-two-inner">
 <span>Loading</span>
</div>
</div>
<!-- / wpf loader Two -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>

    @include('includes.partials.logged-in-as')
    @include('frontend.includes.header')

    @include('includes.partials.messages')
    @yield('content')

    @include('frontend.includes.footer')

    <!-- Login Modal -->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4>{{ trans('labels.frontend.auth.login_box_title') }}</h4>
                    {{ Form::open(['route' => 'frontend.auth.login', 'class' => 'aa-login-form']) }}
                        <label for="">{{ trans('validation.attributes.frontend.email') }}<span>*</span></label>
                        <input type="text" name="email" placeholder="{{ trans('validation.attributes.frontend.email') }}">
                        <label for="">{{ trans('validation.attributes.frontend.password') }}<span>*</span></label>
                        <input type="password" name="password" placeholder="{{ trans('validation.attributes.frontend.password') }}">
                        <button class="aa-browse-btn" type="submit">{{ trans('labels.frontend.auth.login_button') }}</button>
                        <label for="remember" class="remember">
                            <input type="checkbox" name="remember"> {{ trans('labels.frontend.auth.remember_me') }}
                        </label>
                        <p class="aa-lost-password"><a href="#">{{ trans('labels.frontend.passwords.forgot_password') }}</a></p>
                        <div class="aa-register-now">
                            Don't have an account?<a href="account.html">Register now!</a>
                        </div>
                    {{ Form::close() }}
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    @include('includes.partials.ga')

    <!-- Scripts -->
    @yield('before-scripts')
    <script src="{{ asset('js/frontend/jquery.min.js') }}"></script>
    <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/frontend/jquery.smartmenus.js') }}"></script>
    <script src="{{ asset('js/frontend/custom.js') }}"></script>
    @yield('after-scripts')
    <script>$(function(){ $('#main-menu').smartmenus(); });</script>

    </body>
</html>