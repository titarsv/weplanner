@extends('public.layouts.main')
@section('meta')
    <title>Контакты</title>
    <meta name="description" content="Контакты">
    <meta name="keywords" content="Контакты">
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('contacts') !!}
@endsection

@section('content')
    <section class="main-content">
        <div class="container">

            <div class="main-sidebar absolute">
                <div class="filters">

                    @include('public.layouts.sidebar-menu')

                </div>
            </div>

            <div class="main-wrapper">
                @include('public.layouts.search-form')
            </div>

            <div class="contacts-block">
                <span class="contacts-title">Контакты</span>
                <div class="contacts-sidebar">
                    <span class="contacts-sidebar_title">Служба поддержки магазина ВерxАгро</span>
                    <div class="contacts-sidebar_schedule">
                        <span class="contacts-sidebar_subtitle">Режим работы:</span>
                        <div class="contacts-sidebar_schedule-days">
                            ПН-ПТ С 9.00 - 19.00
                        </div>
                        <span class="contacts-sidebar_subtitle">По вопросам сотрудничества:</span>
                        <ul class="contacts-sidebar_phones">
                            <li class="contacts-sidebar_phones-item">(800) 500 32 11</li>
                            <li class="contacts-sidebar_phones-item">(057) 987 32 11</li>
                            <li class="contacts-sidebar_phones-item">(097) 321 32 11</li>
                        </ul>
                        <div class="contacts-sidebar_mail">
                            partner@verhagro.com
                        </div>
                        <div class="contacts-sidebar_address">
                            г. Харьков ул. Дудинськой, 6
                        </div>
                    </div>
                    <div class="contacts-sidebar_boss-about">
                        <div class="contacts-sidebar_boss-pic_wrapper">
                            <img src="/img/boss-pic.jpg" alt="" class="contacts-sidebar_boss-pic">
                        </div>
                        <div class="contacts-sidebar_boss-info_wrapper">
                            <span class="contacts-sidebar_boss-position">Начальник <br>отдела сотрудничества</span>
                            <span class="contacts-sidebar_boss-name">Иван Петров</span>
                        </div>
                    </div>
                </div>
                <div class="contacts-main_wrapper">
                    <div id="map" class="map"></div>
                    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm4r17-pvaW17xB0yfuZmXPf4uxfMJLmk"></script>

                    <script type="text/javascript">
                        function initMap() {
                            // Координаты центра на карте.
                            var centerLatLng = new google.maps.LatLng(49.979446, 36.176915);

                            // Обязательные опции с которыми будет проинициализированна карта
                            var mapOptions = {
                                center: centerLatLng, // Координаты центра мы берем из переменной centerLatLng
                                scrollwheel: false,		// Отключение увеличения при скроллинге
                                zoom: 18,               // Зум по умолчанию. Возможные значения от 0 до 21
                                mapTypeControl: false,
                                streetViewControl: false,
                                rotateControl: false
                            };

                            // Создаем карту внутри элемента #map
                            var map = new google.maps.Map(document.getElementById("map"), mapOptions);

                            var marker = new google.maps.Marker({
                                position: centerLatLng,
                                map: map
                            });
                        }

                        // Ждем полной загрузки страницы, после этого запускаем initMap()
                        google.maps.event.addDomListener(window, "load", initMap);

                    </script>
                </div>
            </div>

            <div class="feedback-block">
                <span class="feedback-title">Отправить сообщение</span>
                <form method="post" class="feedback-form">
                    <div class="feedback-form_wrapper left">
                        <input class="feedback-form_input" type="text" name="email" placeholder="E-mail">
                        <input class="feedback-form_input" type="text" name="name" placeholder="Имя">
                    </div>
                    <div class="feedback-form_wrapper">
                        <textarea class="feedback-form_textarea" placeholder="Сообщение"></textarea>
                    </div>
                    <button class="feedback-button">Отправить</button>
                </form>
            </div>

        </div>
    </section>
@endsection