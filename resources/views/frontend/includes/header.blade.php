<!-- Start header section -->
<header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-header-top-area">
                        <!-- start header top left -->
                        <div class="aa-header-top-left">
                            <!-- start language -->
                            <div class="aa-language">
                                @if (config('locale.status') && count(config('locale.languages')) > 1)
                                    <div class="dropdown">
                                        <a class="btn dropdown-toggle" href="#" type="button" id="lang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            @if (App::getLocale())
                                                <img src="{{ asset('img/frontend/flag/'.App::getLocale().'.jpg') }}" alt="">{{ trans('menus.language-picker.langs.'.App::getLocale()) }}
                                                <span class="caret"></span>
                                            @endif

                                        </a>
                                        @include('includes.partials.lang')
                                    </div>
                                @endif
                            </div>
                            <!-- / language -->
                            
                            <!-- start cellphone -->
                            <div class="cellphone hidden-xs">
                                <p><span class="fa fa-phone"></span>00-62-658-658</p>
                            </div>
                            <!-- / cellphone -->
                        </div>
                        <!-- / header top left -->
                        <div class="aa-header-top-right">

                            <ul class="aa-head-top-nav-right">
                            @if (! $logged_in_user)
                                <li><a title="" data-toggle="modal" data-target="#login-modal" href="#">{{ trans('navs.frontend.login') }}</a></li>

                                @if (config('access.users.registration'))
                                    <li>{{ link_to_route('frontend.auth.register', trans('navs.frontend.register')) }}</li>
                                @endif
                            @else
                                @permission('view-backend')
                                <li>{{ link_to_route('admin.dashboard', trans('navs.frontend.user.administration')) }}</li>
                                @endauth

                                <li><a title="" href="{{ route('frontend.user.account') }}">{{ trans('navs.frontend.user.account') }}</a></li>
                                <li><a title="" class="hidden-xs" href="{{ route('frontend.user.account') }}">{{ trans('navs.frontend.user.account') }}</a></li>
                                <li><a title="" class="hidden-xs" href="{{ route('frontend.user.account') }}">{{ trans('navs.frontend.user.account') }}</a></li>
                                <li><a title="" class="hidden-xs" href="{{ route('frontend.user.account') }}">{{ trans('navs.frontend.user.account') }}</a></li>

                                <li>{{ link_to_route('frontend.auth.logout', trans('navs.general.logout')) }}</li>
                            @endif
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-header-bottom-area">
                        <!-- logo  -->
                        <div class="aa-logo">
                            <!-- Text based logo -->
                            <a href="{{ route('frontend.index') }}">
                                <span class="fa fa-shopping-cart"></span>
                                <p>Paper<strong>Store</strong> <span>Decoração em Papel de Parede</span></p>
                            </a>
                            <!-- img based logo -->
                            <!-- <a href="index.html"><img src="img/logo.jpg" alt="logo img"></a> -->
                        </div>
                        <!-- / logo  -->
                        <!-- cart box -->
                        <div class="aa-cartbox">
                            <a class="aa-cart-link" href="#">
                                <span class="fa fa-shopping-basket"></span>
                                <span class="aa-cart-title">CARRINHO DE COMPRAS</span>
                                <span class="aa-cart-notify">2</span>
                            </a>
                            <div class="aa-cartbox-summary">
                                <ul>
                                    <li>
                                        <a class="aa-cartbox-img" href="#"><img src="img/woman-small-2.jpg" alt="img"></a>
                                        <div class="aa-cartbox-info">
                                            <h4><a href="#">Product Name</a></h4>
                                            <p>1 x $250</p>
                                        </div>
                                        <a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a>
                                    </li>
                                    <li>
                                        <a class="aa-cartbox-img" href="#"><img src="img/woman-small-1.jpg" alt="img"></a>
                                        <div class="aa-cartbox-info">
                                            <h4><a href="#">Product Name</a></h4>
                                            <p>1 x $250</p>
                                        </div>
                                        <a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a>
                                    </li>
                                    <li>
                      <span class="aa-cartbox-total-title">
                        Total
                      </span>
                      <span class="aa-cartbox-total-price">
                        $500
                      </span>
                                    </li>
                                </ul>
                                <a class="aa-cartbox-checkout aa-primary-btn" href="checkout.html">Checkout</a>
                            </div>
                        </div>
                        <!-- / cart box -->
                        <!-- search box -->
                        <div class="aa-search-box">
                            <form action="">
                                <input type="text" name="" id="" placeholder="Faça sua pesquisa...">
                                <button type="submit"><span class="fa fa-search"></span></button>
                            </form>
                        </div>
                        <!-- / search box -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / header bottom  -->
</header>
<!-- / header section -->
<!-- menu -->
<section id="menu">
    <div class="container">
        <div class="menu-area">
            <!-- Navbar -->
            <div class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">{{ trans('labels.general.toggle_navigation') }}</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <!-- Left nav -->
                    <ul id="main-menu" class="nav navbar-nav">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>

                        @foreach($menus as $menu)
                        <li><a href="#">{{ $menu->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                            @foreach($menu->children as $submenu)
                                <li><a href="{{ route('frontend.product', $submenu->id) }}">{{ $submenu->name }}</a></li>
                            @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>
</section>
<!-- / menu -->