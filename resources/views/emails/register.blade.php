<div class="header" style="text-align: center;">
    <img src="{!! url('/img/logo.png') !!}" alt="logo"  title="ВерхАгро" width="217" height="67" />
</div>

<h1>Здравствуйте, <strong>{!! $user['last_name'] or '' !!} {!! $user['first_name'] !!}</strong>!</h1>
<p>Добро пожаловать в Интернет-магазин ВерхАгро!</p>
<p>Для входа в <a href="{!! url('/user') !!}">личный кабинет</a> используйте свой e-mail и пароль, указанный при регистрации.</p>