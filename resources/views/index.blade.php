@section('meta')
    <title>{!! $settings->meta_title !!}</title>
    <meta name="description" content="{!! $settings->meta_description !!}">
    <meta name="keywords" content="{!! $settings->meta_keywords !!}">
@endsection
<!DOCTYPE html>
<html>
@include('public.layouts.header')
<body>
    <div class="wrapper main">
        <section class="start-section">
            <header class="main-header">
                <div class="flex-container">
                    <div class="logo">
                        <a href="/">
                            <img src="/img/logo-white.png" alt="logo">
                        </a>
                    </div>
                    <nav>
                        <ul class="main-nav">
                            <li><a href="/about/">{{ trans('menu.about') }}</a></li>
                            <li><a href="/catalog/">{{ trans('menu.catalog') }}</a></li>
                            <li><a href="/ideas/">{{ trans('menu.ideas') }}</a></li>
                            <li><a href="/news/">{{ trans('menu.news') }}</a></li>
                            <li><a href="/contacts/">{{ trans('menu.contacts') }}</a></li>
                        </ul>
                    </nav>
                    <ul class="profile">
                        <li class="lang">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                {{ trans('menu.lang') }}
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/setlocale/en">En</a>
                                </li>
                                <li>
                                    <a href="/setlocale/ru">Ru</a>
                                </li>
                            </ul>
                        </li>
                        @if($user_logged)
                            <li class="login is-logged">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <span class="login-icon"></span>
                                    {{ $user->first_name }}
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <form action="#" class="is-logged-form">
                                        <ul>
                                            <li><a href="/budget/">{{ trans('menu.budget') }}</a></li>
                                            <li><a href="/wishlist/">{{ trans('menu.wishlist') }}</a></li>
                                            <li><a href="/profile/">{{ trans('menu.profile') }}</a></li>
                                            <li><a href="/logout/">{{ trans('menu.logout') }}</a></li>
                                        </ul>
                                    </form>
                                </ul>
                            </li>
                        @else
                            <li class="login">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <span class="login-icon"></span>
                                    {{ trans('menu.login') }}
                                </a>
                                <ul class="dropdown-menu">
                                    @include('public.layouts.login_form')
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </header>
            <h1>WEDDING <span>&amp;</span> EVENT <span>PLANNER</span></h1>
            <h2 class="slogan">Мы устроим Вам праздник!</h2>
            <div class="buttons-block">
                <button class="l-btn"></button>
                <div id="action-block" class="action-block">
                    <form class="action-form" action="">
                        <div id="select-wrap" class="select-wrap">
                            <div class="action-select dropdown">
                                <a data-toggle="dropdown" href="#" aria-expanded="true">
                                    Your city
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="#">Kharkov</a></li>
                                    <li><a href="#">Kiev</a></li>
                                    <li><a href="#">London</a></li>
                                </ul>
                            </div>
                            <div class="action-select dropdown">
                                <a data-toggle="dropdown" href="#" aria-expanded="true">
                                    Who are you looking for
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="#">Who are you looking for</a></li>
                                    <li><a href="#">Who are you looking for</a></li>
                                    <li><a href="#">Who are you looking for</a></li>
                                </ul>
                            </div>
                            <div class="action-select dropdown">
                                <a data-toggle="dropdown" href="#" aria-expanded="true">
                                    Your event
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="#">Your event</a></li>
                                    <li><a href="#">Your event</a></li>
                                    <li><a href="#">Your event</a></li>
                                </ul>
                            </div>
                            <div class="action-select dropdown">
                                <a data-toggle="dropdown" href="#" aria-expanded="true">
                                    Date
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a href="#">Date</a></li>
                                    <li><a href="#">Date</a></li>
                                    <li><a href="#">Date</a></li>
                                </ul>
                            </div>
                        </div>
                        <button class="action-btn">Найти исполнителя</button>
                    </form>
                </div>
                <button class="r-btn"></button>
            </div>
        </section>
        @include('public.layouts.main_menu', ['partition' => 'home'])
        @include('public.layouts.categories')
        @include('public.layouts.posts_slider', ['class' => 'most-popular', 'title' => 'Most Popular', 'id' => 'popular-carousel', 'posts' => $popular, 'description' => 'Discover hundreds of popular providers recommended by <b>Wedding</b> <span>&amp;</span> <b>Event</b> Planner'])
        <section class="video-section">
            <div class="video-heading">GREAT WEDDING ON SAFARI IN KRUGER NATIONAL PARK</div>
        </section>
        @include('public.layouts.posts_slider', ['class' => 'new-providers', 'title' => 'New Providers', 'id' => 'providers-carousel', 'posts' => $providers, 'description' => 'Discover hundreds of popular providers recommended by <b>Wedding</b> <span>&amp;</span> <b>Event</b> Planner'])
        @include('public.layouts.providers_portfolio')
    </div>
    @include('public.layouts.footer')
    @include('public.layouts.footer-scripts')
</body>
</html>