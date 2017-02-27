<header class="main-header">
    <div class="container">
        <div class="main-header__left">
            <div class="main-header__logo-wrap">
                <a href="/">
                    <img src="/img/logo.png" alt="" class="main-header__logo-img">
                    <span class="main-header__descr">Сельхоз техника и запчасти в Украине</span>
                </a>
            </div>
            <div class="main-header__cities-wrap">
                <span class="main-header__cities-title">Выберите филиал</span>
                <div class="sort_by">
                    <select class="sort_list cities-select">
                        @foreach($settings->branches as $branch)
                            <option value="{{ $branch->city }}"{{ $branch->city == $selected_city ? ' selected' : '' }}>{{ $branch->city }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="main-header__right">
            <ul class="main-header__phones">
                @foreach($settings->branches as $branch)
                    @if($branch->city == $selected_city)
                        @foreach($branch->phones as $phone)
                            <li class="main-header__phones-item">{!! $phone !!}</li>
                        @endforeach
                    @endif
                @endforeach
            </ul>
            <div class="main-header__address">
                <span class="main-header__city">г. {{ $selected_city }}</span>
                <span class="main-header__street">
                     @foreach($settings->branches as $branch)
                        @if($branch->city == $selected_city)
                            {!! $branch->address !!}
                        @endif
                    @endforeach
                </span>
            </div>
            <div class="main-header__login-cart">
                <div class="main-header__login-wrap">
                    @if($user_logged)
                        <a href="/logout" class="main-header__logout">Выход</a>
                        <span class="main-header__login-spacer">/</span>
                        @if (in_array('admin', $user_roles) || in_array('manager', $user_roles))
                            <a href="/admin" class="main-header__profile">Личный кабинет</a>
                        @else
                            <a href="/user" class="main-header__profile">Личный кабинет</a>
                        @endif
                    @else
                        <a href="#" data-mfp-src=".popup-form-login" class="main-header__login">Вход</a>
                        <span class="main-header__login-spacer">/</span>
                        <a href="#" data-mfp-src=".popup-form-login" class="main-header__reg">Регистрация</a>
                    @endif
                </div>
                <div class="main-header__cart-wrap">
                    <a href="/checkout">
                        <div class="main-header__cart">
                            Корзина
                        </div>
                        @if(is_object($cart) && $cart->total_quantity > 0)
                        <span class="main-header__cart-items">{{ $cart->total_quantity }}</span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
