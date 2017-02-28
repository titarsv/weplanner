@extends('public.layouts.main')
@section('meta')
    <title>{!! $settings->meta_title !!}</title>
    <meta name="description" content="{!! $settings->meta_description !!}">
    <meta name="keywords" content="{!! $settings->meta_keywords !!}">
@endsection

@section('content')
    <div class="wrapper catalog">
        <header class="main-header white fixed">
            <div class="flex-container">
                <div class="logo">
                    <a href="#">
                        <img src="img/logo-black.png" alt="logo">
                    </a>
                </div>
                <nav>
                    <ul class="main-nav">
                        <li>
                            <a href="#">About</a>
                        </li>
                        <li class="active">
                            <a href="#">Catalog</a>
                        </li>
                        <li>
                            <a href="#">Ideas</a>
                        </li>
                        <li>
                            <a href="#">News</a>
                        </li>
                        <li>
                            <a href="#">Contacts</a>
                        </li>
                    </ul>
                </nav>
                <ul class="profile">
                    <li class="lang">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            En
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#">En</a>
                            </li>
                            <li>
                                <a href="#">Ru</a>
                            </li>
                        </ul>
                    </li>
                    <li class="login">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="login-icon"></span>
                            Login
                        </a>
                        <ul class="dropdown-menu">
                            <form action="#" class="login-form">
                                <input type="text" class="login op-place" placeholder="Your email or login">
                                <input type="text" class="password op-place" placeholder="Your password">
                                <button class="btn login-btn">Log In</button>
                                <a href="#">Forgot you password?</a>
                                <hr>
                                <p>Don’t have an account?</p>
                                <button class="btn reg-btn">Register!</button>
                            </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>
        <section class="start-section">
            <div class="flex-mid">
                <h1>WEDDING <span>&amp;</span> EVENT <span>PLANNER</span></h1>
                <h2 class="slogan">Your wedding planning adventure starts here! Beautiful details. Inspiring ideas. Real weddings.</h2>
            </div>
        </section>
        <section class="search-prov">
            <h2>Search over 10 000 providers in over 10 countries</h2>
            <div class="container-custom">
                <div class="search-filter dropdown city">
                    <a data-toggle="dropdown" href="#">Your city</a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="#">Kharkov</a></li>
                        <li><a href="#">Kiev</a></li>
                        <li><a href="#">London</a></li>
                    </ul>
                </div>
                <div class="search-filter dropdown looking">
                    <a data-toggle="dropdown" href="#">Who are you looking for?</a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="#">Who are you looking for?</a></li>
                        <li><a href="#">Who are you looking for?</a></li>
                        <li><a href="#">Who are you looking for?</a></li>
                    </ul>
                </div>
                <div class="search-filter dropdown you-event">
                    <a data-toggle="dropdown" href="#">You event</a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="#">You event</a></li>
                        <li><a href="#">You event</a></li>
                        <li><a href="#">You event</a></li>
                    </ul>
                </div>
                <div class="search-filter dropdown date">
                    <a data-toggle="dropdown" href="#">Date</a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="#">Date</a></li>
                        <li><a href="#">Date</a></li>
                        <li><a href="#">Date</a></li>
                    </ul>
                </div>
                <div class="search">
                    <a href="#">Search</a>
                </div>
                <div class="clear"></div>
            </div>
        </section>
        <section class="categories">
            <h2>Our Categories</h2>
            <div class="section-desc">Discover hundreds of local providers recommended by <b>Wedding</b> <span>&amp;</span> <b>Event</b> Planner</div>
            <div class="categories-block container-custom">
                <ul class="categories-list">
                    <li>
                        <a href="#"><span class="categories-icon video"></span>Video</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon presenters"></span>Presenters</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon venues"></span>Venues</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon tech-support"></span>Technical support</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon mus-prog"></span>Music program</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon show-prog"></span>Show program</a>
                    </li>
                </ul>
                <ul class="categories-list">
                    <li>
                        <a href="#"><span class="categories-icon souvenirs"></span>Souvenirs</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon audio"></span>Audio</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon jewelery"></span>Jewelery</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon artists"></span>Artists</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon transport"></span>Transport</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon rent"></span>Rent</a>
                    </li>
                </ul>
                <ul class="categories-list">
                    <li>
                        <a href="#"><span class="categories-icon staff"></span>Staff</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon decor"></span>Design &amp; Decor</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon flowers"></span>Flowers</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon dj"></span>DJ</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon cakes"></span>Cakes and confectioner</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon men-clothing"></span>Men's Clothing</a>
                    </li>
                </ul>
                <ul class="categories-list">
                    <li>
                        <a href="#"><span class="categories-icon clothing-acces"></span>Clothing accessories</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon beauty"></span>Beauty and Health</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon dance-prog"></span>Dance program</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon photo"></span>Photography</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon catering"></span>Catering</a>
                    </li>
                    <li>
                        <a href="#"><span class="categories-icon other"></span>Other</a>
                    </li>
                </ul>
            </div>
        </section>
        <section class="most-popular">
            <h2>Most Popular</h2>
            <div class="section-desc">Discover hundreds of popular providers recommended by <b>Wedding</b> <span>&amp;</span> <b>Event</b> Planner</div>
            <div id="popular-carousel" class="providers-carousel carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="container-custom">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-1.png" alt="">
                                            <div class="caption">
                                                <span>Presenters</span>
                                                <div class="caption-heading">Кирилл Камышанский ведущий, тамада</div>
                                                <p>Автор и ведущий игры «Mad Heads» в Харькове. Частый гость на свадьбах. Ваши гости будут в восторге от Кирилла!</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-2.png" alt="">
                                            <div class="caption">
                                                <span>Cakes and confectioner</span>
                                                <div class="caption-heading">Анна Тарасенко — свадебный кондитер</div>
                                                <p>Гости по достоинству оценят наши кулинарные произведения. Неудивительно, ведь выпечка — это сытно и очень вкусно.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-3.png" alt="">
                                            <div class="caption">
                                                <span>Photography</span>
                                                <div class="caption-heading">Денис Панченко — фотожурналист</div>
                                                <p>Шеф-редактор портала Geometria.ru. Фотограф от Бога, который сделает ваши свадебные снимки незабываемыми.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="container-custom">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-1.png" alt="">
                                            <div class="caption">
                                                <span>Presenters</span>
                                                <div class="caption-heading">Кирилл Камышанский ведущий, тамада</div>
                                                <p>Автор и ведущий игры «Mad Heads» в Харькове. Частый гость на свадьбах. Ваши гости будут в восторге от Кирилла!</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-2.png" alt="">
                                            <div class="caption">
                                                <span>Cakes and confectioner</span>
                                                <div class="caption-heading">Анна Тарасенко — свадебный кондитер</div>
                                                <p>Гости по достоинству оценят наши кулинарные произведения. Неудивительно, ведь выпечка — это сытно и очень вкусно.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-3.png" alt="">
                                            <div class="caption">
                                                <span>Photography</span>
                                                <div class="caption-heading">Денис Панченко — фотожурналист</div>
                                                <p>Шеф-редактор портала Geometria.ru. Фотограф от Бога, который сделает ваши свадебные снимки незабываемыми.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="container-custom">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-1.png" alt="">
                                            <div class="caption">
                                                <span>Presenters</span>
                                                <div class="caption-heading">Кирилл Камышанский ведущий, тамада</div>
                                                <p>Автор и ведущий игры «Mad Heads» в Харькове. Частый гость на свадьбах. Ваши гости будут в восторге от Кирилла!</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-2.png" alt="">
                                            <div class="caption">
                                                <span>Cakes and confectioner</span>
                                                <div class="caption-heading">Анна Тарасенко — свадебный кондитер</div>
                                                <p>Гости по достоинству оценят наши кулинарные произведения. Неудивительно, ведь выпечка — это сытно и очень вкусно.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-3.png" alt="">
                                            <div class="caption">
                                                <span>Photography</span>
                                                <div class="caption-heading">Денис Панченко — фотожурналист</div>
                                                <p>Шеф-редактор портала Geometria.ru. Фотограф от Бога, который сделает ваши свадебные снимки незабываемыми.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Controls -->
                <a class="left control" href="#popular-carousel" data-slide="prev">
                    <span class=""></span>
                </a>
                <a class="right control" href="#popular-carousel" data-slide="next">
                    <span class=""></span>
                </a>
            </div>
        </section>
        <section class="video-section">
            <div class="video-heading">GREAT WEDDING ON SAFARI IN KRUGER NATIONAL PARK</div>
        </section>
        <section class="new-providers">
            <h2>New Providers</h2>
            <div class="section-desc">Discover hundreds of newest providers on <b>Wedding</b> <span>&amp;</span> <b>Event</b> Planner</div>
            <div id="providers-carousel" class="providers-carousel carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="container-custom">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-4.png" alt="">
                                            <div class="caption">
                                                <span>Flowers</span>
                                                <div class="caption-heading">Квитер — цветочная лавка</div>
                                                <p>Наш букет украсит любое радостное событие: свидание, свадьбу и просто поздравление близкого человека.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-5.png" alt="">
                                            <div class="caption">
                                                <span>Transport</span>
                                                <div class="caption-heading">ВИП-эскорт — прокат лимузинов</div>
                                                <p>Мы предоставим Вам VIP-лимузин, и шикарно доставим Ваших гостей в пункт назначения быстро и качественно.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-6.png" alt="">
                                            <div class="caption">
                                                <span>Catering</span>
                                                <div class="caption-heading">Летний кейтеринг, барбекю и пикники</div>
                                                <p>Мы можем удовлетворить даже самого взыскательного клиента! Обеспечим ваш летний отдых на природе всем необходимым!</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="container-custom">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-4.png" alt="">
                                            <div class="caption">
                                                <span>Flowers</span>
                                                <div class="caption-heading">Квитер — цветочная лавка</div>
                                                <p>Наш букет украсит любое радостное событие: свидание, свадьбу и просто поздравление близкого человека.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-5.png" alt="">
                                            <div class="caption">
                                                <span>Transport</span>
                                                <div class="caption-heading">ВИП-эскорт — прокат лимузинов</div>
                                                <p>Мы предоставим Вам VIP-лимузин, и шикарно доставим Ваших гостей в пункт назначения быстро и качественно.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-6.png" alt="">
                                            <div class="caption">
                                                <span>Catering</span>
                                                <div class="caption-heading">Летний кейтеринг, барбекю и пикники</div>
                                                <p>Мы можем удовлетворить даже самого взыскательного клиента! Обеспечим ваш летний отдых на природе всем необходимым!</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="container-custom">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-4.png" alt="">
                                            <div class="caption">
                                                <span>Flowers</span>
                                                <div class="caption-heading">Квитер — цветочная лавка</div>
                                                <p>Наш букет украсит любое радостное событие: свидание, свадьбу и просто поздравление близкого человека.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-5.png" alt="">
                                            <div class="caption">
                                                <span>Transport</span>
                                                <div class="caption-heading">ВИП-эскорт — прокат лимузинов</div>
                                                <p>Мы предоставим Вам VIP-лимузин, и шикарно доставим Ваших гостей в пункт назначения быстро и качественно.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="#">
                                            <div class="thumbnail-inner"></div>
                                            <img src="img/bitmap-6.png" alt="">
                                            <div class="caption">
                                                <span>Catering</span>
                                                <div class="caption-heading">Летний кейтеринг, барбекю и пикники</div>
                                                <p>Мы можем удовлетворить даже самого взыскательного клиента! Обеспечим ваш летний отдых на природе всем необходимым!</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Controls -->
                <a class="left control" href="#providers-carousel" data-slide="prev">
                    <span class=""></span>
                </a>
                <a class="right control" href="#providers-carousel" data-slide="next">
                    <span class=""></span>
                </a>
            </div>
        </section>
        <section class="providers-portfolio">
            <h2>Our Providers Portfolio</h2>
            <div class="section-desc">See what is our providers made for our customers</div>
            <div id="ri-grid" class="ri-grid ri-grid-size-2">
                <ul>
                    <li><a href="#"><img src="img/Providers-Portfolio/1.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/2.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/3.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/4.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/5.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/6.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/7.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/8.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/9.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/10.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/11.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/12.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/13.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/14.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/15.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/16.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/17.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/18.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/19.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/20.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/21.png"/></a></li>
                    <li><a href="#"><img src="img/Providers-Portfolio/22.png"/></a></li>
                </ul>
            </div>
        </section>
    </div>
@endsection