<header>
    <div class="headerarea header__sticky">
        <div class="container desktop__menu__wrapper">
            <div class="row common__row position-relative">
                <div class="col-xl-2 col-lg-2 col-md-6">
                    <div class="headerarea__logo">
                        <a href="{{url('/')}}"><h1>E-Perpus</h1></a>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6 main_menu_wrap">

                    <div class="headerarea__main__menu ">
                        <nav>
                            <ul>
                                <li>
                                    <a href="{{ url('/') }}">Home
                                    </a>
                                </li>

                                <li class="position-static">
                                    <a href="{{ route('book.index') }}">Books
                                    </a>
                                </li>
                                <li><a href="#">About</a> </li>
                            </ul>
                        </nav>
                    </div>

                </div>


                <div class="col-xl-3 col-lg-3 col-md-6">

                    <div class="headerarea__right">

                        <ul class="headerarea__right__nav">

                            <li>
                                <div class="headerarea__search cursor__pointer">

                                    <svg role="presentation" stroke-width="2" focusable="false" width="22" height="22" class="icon icon-search" viewBox="0 0 22 22">
                                        <circle cx="11" cy="10" r="7" fill="none" stroke="currentColor">
                                        </circle>
                                        <path d="m16 15 3 3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>


                                </div>
                            </li>


                            <li>
                                <div class="setting__wrap cursor__pointer">
                                    <div class="setting__wrap__active">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                            <path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                            <path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                                        </svg>

                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="headermiddle__bar cursor__pointer">
                                    <div class="headermiddle__account">
                                        <div class="headermiddle__account__img">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                                <circle cx="176" cy="416" r="16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                                <circle cx="400" cy="416" r="16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M48 80h64l48 272h256" />
                                                <path d="M160 288h249.44a8 8 0 007.85-6.43l28.8-144a8 8 0 00-7.85-9.57H128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                            </svg>
                                            <span class="bigcounter">
                                                {{ $cartItems->count() }}
                                            </span>


                                        </div>

                                    </div>
                                </div>


                            </li>

                            <li>
                                <div class="headermiddle__account__img">
                                    <!-- SVG Buku -->
                                    <a href="{{route('lending.index')}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                        </svg>
                                    </a>
                                    <span class="bigcounter">
                                        {{ $lendingItems->count() }}
                                    </span>
                                </div>
                            </li>

                        </ul>

                    </div>

                </div>

            </div>


        </div>
    </div>

    <div class="container-fluid mob_menu_wrapper headerarea header__sticky">
        <div class="row align-items-center">
            <div class="col-sm-4 col-2">
                <div class="mobile-off-canvas">
                    <a class="mobile-aside-button" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="col-sm-4 col-5">
                <div class="mobile-logo">
                    <a href="{{url('/')}}"><h3>E-Perpus</h3></a>
                </div>
            </div>
            <div class="col-sm-4 col-5">
                <div class="header-right-wrap">

                    <div class="header__right__inner__wrap d-flex align-items-center justify-content-end">

                        <ul class="headerarea__right headerarea__right__mobail__menu">
                            <li>
                                <div class="headerarea__search cursor__pointer">

                                    <svg role="presentation" stroke-width="2" focusable="false" width="22" height="22" class="icon icon-search" viewBox="0 0 22 22">
                                        <circle cx="11" cy="10" r="7" fill="none" stroke="currentColor">
                                        </circle>
                                        <path d="m16 15 3 3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>

                                </div>
                            </li>

                            <li>
                                <div class="setting__wrap cursor__pointer">
                                    <div class="setting__wrap__active">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                            <path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                            <path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                                        </svg>

                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="headermiddle__bar cursor__pointer">
                                    <div class="headermiddle__account">
                                        <div class="headermiddle__account__img">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                                <circle cx="176" cy="416" r="16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                                <circle cx="400" cy="416" r="16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M48 80h64l48 272h256" />
                                                <path d="M160 288h249.44a8 8 0 007.85-6.43l28.8-144a8 8 0 00-7.85-9.57H128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                            </svg>
                                            <span class=" bigcounter">
                                                {{ $cartItems->count() }}
                                            </span>

                                        </div>

                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="headermiddle__account__img">
                                    <a href="{{route('lending.index')}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                        </svg>
                                    </a>
                                    <span class="bigcounter">
                                        {{ $lendingItems->count() }}
                                    </span>
                                </div>
                            </li>

                        </ul>

                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Mobile Menu Start Here -->
    <div class="mobile-off-canvas-active">
        <a class="mobile-aside-close"><i class="fa fa-close"></i></a>
        <div class="header-mobile-aside-wrap">

            <div class="mobile__logo">
                <a href="index.html">
                    <a href="{{url('/')}}"><h1>E-Perpus</h1></a>
                </a>
            </div>

            <div class="mobile-search">
                <form class="search-form" action="{{ route('book.search') }}" method="get">
                    <input type="text" name="q" placeholder="Search entire store…">
                    <button class="button-search"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap">

                <div class="mobile-navigation">
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><a href="{{url ('/')}}">Home</a></li>

                            <li class="menu-item-has-children"><a href="{{route('book.index')}}">Books</a></li>

                            <li><a href="#">About</a>
                            </li>
                        </ul>
                    </nav>

                </div>


            </div>
            <div class="mobile-curr-lang-wrap">
                <div class="single-mobile-curr-lang">
                    <a class="mobile-account-active" href="#">My Account <i class="fa fa-angle-down"></i></a>
                    <div class="lang-curr-dropdown account-dropdown-active">
                        <ul>
                            @auth
                                <li>
                                    <a href="{{ route('orders.index') }}">My Orders</a>
                                </li>

                                 <li>
                                    <a href="{{ route('lending.index') }}">My Returns & Lendings</a>
                                </li>
                                <li>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>    
                                </li>
                                
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                @else
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li><a href="{{ route('register') }}">Create Account</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>

            </div>
            <div class="mobile-social-wrap">
                <a class="facebook" href="#"><i class="fab fa-facebook"></i></a>
                <a class="twitter" href="#"><i class="fab fa-twitter"></i></a>
                <a class="pinterest" href="#"><i class="fab fa-pinterest"></i></a>
                <a class="instagram" href="#"><i class="fab fa-instagram"></i></a>
                <a class="google" href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end Here -->

    <!-- setting__wrap__list__start -->
    <div class="setting__wrap__list">
        <button class="setting__wrap__close">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                <title>Close</title>
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368"></path>
            </svg>
        </button>

        <div class="setting__wrap__heading">
            <h6><a href="#">Account</a></h6>
        </div>

        <div class="setting__wrap__list__inner">
            <ul>
                @auth
                <li>
                    <a href="{{ route('orders.index') }}">My Orders</a>
                </li>
                 <li>
                    <a href="{{ route('return.index') }}">My Returns & Lendings</a>
                </li>
                <li>
                    <a href="{{ route('cart.index') }}">Cart</a>
                </li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-2').submit();">
                        Logout
                    </a>
                </li>
                <form id="logout-form-2" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @else
                <li>
                    <a href="{{ route('login') }}">Login</a>
                </li>
                <li>
                    <a href="{{ route('cart.index') }}">Cart</a>
                </li>
                <li>
                    <a href="{{ route('register') }}">Create Account</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>

    <!-- setting__wrap__list__end -->

    <!-- header__search -->
    <div class="headersearch__active">
        <div class="headersearch__active__icon">
            <button class="headersearch__active__close">
                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                    <title>Close</title>
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368"></path>
                </svg></button>
        </div>
        <div class="headersearch__active__input">
            <form action="{{ route('book.search') }}" method="get" role="search" style="position: relative;">
                <div class="header__form__search">
                    <input type="search" name="q" placeholder="Search our store" class="input-text" autocomplete="off">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <!-- header__search -->

    <!-- minicart__section__start -->
        @include('layouts.components-frontend.mini_cart')
    <!-- minicart__section__end -->

</header>
<!-- header section end -->
