<header class="main-header white{{ $partition == 'home' ? '' : ' fixed' }}" {{ $partition == 'home' ? ' id=white-header' : '' }}>
    <div class="flex-container">
        <div class="logo">
            <a href="/">
                <img src="/img/logo-black.png" alt="logo">
            </a>
        </div>
        <nav>
            <ul class="main-nav">
                <li{{ isset($partition) && $partition == 'about' ? ' class="active"' : '' }}><a href="/about/">{{ trans('menu.about') }}</a></li>
                <li{{ isset($partition) && $partition == 'catalog' ? ' class="active"' : '' }}><a href="/catalog/">{{ trans('menu.catalog') }}</a></li>
                <li{{ isset($partition) && $partition == 'ideas' ? ' class="active"' : '' }}><a href="/ideas/">{{ trans('menu.ideas') }}</a></li>
                <li{{ isset($partition) && $partition == 'news' ? ' class="active"' : '' }}><a href="/news/">{{ trans('menu.news') }}</a></li>
                <li{{ isset($partition) && $partition == 'contacts' ? ' class="active"' : '' }}><a href="/contacts/">{{ trans('menu.contacts') }}</a></li>
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