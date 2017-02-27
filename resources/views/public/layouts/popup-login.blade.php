<div class="popup-login mfp-bg" style="display: none" disabled>
    <article class="login-form clearfix">
        <h2 id="login-title" class="section-title">Авторизация</h2>
        <form id="autorization-form" class="autorization-form" method="post" action="/login">
            <div class="row">
                <div class="col-sm-6">
                    <div class="autorization-col autorization">
                        {!! csrf_field() !!}
                        <div class="autorization-form__input-wrap">
                            <label for="email" class="autorization-form__label">E-mail</label>
                            <input type="text" name="email" id="email" class="autorization-form__input @if($errors->has('email')) input_error @endif" value="{!! old('email') !!}">
                        </div>
                        <div class="autorization-form__input-wrap">
                            <label for="password" class="autorization-form__label">Пароль</label>
                            <input type="password" id="password" name="password" class="autorization-form__input">
                            <a href="/forgotten" class="autorization-form__forgot">Забыли пароль?</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="autorization-col registration-col">
                        <ul class="registration-iconset">
                            <span class="registration-iconset__title">Создав учетную запись Вы сможете: </span>
                            <li class="registration-iconset__item">
                                <i class="registration-iconset__icon">&#xe816;</i>
                                <span class="registration-iconset__text">Отслеживать статус заказа</span>
                            </li>
                            <li class="registration-iconset__item">
                                <i class="registration-iconset__icon">&#xe80e;</i>
                                <span class="registration-iconset__text">Просматривать историю покупок</span>
                            </li>
                            <li class="registration-iconset__item">
                                <i class="registration-iconset__icon">&#xe817;</i>
                                <span class="registration-iconset__text">Узнавать о новинках </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="autorization-col autorization">
                        <button type="submit" class="product__btn autorization-form__btn">Войти</button>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="autorization-col registration-col">
                        <a class="product__btn registration-col__btn" href="/register">Зарегистрироваться</a>
                    </div>
                </div>
            </div>
        </form>
    </article>
</div>