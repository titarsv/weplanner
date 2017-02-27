@extends('public.layouts.main')
@section('meta')
    <title>О компании</title>
    <meta name="description" content="О компании">
    <meta name="keywords" content="О компании">
@endsection

@section('content')
    <section class="main-content">
        <div class="container">

            <div class="main-sidebar">
                <div class="filters">

                    @include('public.layouts.sidebar-menu')

                    <div class="tabs">
                        <ul class="cat_menu-list about-tabs-caption">
                            <li class="cat_menu-item about-tabs-caption__item active">
                                <a href="#" class="cat_menu-link">Доставка и оплата</a>
                            </li>
                            <li class="cat_menu-item about-tabs-caption__item">
                                <a href="#" class="cat_menu-link">О нас</a>
                            </li>
                            <li class="cat_menu-item about-tabs-caption__item">
                                <a href="#" class="cat_menu-link" id="defect">Сервис дефектовки</a>
                            </li>
                            <li class="cat_menu-item about-tabs-caption__item">
                                <a href="#" class="cat_menu-link" id="cooperation">Сотрудничество с нами</a>
                            </li>
                            <li class="cat_menu-item about-tabs-caption__item">
                                <a href="#" class="cat_menu-link">Вопросы и ответы</a>
                            </li>
                            <li class="cat_menu-item about-tabs-caption__item">
                                <a href="#" class="cat_menu-link">Гарантия</a>
                            </li>
                            <li class="cat_menu-item about-tabs-link">
                                <a href="/contacts" class="cat_menu-link">Контакты</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="main-wrapper about">
                <div class="search-block" style="padding-bottom: 30px">
                    <input class="search" type="text" placeholder="Поиск">
                    <button class="search_btn">Поиск</button>
                    {{--<div class="search-example-block">--}}
                        {{--например: <span class="search-example">косилка для мтз</span>--}}
                    {{--</div>--}}
                </div>

                <article class="tabs-content active">
                    <span class="trust-title">Способы оплаты</span>
                    <ul class="about-delivery__list clearfix">
                        <li class="about-delivery__item">
							<span class="about-delivery__icon-wrap">
								<span class="about-delivery__icon about-delivery__icon_cash"></span>
							</span>
                            <span class="about-delivery__text">Наличными</span>
                        </li>
                        <li class="about-delivery__item">
							<span class="about-delivery__icon-wrap">
								<span class="about-delivery__icon about-delivery__icon_nds"></span>
							</span>
                            <span class="about-delivery__text">Безналичными с ндс и без ндс</span>
                        </li>
                        <li class="about-delivery__item">
							<span class="about-delivery__icon-wrap">
								<span class="about-delivery__icon about-delivery__icon_visa"></span>
							</span>
                            <span class="about-delivery__text">Visa/Mastercard</span>
                        </li>
                    </ul>
                    <span class="trust-title">Способы доставки</span>
                    <ul class="about-delivery__list clearfix">
                        <li class="about-delivery__item">
							<span class="about-delivery__icon-wrap">
								<span class="about-delivery__icon about-delivery__icon_curier"></span>
							</span>
                            <span class="about-delivery__text">Курьером<br> по Харькову и области</span>
                        </li>
                        <li class="about-delivery__item">
							<span class="about-delivery__icon-wrap">
								<span class="about-delivery__icon about-delivery__icon_track"></span>
							</span>
                            <span class="about-delivery__text">По Украине курьерскими службами и совместная доставка</span>
                        </li>
                    </ul>
                </article>

                {{--<article class="tabs-content">--}}
                    {{--<span class="trust-title">О нас</span>--}}
                    {{--<ul class="aboutus-list">--}}
                        {{--<li class="aboutus-list__item">--}}
                            {{--Полный спектр техники для заготовки кормов в животноводстве.--}}
                        {{--</li>--}}
                        {{--<li class="aboutus-list__item">--}}
                            {{--Техника для заготовки сена, сенажа, зеленых кормов производства Польши, Словении, Беларуси (косилки, грабли, пресс-подборщики, прицепы-подборщики, кормосмесители, линии комбикормовые).--}}
                        {{--</li>--}}
                        {{--<li class="aboutus-list__item">--}}
                            {{--Запчасти к с/х технике: на пресс-подборщики ПРФ-145, ПРФ-180, бочки МЖТ, грабли ГВР-630, ГВК-6, ГВР-6Р, косилки Z-169, Z-173, КДН-210, Л-501, кормораздатчики РСК-12, КТУ-10А, Силокинг, измельчители соломы ИРК-145--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{--<span class="trust-title">О нас в цифрах</span>--}}
                    {{--<ul class="about-number">--}}
                        {{--<li class="about-number__item">--}}
                            {{--<span class="about-number__title">8</span>--}}
                            {{--<span class="about-number__text">лет на рынке</span>--}}
                        {{--</li>--}}
                        {{--<li class="about-number__item">--}}
                            {{--<span class="about-number__title">10000</span>--}}
                            {{--<span class="about-number__text">доступных к покупке товаров</span>--}}
                        {{--</li>--}}
                        {{--<li class="about-number__item">--}}
                            {{--<span class="about-number__title">82%</span>--}}
                            {{--<span class="about-number__text">наших покупателей возвращаются</span>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{--<span class="trust-title">Наши клиенты</span>--}}
                    {{--<div class="clients-slider">--}}
                        {{--<div class="slide">--}}
                            {{--<div class="clients-slider__item">--}}
                                {{--<img src="img/client_1.jpg" alt="" class="clients-slider__logo">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="slide">--}}
                            {{--<div class="clients-slider__item">--}}
                                {{--<img src="img/client_2.jpg" alt="" class="clients-slider__logo">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="slide">--}}
                            {{--<div class="clients-slider__item">--}}
                                {{--<img src="img/client_3.jpg" alt="" class="clients-slider__logo">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="slide">--}}
                            {{--<div class="clients-slider__item">--}}
                                {{--<img src="img/client_4.jpg" alt="" class="clients-slider__logo">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="slide">--}}
                            {{--<div class="clients-slider__item">--}}
                                {{--<img src="img/client_1.jpg" alt="" class="clients-slider__logo">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<span class="trust-title">Отзывы наших клиентов</span>--}}
                    {{--<div class="review-slider">--}}
                        {{--<div class="slide">--}}
                            {{--<a href="img/review_1.jpg" class="review-slider__item popup-img">--}}
                                {{--<img src="img/review_1.jpg" alt="" class="review-slider__img">--}}
                                {{--<img src="icons/search_icon.svg" alt="" class="review-slider__icon">--}}
                            {{--</a>--}}
                        {{--</div>--}}
                        {{--<div class="slide">--}}
                            {{--<a href="img/review_1.jpg" class="review-slider__item popup-img">--}}
                                {{--<img src="img/review_1.jpg" alt="" class="review-slider__img">--}}
                                {{--<img src="icons/search_icon.svg" alt="" class="review-slider__icon">--}}
                            {{--</a>--}}
                        {{--</div>--}}
                        {{--<div class="slide">--}}
                            {{--<a href="img/review_1.jpg" class="review-slider__item popup-img">--}}
                                {{--<img src="img/review_1.jpg" alt="" class="review-slider__img">--}}
                                {{--<img src="icons/search_icon.svg" alt="" class="review-slider__icon">--}}
                            {{--</a>--}}
                        {{--</div>--}}
                        {{--<div class="slide">--}}
                            {{--<a href="img/review_1.jpg" class="review-slider__item popup-img">--}}
                                {{--<img src="img/review_1.jpg" alt="" class="review-slider__img">--}}
                                {{--<img src="icons/search_icon.svg" alt="" class="review-slider__icon">--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="delivery-condition">--}}
                        {{--<span class="trust-title">Удобная доставка <br><strong>по Украине</strong></span>--}}
                        {{--<div class="delivery-condition__link-wrap">--}}
                            {{--<a href="#" class="delivery-condition__link">--}}
                                {{--<img src="img/delivery-condition_ico.png" alt="" class="delivery-condition__ico">--}}
                                {{--Условия доставки--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="delivery-adress clearfix">--}}
                        {{--<div class="delivery-adress-text">--}}
                            {{--<span class="trust-title">Адресс</span>--}}
                            {{--<span class="delivery-adress__descr">Харьков ул. Дудинской 6в офис 54</span>--}}
                            {{--<a href="#" class="delivery-adress__link">Контакты</a>--}}
                        {{--</div>--}}
                        {{--<div class="delivery-adress-map">--}}
                            {{--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2565.7038814853795!2d36.17458731606034!3d49.97941157941314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4127a1b6093b3ef1%3A0xdc0db7c6e51a46f5!2z0LLRg9C70LjRhtGPINCU0YPQtNC40L3RgdGM0LrQvtGXLCA2LCA1NCwg0KXQsNGA0LrRltCyLCDQpdCw0YDQutGW0LLRgdGM0LrQsCDQvtCx0LvQsNGB0YLRjCwg0KPQutGA0LDQuNC90LA!5e0!3m2!1sru!2sru!4v1484125155687" width="100%" height="224" frameborder="0" style="border:0" allowfullscreen></iframe>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</article>--}}

                <article class="tabs-content">
                    {{--<span class="trust-title">9 Фактов о нас</span>--}}
                    <h2>Активный участник выставок</h2>
                    <img src="/img/waertq3.jpg" alt="Активный участник выставок" style="width: 100%">
                    <span>ВерхАгро постоянный участник ежегодных специализированных сельскохозяйственных выставок:</span>
                    <ul>
                        <li>Интерагро</li>
                        <li>AGROPORT</li>
                        <li>Зерновые технологии</li>
                    </ul>
                    <span>Посещаем международные выставки с целью выявления новых технологий и внедряем их на территории Украины.</span>

                    <h2>Мы профессионалы</h2>
                    <div style="width: 100%; float: left;">
                    <img src="/img/aswfdet.jpg" alt="Мы профессионалы" style="float: left; width: 200px;">
                    <span style="padding-top: 45px; display: block;">Наши менеджеры эксперты с опытом более 10 лет.  Мы предложим несколько аналогов товара, опишем их преимущества и недостатки.</span>
                    </div>

                    <h2>Бонусы для постоянных клиентов</h2>
                    <div style="width: 100%; float: left;">
                        <img src="/img/rghysrdhygxdrfg.png" alt="Бонусы для постоянных клиентов" style="float: left; width: 150px; margin: 0 25px;">
                        <ul style="padding-top: 60px;">
                            <li>Организовываем экскурсии на заводы для постоянных клиентов.</li>
                            <li>В благодарность за сотрудничество дарим фирменные жилетки.</li>
                        </ul>
                    </div>

                    <h2>История компании</h2>
                    <div style="width: 100%; float: left;">
                        <img src="/img/tjdrfgszefs.jpg" alt="История компании" style="float: left; width: 200px;">
                        <p>Компания ООО «ВерхАгро» существует  на аграрном рынке с  2010 года. Специализируется в сфере торговли сельхозтехникой, производстве и торговле  запчастями к ней, а также продаже расходных материалов, которые используются при заготовке и хранении кормов для  животноводства. </p>
                    </div>
                    {{--<ul>--}}
                        {{--<li>Фото документов компании</li>--}}
                    {{--</ul>--}}

                    <h2>Кто наши клиенты</h2>
                    <img src="/img/gsrdhbfcxyjnxd.jpg" alt="Кто наши клиенты" style="width: 100%; margin: 15px 0;">
                    <span>Услугами нашей организации  пользуются крупные аграрии и агрофирмы, с которыми партнерские отношения переросли в дружеские, т.к. мы преследуем цель – обеспечить сельскохозяйственные предприятия качественной и эффективной техникой. </span>
                    <span><a href="#" onclick="$('#cooperation').trigger('click');" style="font-weight: 700;color: #000;text-decoration: underline;">Условия сотрудничества</a></span>

                    <h2>На чем мы специализируемся</h2>
                    <div style="width: 100%; float: left;">
                        <img src="/img/sfdgsdfgsd.png" alt="На чем мы специализируемся" style="float: left; width: 200px;">
                        <ul>
                            <li>Техника для заготовки и раздачи кормов в животноводствеиз СНГ и Европы</li>
                            <li>Техника для заготовки сена, сенажа, силоса из СНГ и Европы</li>
                            <li>Запчасти к сельхозтехникеиз СНГ и Европы</li>
                            <li>Биоконсервант ЛАКТИС  поможет получить корм первого класса, что в свою очередь приведет к росту в животноводстве.</li>
                            <li>Предоставляем услуги по <a href="#" onclick="$('#defect').trigger('click');">ремонту техники</a>: миксера-кормораздатчики, косилки, грабли, пресс-подборщики, реконструкция шнеков. Проводим  фрезерные и токарные работы.</li>
                        </ul>
                    </div>

                    <h2>Почему выбирают нас</h2>
                    <div style="width: 100%; float: left;">
                        <img src="/img/sdfsgsadgdg.jpg" alt="На чем мы специализируемся" style="float: left; width: 150px; margin: 0 25px;">
                        <ul style="padding-top: 47px;">
                            <li>Более 2000 постоянных клиентов и число их постоянно растет.</li>
                            <li>82% клиентов вернулись за новыми товарами</li>
                            <li>95% клиентов фермерские хозяйства Харькова и Украины</li>
                        </ul>
                    </div>

                    <p>Находимся по адресу г. Харьков ул. Дудинской, 1А</p>

                </article>

                {{--<article class="tabs-content">--}}
                    {{--<span class="trust-title">Сервис дефектовки</span>--}}
                    {{--<div class="defects-top clearfix">--}}
                        {{--<div class="defects-top-text">--}}
                            {{--<span class="defects-top__title">При заказе запчастей Дефектовка</span>--}}
                            {{--<span class="defects-top__title defects-top__title_accent">бесплатно!</span>--}}
                        {{--</div>--}}
                        {{--<img src="img/defects-top.jpg" alt="" class="defects-top__img">--}}
                    {{--</div>--}}
                    {{--<div class="defect-main">--}}
                        {{--<p>Мы желаем, чтобы вся имеющиеся у Вас техника служила Вам максимально долго.</p>--}}
                        {{--<p>Это мечта любого главного инженера. Она осуществится, если подойти к делу основательно и заблаговременно.</p>--}}
                        {{--<p>В разгар проведения посевных или уборочных кампаний вдруг выходит из строя сразу несколько единиц техники. Ситуация неприятная, если не сказать катастрофическая. Поджимают сроки, необходим срочный ремонт, который явно влетит в копеечку, а самое главное — в голове один и тот же вопрос: как же могло такое случиться? Техническое обслуживание проведено вовремя, все показатели были в норме, но поломка оказалась неизбежной. К сожалению, такие ситуации — не редкость. И единственной рекомендацией по их предотвращению может быть регулярное использование услуги по дефектовке техники.</p>--}}
                        {{--<p>Дефектовка техники предполагает полную диагностику оборудования и выявление всех возможных причин выхода из строя тех или иных деталей и технологических комплектов. В процессе проведения данной операции специалисты пользуются <strong>разнообразными методами:</strong></p>--}}
                        {{--<ul class="about-delivery__list about-delivery__list_defects clearfix">--}}
                            {{--<li class="about-delivery__item">--}}
								{{--<span class="about-delivery__icon-wrap">--}}
									{{--<span class="about-delivery__icon about-delivery__icon_visual"></span>--}}
								{{--</span>--}}
                                {{--<span class="about-delivery__text">Визуальными</span>--}}
                            {{--</li>--}}
                            {{--<li class="about-delivery__item">--}}
								{{--<span class="about-delivery__icon-wrap">--}}
									{{--<span class="about-delivery__icon about-delivery__icon_measuring"></span>--}}
								{{--</span>--}}
                                {{--<span class="about-delivery__text">Измерительным</span>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                        {{--<p>Оказывать услуги по дефектовке техники начинают с визуального осмотра, при котором возможно определить видимые повреждения механизмов.</p>--}}
                        {{--<p>При помощи измерительных приборов специалисты контролируют степень износа деталей, упругость пружин, балансировку и т.п.</p>--}}
                        {{--<p>Кроме получения данных о техническом состоянии машины, дефектовка техники также дает возможность оценить стоимость ремонтных работ, их длительность и сложность.</p>--}}
                        {{--<p>Наши специалисты при помощи современного оборудования предоставят Вам качественные услуги по дефектовке техники. И Вы сможете быть уверенны в бесперебойной работе машин на протяжении всего времени их эксплуатации.</p>--}}
                    {{--</div>--}}
                {{--</article>--}}

                <article class="tabs-content">
                    <span class="trust-title">Сервис дефектовки</span>
                    <img src="/img/wawfgasfsd.png" alt="Сервис дефектовки" style="float: left; width: 200px;">
                    <div class="defect-main" style="padding: 68px 0;">
                        <p>Наша компания предлагает услугу обслуживания Вашей техники под ключ с бесплатным устранением поломок в период гарантии.</p>
                        <p>У Вас нет необходимости содержать механизатора техники на постоянной основе.</p>
                        <p>Мы обеспечим Вашу технику необходимыми запчастями в срок.</p>
                    </div>

                    <h2>Обеспечим максимальный результат в сезон</h2>
                    <div style="width: 100%; float: left;">
                        <img src="/img/rgsdhgbad.jpg" alt="На чем мы специализируемся" style="float: left; width: 150px; margin: 0 25px;">
                        <p>Предсезонное проведение дефектовки у нас позволяет подготовить технику к работе, заказать запчасти, которые изготавливаются под заказ и получить их в течении недели. Таким образом,Вы выпустите в поле уже проверенную технику и  вероятность поломки в процессе работы сводится к минимуму. Мы заинтересованы в Вашем успехе.</p>
                    </div>

                    <h2>Что мы гарантируем нашим клиентам</h2>
                    <div style="width: 100%; float: left;">
                        <img src="/img/kjgjhdzg.jpg" alt="На чем мы специализируемся" style="float: left; width: 150px; margin: 0 25px 50px;">
                        <ul>
                            <li>Исправность техники, которая обеспечит бесперебойно и всрок выполнять намеченный объем работ:урожай собирается своевременно и без потерь( перестоев, пересушки, обсыпании злаков )</li>
                            <li>Экономию денег на ремонте</li>
                            <li>Уменьшение простоя техники на 20-40%</li>
                            <li>Мы несем ответственность за все работы</li>
                            <li>Рост эффективности техники</li>
                        </ul>
                    </div>

                    <h2>Варианты сотрудничества</h2>
                    <div style="width: 100%; float: left;">
                        <img src="/img/Shftxjndfx.jpg" alt="На чем мы специализируемся" style="float: left; width: 180px; margin: 35px 10px;">
                        <ol>
                            <li>Вы самостоятельно проводитедефектовку и передаете нам заказ.</li>
                            <li>Заключаем договор, к вам приезжает наш человек проводит осмотр и выявляет неисправности, предоставляет отчет, обеспечивает ремонт, Вы получаете гарантию на детали, в случае поломки, которые будут заменены бесплатно.</li>
                        </ol>

                        <p>Для того чтобы начать сотрудничество заполните бланк заявки и свяжитесь с нами по телефонам</p>
                    </div>
                </article>

                {{--<article class="tabs-content">--}}
                    {{--<span class="trust-title">Сотрудничество с нами</span>--}}
                    {{--<ul class="cooperations-anchors">--}}
                        {{--<li class="cooperations-anchors__item">--}}
                            {{--<a href="#cooperations-block_1" class="cooperations-anchors__link">Поставщикам</a>--}}
                        {{--</li>--}}
                        {{--<li class="cooperations-anchors__item">--}}
                            {{--<a href="#cooperations-block_2" class="cooperations-anchors__link">Владельцам магазинов</a>--}}
                        {{--</li>--}}
                        {{--<li class="cooperations-anchors__item">--}}
                            {{--<a href="#cooperations-block_3" class="cooperations-anchors__link">Ответственным за сельхозтехнику</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{--<p>Компания ВерАгро на рынке с 2008 года, зарекомендовала себя как надежный партнер и поставщик запчастей для сельхозтехники. Работая с нами Вы можете быть уверены в качестве продукции, сроках поставки, ответственности и профессионализме.</p>--}}
                    {{--<div class="cooperations-block" id="cooperations-block_1">--}}
                        {{--<span class="trust-title">Поставщикам</span>--}}
                        {{--<span class="cooperations-block__text">Наша компания открыта для предложений. Главным условием является качество Ваших товаров.</span>--}}
                        {{--<ul class="cooperations-block__list">--}}
                            {{--<li>У нас более 2000 постоянных клиентов и число их постоянно растет</li>--}}
                            {{--<li>82% клиентов вернулись за новыми товарами</li>--}}
                            {{--<li>95% клиентов фермерские хозяйства Харькова и Украины</li>--}}
                        {{--</ul>--}}
                        {{--<ul class="main-footer__phones">--}}
                            {{--<li class="main-footer__phones-item">(800) 500 32 11</li>--}}
                            {{--<li class="main-footer__phones-item">(057) 987 32 11</li>--}}
                            {{--<li class="main-footer__phones-item">(097) 321 32 11</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="cooperations-block" id="cooperations-block_2">--}}
                        {{--<span class="trust-title">Владельцам магазинов и партнерам</span>--}}
                        {{--<span class="cooperations-block__text">Если ваш магазин соответствует нашей тематике, предлагаем сотрудничество по дропшипингу</span>--}}
                        {{--<ul class="main-footer__phones">--}}
                            {{--<li class="main-footer__phones-item">(800) 500 32 11</li>--}}
                            {{--<li class="main-footer__phones-item">(057) 987 32 11</li>--}}
                            {{--<li class="main-footer__phones-item">(097) 321 32 11</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="cooperations-block" id="cooperations-block_3">--}}
                        {{--<span class="trust-title">Ответственным за сельхозтехнику</span>--}}
                        {{--<span class="cooperations-block__text">Заключим с вами договор и будем предоставлять услугу дефектовки бесплатно</span>--}}
                        {{--<ul class="main-footer__phones">--}}
                            {{--<li class="main-footer__phones-item">(800) 500 32 11</li>--}}
                            {{--<li class="main-footer__phones-item">(057) 987 32 11</li>--}}
                            {{--<li class="main-footer__phones-item">(097) 321 32 11</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</article>--}}

                <article class="tabs-content">
                    <span class="trust-title">Сотрудничество с нами</span>
                    <ul class="cooperations-anchors" style="list-style-type: none; padding-left: 0;">
                        <li class="cooperations-anchors__item">
                            <a href="#cooperations-block_1" class="cooperations-anchors__link">Поставщикам</a>
                        </li>
                        <li class="cooperations-anchors__item">
                            <a href="#cooperations-block_2" class="cooperations-anchors__link">Владельцам магазинов</a>
                        </li>
                        <li class="cooperations-anchors__item">
                            <a href="#cooperations-block_3" class="cooperations-anchors__link">Ответственным за сельхозтехнику</a>
                        </li>
                    </ul>
                    <p>Компания ВерАгро на рынке с 2010 года, зарекомендовала себя как надежный партнер и поставщик запчастей и  сельхозтехники. Работая с нами Вы можете быть уверены в качестве продукции, сроках поставки, ответственности и профессионализме.</p>
                    <div class="cooperations-block" id="cooperations-block_1">
                        <span class="trust-title">Поставщикам</span>
                        <span class="cooperations-block__text">Наша компания открыта для предложений. Главным условием является качество Ваших товаров.</span>
                        <ul class="cooperations-block__list" style="padding-left: 40px;">
                            <li>Наша компания открыта для предложений. Главным условием является качество Ваших товаров</li>
                            <li>82% клиентов вернулись за новыми товарами. С нами удобно.</li>
                            <li>95% клиентов фермерские хозяйства Харькова и Украины</li>
                        </ul>
                        <ul class="main-footer__phones" style="list-style-type: none; padding-left: 40px;">
                            <li class="main-footer__phones-item">(800) 500 32 11</li>
                            <li class="main-footer__phones-item">(057) 987 32 11</li>
                            <li class="main-footer__phones-item">(097) 321 32 11</li>
                        </ul>
                    </div>
                    <div class="cooperations-block" id="cooperations-block_2">
                        <span class="trust-title">Владельцам магазинов и партнерам</span>
                        <span class="cooperations-block__text">Если ваш магазин соответствует нашей тематике, предлагаем сотрудничество по дропшипингу</span>
                        <ul class="main-footer__phones" style="list-style-type: none; padding-left: 40px;">
                            <li class="main-footer__phones-item">(800) 500 32 11</li>
                            <li class="main-footer__phones-item">(057) 987 32 11</li>
                            <li class="main-footer__phones-item">(097) 321 32 11</li>
                        </ul>
                        <p>Рекомендуйте наш магазин, если клиент совершит покупку, Вы получите вознаграждение. Для этого необходимо, чтобы покупатель сообщил Ваше Имя и телефон при оформлении заказа менеджеру. Тогда мы свяжемся с Вами, договоримся об удобной для Вас форме вознаграждения. Мы заинтересованы в росте популярности нашего магазина, поэтому обязательно свяжемся с Вами, чтобы отблагодарить.</p>
                    </div>
                    <div class="cooperations-block" id="cooperations-block_3">
                        <span class="trust-title">Ответственным за сельхозтехнику</span>
                        <span class="cooperations-block__text">Заключим с вами договор и будем предоставлять услугу <a href="#" onclick="$('#defect').trigger('click');">дефектовки</a>. В случае выхода из строя деталей в период гарантии заменяем на новые бесплатно</span>
                        <ul class="main-footer__phones" style="list-style-type: none; padding-left: 40px;">
                            <li class="main-footer__phones-item">(800) 500 32 11</li>
                            <li class="main-footer__phones-item">(057) 987 32 11</li>
                            <li class="main-footer__phones-item">(097) 321 32 11</li>
                        </ul>
                    </div>
                </article>

                <article class="tabs-content">
                    <span class="trust-title">Вопросы и ответы</span>
                    <ul class="faq-list">
                        <li class="faq-list_item">
                            Какие сроки выполнения заказа после его оплаты?
                            <span class="faq-list_item-txt">В зависимости от наличия товара на складе заказ выполняется в течении одного–трехдней. Если запчасть делается под заказ, связываемся с Вами и обгововариваемприемлимые для Вас сроки. Большая часть запчастей находится на наших складах.</span>
                        </li>
                        <li class="faq-list_item">
                            Вы предоставляете послегарантийное обслуживание продаваемой техники?
                            <span class="faq-list_item-txt">Да, мы производим послегарантийное обслуживание техники.</span>
                        </li>
                        <li class="faq-list_item">
                            Я могу купить сельхоззапчати в  рассрочку? Что для этого нужно?
                            <span class="faq-list_item-txt">Вы можете купить сельхоззапчати в  рассрочку. Обращайтесь и мы обсудим возможные сроки рассрочки.</span>
                        </li>
                        <li class="faq-list_item">
                            Сейчас много мошенников в сети Интернет, почему мне доверять вам?
                            <span class="faq-list_item-txt">Магазин ВерхАгро работает официально, прозрачно и открыто. Мы выдаем все необходимые документы и гарантийные свидетельства. Вы всегда можете прийти к нам по адресу: </span>
                            <div class="faq-list_item-address">г. Харьков ул. Дудинськой, 6</div>
                        </li>
                        <li class="faq-list_item">
                            Вы работаете под заказ? Я могу заказать технику или комплектующие, которой нет у вас в прайсе?
                            <span class="faq-list_item-txt">Мы все время стараемся пополнять наш каталог товаров, но также мы работаем и под заказ. Свяжитесь с нами и мы достанем нужную Вам технику или комплектующие.</span>
                        </li>
                        <li class="faq-list_item">
                            Весь товар в наличии? Когда я получу его с момента оплаты?
							<span class="faq-list_item-txt">Подавляющая часть товара в наличии и мы все время следим за нашим ассортиментом. Получив заказ, мы стараемся в кратчайшие сроки выполнить его. Но лучше всего позвонить нам и получить всю информацию по интересующему вас товару у менеджера.</span>
                        </li>
                        <li class="faq-list_item">
                            Я знаю, что мне нужно, но немного теряюсь в характеристиках техники при выборе. Могу ли я получить консультацию?
                            <span class="faq-list_item-txt">Конечно! Звоните или пишете и наши консультанты интернет-магазина ВерхАгро всегда с радостью помогут Вам. Мы работаем и в выходные дни.</span>
                        </li>
                    </ul>
                </article>

                <article class="tabs-content">
                    <span class="trust-title">Гарантия и сервисное обслуживание</span>
                    <ul class="faq-list">
                        <li class="faq-list_item">
                            На какие товары предоставляется гарантия?
                            <span class="faq-list_item-txt">На товары в нашем магазине предоставляется гарантия, подтверждающая обязательства по отсутствию в товаре заводских дефектов. Гарантия предоставляется на срок от 2-х недель до 99 месяцев в зависимости от сервисной политики производителя.</span>
                        </li>
                        <li class="faq-list_item">
                            Куда обращаться за гарантийным обслуживанием?
                            <span class="faq-list_item-txt">Гарантийным обслуживанием занимается наша сервисная служба.</span>
                            <span class="faq-list_item-txt">Адреса и телефоны указаны на нашем сайте</span>
                        </li>
                        <li class="faq-list_item">
                            Я могу обменять или вернуть товар?
                            <span class="faq-list_item-txt">Да, вы можете обменять или вернуть товар в течение 14 дней после покупки. Это право гарантирует вам «Закон о защите прав потребителя».</span>
                            <ul class="faq-sublist">
                                <span class="faq-sublist_title">Чтобы использовать эту возможность, пожалуйста убедитесь что:</span>
                                <li class="faq-sublist_item">товар, не был в употреблении и не имеет следов использования: царапин, сколов, потёртостей, на счётчике телефона не более 5 минут разговоров, программное обеспечение не подвергалось изменениям и т. п.</li>
                                <li class="faq-sublist_item">товар полностью укомплектован и не нарушена целостность упаковки</li>
                                <li class="faq-sublist_item">сохранены все ярлыки и заводская маркировка</li>
                            </ul>
                            <span class="faq-list_item-txt">Если товар не работает, обмен или возврат товара производится только при наличии заключения, о том, что условия эксплуатации не нарушены.</span>
                        </li>
                        <li class="faq-list_item">
                            В каких случаях гарантия не предоставляется?
                            <span class="faq-list_item-txt">Причины отказа в гарантийном ремонте в случае если:</span>
                            <ul class="faq-sublist">
                                <li class="faq-sublist_item">нарушена сохранность гарантийных пломб(предусмотренных заводом-изготовителем)</li>
                                <li class="faq-sublist_item">есть механические или иные повреждения, которые возникли вследствие умышленных или неосторожных действий покупателя или третьих лиц</li>
                                <li class="faq-sublist_item">нарушены правила использования, изложенные в эксплуатационных документах</li>
                                <li class="faq-sublist_item">было произведено несанкционированное вскрытие, ремонт или изменены внутренние коммуникации и компоненты товара, изменена конструкция или схемы товара</li>
                            </ul>
                            <span class="faq-list_item-txt">Гарантийные обязательства не распространяются на следующие неисправности:</span>
                            <ul class="faq-sublist">
                                <li class="faq-sublist_item">естественный износ или исчерпание ресурса</li>
                                <li class="faq-sublist_item">случайные повреждения, причиненные клиентом или повреждения, возникшие вследствие небрежного отношения или использования (воздействие жидкости, запыленности, попадание внутрь корпуса посторонних предметов и т. п.)</li>
                                <li class="faq-sublist_item">повреждения в результате стихийных бедствий (природных явлений)</li>
                                <li class="faq-sublist_item">повреждения, вызванные аварийным повышением или понижением напряжения в электросети или неправильным подключением к электросети</li>
                                <li class="faq-sublist_item">повреждения, вызванные дефектами системы, в которой использовался данный товар, или возникшие в результате соединения и подключения товара к другим изделиям</li>
                                <li class="faq-sublist_item">повреждения, вызванные использованием товара не по назначению или с нарушением правил эксплуатации</li>
                            </ul>
                        </li>

                    </ul>
                </article>
            </div>

        </div>
    </section>
@endsection