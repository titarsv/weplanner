<a id="touch-menu" class="mobile-menu" href="#"><div class="container"></div></a>
<nav class="main_nav">
    <div class="container">
        <ul class="main_menu">
            <li><a href="/">Главная</a></li>
            <li><a href="#">Бренды</a>
                <ul class="main_submenu">
                    @foreach($brands as $brand => $categories)
                        <li><a href="/brand/{{ $brand }}">{{ $brand }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="/news">Новости</a></li>
            <li><a href="/sale">Акции</a></li>
            <li><a href="/about">О компании</a></li>
            <li><a href="/contacts">Контакты</a></li>
        </ul>
    </div>
</nav>