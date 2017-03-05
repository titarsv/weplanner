@extends('public.layouts.main', ['partition' => 'about', 'wrapper_class' => 'about'])
@section('meta')
    <title>О компании Weplanner</title>
    <meta name="description" content="О компании Weplanner">
@endsection

@section('content')
    <section class="start-section">
        <div class="flex-mid">
            <h1>WEDDING <span>&amp;</span> EVENT <span>PLANNER</span></h1>
            <h2 class="slogan">We are your happy wedding!</h2>
        </div>
    </section>
    <section class="capabilities">
        <h2>Our Capabilities</h2>
        <div class="section-desc">6 reasons you need to work with <b>Wedding</b> <span>&amp;</span> <b>Event</b> Planner</div>
        <ul class="reason container-custom">
            <li>
                <div class="circle">
                    <span>1</span>
                </div>
                <p>Great reason number one</p>
            </li>
            <li>
                <div class="circle">
                    <span>2</span>
                </div>
                <p>Great reason number one</p>
            </li>
            <li>
                <div class="circle">
                    <span>3</span>
                </div>
                <p>Great reason number one</p>
            </li>
            <li>
                <div class="circle">
                    <span>4</span>
                </div>
                <p>Great reason number one</p>
            </li>
            <li>
                <div class="circle">
                    <span>5</span>
                </div>
                <p>Great reason number one</p>
            </li>
            <li>
                <div class="circle">
                    <span>6</span>
                </div>
                <p>Great reason number one</p>
            </li>
        </ul>
    </section>
    <section class="our-offer">
        <h2>What we can do for you</h2>
        <div class="section-desc"><b>Wedding</b> <span>&amp;</span> <b>Event</b> Planner it’s your best partner to make unforgettable event</div>
        <div class="container-custom">
            <div class="our-offer-item">
                <h3>An unforgettable experience</h3>
                <div class="offer-icon">
                    <img src="/img/ic-drum.png" alt="">
                </div>
                <div class="offer-info">
                    <p>Plan your big day at our Richmond, VA wedding venue that offers delectable dining options, knowledgeable event professionals and serene surroundings.</p>
                    <span><b>Tisha Cuffee,</b> Wedding Specialist</span>
                    <span>Phone: 804-282-8444 ext. 4909</span>
                    <a href="mailto:info@westinrichmond.com">info@westinrichmond.com</a>
                </div>
            </div>
            <div class="our-offer-item">
                <h3>Culinary expertise</h3>
                <div class="offer-icon">
                    <img src="/img/ic-cupcake.png" alt="">
                </div>
                <div class="offer-info">
                    <p>Our experienced and professional catering and culinary staff are also available to create custom menus and packages for your reception. You may choose to enhance your event with:</p>
                    <ul>
                        <li>Custom ice carvings and sculptures</li>
                        <li>Chocolate fountain</li>
                        <li>Upgrade to a premium bar</li>
                        <li>Wine service with dinner</li>
                    </ul>
                </div>
            </div>
            <div class="our-offer-item">
                <h3>Rehearsal Dinner Venue</h3>
                <div class="offer-icon">
                    <img src="/img/ic-balloons.png" alt="">
                </div>
                <div class="offer-info">
                    <p>Begin your wedding weekend with a Rehearsal Dinner at Crossings Restaurant, Bar and Lounge. Relax and replenish at our Crossings located in downtown Richmond, VA.</p>
                </div>
            </div>
            <div class="our-offer-item">
                <h3>Let us be your guide</h3>
                <div class="offer-icon">
                    <img src="/img/ic-champagne.png" alt="">
                </div>
                <div class="offer-info">
                    <p>Your dining experience will be unforgettable as you refresh your palate with unique menu items and enticing cocktails at our AAA ranked restaurant. Table linens of any color to create a unique an memorable.</p>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </section>
    <section class="reviews">
        <h2>What our clients says</h2>
        <hr>
        <div id="carousel-reviews" class="carousel-reviews carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-reviews" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-reviews" data-slide-to="1"></li>
                <li data-target="#carousel-reviews" data-slide-to="2"></li>
                <li data-target="#carousel-reviews" data-slide-to="3"></li>
                <li data-target="#carousel-reviews" data-slide-to="4"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="quote-block">
                        <div class="quote">
                            <p>Важным шагом в поисках своего оригинального стиля, идеального гардероба и формирования имиджа стиля является анализ и разбор гардероба. Именно он может многое рассказать о человеке</p>
                            <span class="q top"></span>
                            <span class="q bot"></span>
                        </div>
                        <div class="quote-img">
                            <img src="/img/userpick.jpg" class="img-circle" alt="">
                        </div>
                        <div class="quote-name">Эвелина Хромченко</div>
                        <span>Модный стилист</span>
                        <hr>
                    </div>
                </div>
                <div class="item">
                    <div class="quote-block">
                        <div class="quote">
                            <p>Важным шагом в поисках своего оригинального стиля, идеального гардероба и формирования имиджа стиля является анализ и разбор гардероба. Именно он может многое рассказать о человеке</p>
                            <span class="q top"></span>
                            <span class="q bot"></span>
                        </div>
                        <div class="quote-img">
                            <img src="/img/userpick.jpg" class="img-circle" alt="">
                        </div>
                        <div class="quote-name">Эвелина Хромченко</div>
                        <span>Модный стилист</span>
                        <hr>
                    </div>
                </div>
                <div class="item">
                    <div class="quote-block">
                        <div class="quote">
                            <p>Важным шагом в поисках своего оригинального стиля, идеального гардероба и формирования имиджа стиля является анализ и разбор гардероба. Именно он может многое рассказать о человеке</p>
                            <span class="q top"></span>
                            <span class="q bot"></span>
                        </div>
                        <div class="quote-img">
                            <img src="/img/userpick.jpg" class="img-circle" alt="">
                        </div>
                        <div class="quote-name">Эвелина Хромченко</div>
                        <span>Модный стилист</span>
                        <hr>
                    </div>
                </div>
                <div class="item">
                    <div class="quote-block">
                        <div class="quote">
                            <p>Важным шагом в поисках своего оригинального стиля, идеального гардероба и формирования имиджа стиля является анализ и разбор гардероба. Именно он может многое рассказать о человеке</p>
                            <span class="q top"></span>
                            <span class="q bot"></span>
                        </div>
                        <div class="quote-img">
                            <img src="/img/userpick.jpg" class="img-circle" alt="">
                        </div>
                        <div class="quote-name">Эвелина Хромченко</div>
                        <span>Модный стилист</span>
                        <hr>
                    </div>
                </div>
                <div class="item">
                    <div class="quote-block">
                        <div class="quote">
                            <p>Важным шагом в поисках своего оригинального стиля, идеального гардероба и формирования имиджа стиля является анализ и разбор гардероба. Именно он может многое рассказать о человеке</p>
                            <span class="q top"></span>
                            <span class="q bot"></span>
                        </div>
                        <div class="quote-img">
                            <img src="/img/userpick.jpg" class="img-circle" alt="">
                        </div>
                        <div class="quote-name">Эвелина Хромченко</div>
                        <span>Модный стилист</span>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <div id="carousel-img" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="/img/video-back2x.png" alt="">
                    <div class="video-heading">GREAT WEDDING ON SAFARI IN KRUGER NATIONAL PARK</div>
                </div>
                <div class="item">
                    <img src="/img/video-back2x.png" alt="">
                    <div class="video-heading">GREAT WEDDING ON SAFARI IN KRUGER NATIONAL PARK</div>
                </div>
                <div class="item">
                    <img src="/img/video-back2x.png" alt="">
                    <div class="video-heading">GREAT WEDDING ON SAFARI IN KRUGER NATIONAL PARK</div>
                </div>
            </div>
            <!-- Controls -->
            <a class="left control" href="#carousel-img" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right control" href="#carousel-img" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </section>
@endsection