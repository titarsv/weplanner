<footer class="main-footer">
    <div class="footer-top">
        <div class="container">
            <div class="main-footer__left">
                <div class="main-footer__logo-wrap">
                    <img src="/img/logo.jpg" alt="" class="main-footer__logo-img">
                    <span class="main-footer__descr">Сельхоз техника и запчасти в Украине</span>
                </div>
                <div class="main-footer__cities-wrap">
                    <span class="main-footer__cities-title">Выберите филиал</span>
                    <div class="sort_by">
                        <select class="sort_list cities-select">
                            @foreach($branches as $branch)
                                <option value="{{ $branch }}"{{ $branch == $selected_city ? ' selected' : '' }}>{{ $branch }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="main-footer__right">
                <ul class="main-footer__phones">
                    @foreach($settings->branches as $branch)
                        @if($branch->city == $selected_city)
                            @foreach($branch->phones as $phone)
                                <li class="main-footer__phones-item">{!! $phone !!}</li>
                            @endforeach
                        @endif
                    @endforeach
                </ul>
                <div class="main-footer__address">
                    <span class="main-footer__city">г. {{ $selected_city }}</span>
                    <span class="main-footer__street">
                        @foreach($settings->branches as $branch)
                            @if($branch->city == $selected_city)
                                {!! $branch->address !!}
                            @endif
                        @endforeach
                    </span>
                </div>
                <div class="main-footer__btn-wrap">
                    <a href=".popup-form-footer" class="main-footer__callback-btn">Обратный звонок</a>
                </div>
            </div>
        </div>
    </div>
    <nav class="footer-nav">
        <div class="container">
            <ul class="footer_menu">
                <li class="footer_menu-item"><a href="/" class="footer_menu-item_text">Главная</a></li>
                <li class="footer_menu-item"><a href="/brands" class="footer_menu-item_text">Бренды</a></li>
                <li class="footer_menu-item"><a href="/news" class="footer_menu-item_text">Новости</a></li>
                <li class="footer_menu-item"><a href="/sale" class="footer_menu-item_text">Акции</a></li>
                <li class="footer_menu-item"><a href="/about" class="footer_menu-item_text">О компании</a></li>
                <li class="footer_menu-item"><a href="/contacts" class="footer_menu-item_text">Контакты</a></li>
            </ul>
        </div>
    </nav>
    <div class="footer-copyright">
        <div class="container">
            <div class="footer-copyright_left">
                <div class="copyright">ТОВ “ВерхАгро”</div>
                <div class="company-email">verhagro@gmail.com</div>
                <div class="socials">
                    <a href="" class="vk"></a>
                    <a href="" class="fb"></a>
                    <a href="" class="ok"></a>
                    <a href="" class="yt"></a>
                </div>
            </div>
            <div class="footer-copyright_right">
                <div class="main-footer__bz-logo">
                    <span class="main-footer__bz-title">Разработка сайта:</span>
                    <a href="http://zavodbiz.com/" target="_blank" class="main-footer__bz-logo-link">Первый бизнес завод</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="hidden">
    <form class="main-form forms popup-form popup-form-footer recall">
        {!! csrf_field() !!}
        <h3 class="popup-form__title">Обратный звонок</h3>
        <div class="error-message">

        </div>
        <input type="hidden" name="order" value="Заявка (попап футер)">
        <input type="hidden" name="tagmanager" value="/popup_form_footer.html">
        <div class="popup-form__input-wrap">
            <input type="text" name="name" class="popup-form__input" placeholder="Имя">
        </div>
        <div class="popup-form__input-wrap">
            <input type="text" name="phone" class="popup-form__input" placeholder="Мобильный телефон">
        </div>
        <div class="popup-form__input-wrap">
            <button type="submit" class="popup-form__btn">Оставить</button>
        </div>
    </form>
</div>

<div class="hidden">
    <div class="main-form forms popup-form popup-form-login">

        <nav class="login_tabs">
            <ul class="tabs_caption">
                <li class="login_tabs-item log-tab active">Логин</li>
                <li class="login_tabs-item reg-tab">Регистрация</li>
            </ul>

            <div class="tabs_content user-room_tabs_content log-content active">
                <form class="form-login" action="/login" method="post">
                    {!! csrf_field() !!}
                    <div class="error-message">

                    </div>
                    <div class="popup-form__input-wrap">
                        <input type="text" name="email" class="popup-form__input" placeholder="E-mail">
                    </div>
                    <div class="popup-form__input-wrap">
                        <input type="password" name="password" class="popup-form__input" placeholder="Пароль">
                    </div>
                    <div class="popup-form__input-wrap">
                        <button type="submit" class="popup-form__btn">ВОЙТИ</button>
                    </div>

                </form>
            </div>

            <div class="tabs_content user-room_tabs_content reg-content">
                <form class="form-reg" action="/registration" method="post">
                    {!! csrf_field() !!}
                    <div class="error-message">

                    </div>
                    <div class="popup-form__input-wrap">
                        <input type="text" name="first_name" class="popup-form__input" placeholder="Имя*">
                    </div>
                    <div class="popup-form__input-wrap">
                        <input type="text" name="last_name" class="popup-form__input" placeholder="Фамилия">
                    </div>
                    <div class="popup-form__input-wrap">
                        <input type="text" name="email" class="popup-form__input" placeholder="E-mail">
                    </div>
                    <div class="popup-form__input-wrap">
                        <input type="text" name="phone" class="popup-form__input" placeholder="Мобильный телефон">
                    </div>
                    <div class="popup-form__input-wrap">
                        <input class="popup-form__input" type="password" name="password" placeholder="Пароль">
                    </div>
                    <div class="popup-form__input-wrap">
                        <input class="popup-form__input" type="password" name="password_confirmation" placeholder="Повторите пароль">
                    </div>
                    <div class="popup-form__input-wrap">
                        <button type="submit" class="popup-form__btn">РЕГИСТРАЦИЯ</button>
                    </div>

                </form>

            </div>
        </nav>
    </div>
</div>