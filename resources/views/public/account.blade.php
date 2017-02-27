@extends('public.layouts.main')

@section('meta')
    <title>Личный кабинет</title>
    <meta name="description" content="{!! $settings->meta_description !!}">
    <meta name="keywords" content="{!! $settings->meta_keywords !!}">
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('account') !!}
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

            <div class="user-room-block">

                <nav class="user-room_tabs">
                    <ul class="tabs_caption">
                        <li class="user-room_tabs-item active">Профиль</li>
                        <li class="user-room_tabs-item">Мои заказы <span class="user-room_tabs-orders_count">{{ $orders->count() ? '+'.$orders->count() : '' }}</span></li>
                        {{--<li class="user-room_tabs-item">Специальные предложения <span class="user-room_tabs-offers_count">+2</span></li>--}}
                    </ul>

                    <div class="tabs_content user-room_tabs_content active">

                        <form method="post" class="user-room_form" action="/user/change-data">
                            {!! csrf_field() !!}
                            <div class="user-room_form_wrapper">
                                <span class="user-room_form-title">Контактная информация</span>
                                <input class="user-room_form_input" type="text" name="phone" placeholder="Мобильный телефон" value="{!! $user->phone or '' !!}">
                                {{--<div class="user-room_form_select">--}}
                                    {{--<select class="sort_list">--}}
                                        {{--<option value="">Харьковская обл.</option>--}}
                                        {{--<option>Харьковская обл.</option>--}}
                                        {{--<option>Киевская обл.</option>--}}
                                        {{--<option>Одесская обл.</option>--}}
                                        {{--<option>Днепровская обл.</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}


                                <input class="user-room_form_input" type="text" name="city" placeholder="Город" value="{!! $user->user_data->address()->city or '' !!}">
                                <input class="user-room_form_input" type="text" name="address" placeholder="Адрес" value="{!! $user->user_data->address()->address or '' !!}">
                            </div>
                            <div class="user-room_form_wrapper">
                                <span class="user-room_form-title">Основная информация</span>
                                <input class="user-room_form_input" type="text" name="first_name" placeholder="Имя*" value="{!! $user->first_name or '' !!}">
                                <input class="user-room_form_input" type="text" name="last_name" placeholder="Фамилия*" value="{!! $user->last_name or '' !!}">
                                <input class="user-room_form_input" type="text" name="patronymic" placeholder="Отчество*" value="{!! $user->patronymic or '' !!}">
                            </div>
                            <div class="user-room_form_wrapper">
                                <span class="user-room_form-title">E-mail и пароль</span>
                                <input class="user-room_form_input" type="text" name="email" placeholder="E-mail" value="{!! $user->email or '' !!}">
                                <input class="user-room_form_input" type="password" name="password" placeholder="Новый пароль">
                                <input class="user-room_form_input" type="password" name="password_confirmation" placeholder="Повторите пароль">
                            </div>
                            <div class="user-room_form_btn-wrapper">
                                <button class="user-room_form-btn_save" type="submit">Сохранить</button>
                                <a href="/logout"><button class="user-room_form-btn_exit">Выйти</button></a>
                            </div>
                        </form>

                    </div>

                    <div class="tabs_content user-room_tabs_content">
                        <div class="order_status">
                            База заказов товаров на <span class="order_status-date">{{ date('d.m.Y') }}</span>
                        </div>

                        @forelse($orders as $key => $order)
                            <div class="order_item-wrapper">
                                <div class="order_info">
								<span class="order_info-number_wrap">
									№{{ $key + 1 }}
								</span>
                                    <span class="order_info-serial-date_wrap">
									<div class="order_info-serial-date_title">код и дата заказа:</div>
									<div class="order_info-serial">{!! $order->id !!}</div>
									<div class="order_info-date">{!! $order->date !!}</div>
								</span>
                                    <span class="order_info-sum_wrap">
									<div class="order_info-sum_title">сумма:</div>
									<div class="order_info-sum">{!! $order->total_price !!} грн</div>
								</span>
                                    <span class="order_info-status_wrap">
									<div class="order_info-status_title">статус:</div>
									<div class="order_info-status">{!! $order->status->status or 'незавершенный' !!}</div>

								</span>
                                    <span class="order_info-invoice_wrap">
									<div class="order_info-invoice_title">расходная накладная:</div>
									<div class="order_info-invoice">не сформирована</div>
								</span>
                                    <span class="order_info-waybill_wrap">
									<div class="order_info-waybill_title">номер TTH:</div>
									<div class="order_info-waybill">112434455</div>
									</span>
                                </div>

                                @foreach($order->getProducts() as $item)
                                    <a href="/product/{!! $item['product']->url_alias !!}" class="order-block_item">
                                        <div class="order-block_item-left">
                                            <div class="order-block_item-pic_wrap-inner">
                                                <div class="order-block_item-pic_wrap">
                                                    <div class="order-block_item-pic_container">
                                                        <img alt="" src="{{ $item['product']->image->get_current_file_url('product_list') }}" class="order-block_item-pic">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="order-block_item-info_wrap">
                                                <span class="order-block_item-info_title">{!! $item['product']->name !!}</span>
                                                <span class="order-block_item-info_vendor_code">Код товара: {!! $item['product']->articul !!}</span>
                                                <span class="order-block_item-info_set">Комплектность: болт</span>
                                                <div class="order-block_item-info_bottom">

                                                    <div class="order-block_item-info_rev-price_wrapper">
                                                        <div class="reviewStars">
                                                            @for($i=1; $i<=5; $i++)
                                                                @break($item['product']->rating == null)

                                                                @if($i <= $item['product']->rating)
                                                                    <div class="reviewStar active"></div>
                                                                @else
                                                                    <div class="reviewStar"></div>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <div class="item_reviews">{{ $item['product']->reviews->count() }} {{ trans_choice('app.reviews', $item['product']->reviews->count()) }}</div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="order-block_item-right">

                                            <div class="order-block_item-count_wrap">
                                                <div class="order-block_item-count_title">Количество</div>
                                                <div class="order-block_item-count">
                                                    <span class="count_field">{!! $item['quantity'] !!}</span>
                                                </div>
                                            </div>

                                            <div class="order-block_item-price_wrap">
                                                <span class="order-block_item-price_title">Цена</span>
                                                <span class="order-block_item-price">{!! $item['product']->price !!} грн</span>
                                            </div>

                                            <div class="order-block_item-sum_wrap">
                                                <span class="order-block_item-sum_title">Сумма</span>
                                                <span class="order-block_item-sum">{!! $item['product']->price * $item['quantity'] !!} грн</span>
                                            </div>

                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @empty

                        @endforelse

                        {{--<div class="order_item-wrapper">--}}
                            {{--<div class="order_info">--}}
								{{--<span class="order_info-number_wrap">--}}
									{{--№1--}}
								{{--</span>--}}
                                {{--<span class="order_info-serial-date_wrap">--}}
									{{--<div class="order_info-serial-date_title">код и дата заказа:</div>--}}
									{{--<div class="order_info-serial">1234565</div>--}}
									{{--<div class="order_info-date">5.01.2017</div>--}}
								{{--</span>--}}
                                {{--<span class="order_info-sum_wrap">--}}
									{{--<div class="order_info-sum_title">сумма:</div>--}}
									{{--<div class="order_info-sum">300 грн</div>--}}
								{{--</span>--}}
                                {{--<span class="order_info-status_wrap">--}}
									{{--<div class="order_info-status_title">статус:</div>--}}
									{{--<div class="order_info-status">в обработке</div>--}}

								{{--</span>--}}
                                {{--<span class="order_info-invoice_wrap">--}}
									{{--<div class="order_info-invoice_title">расходная накладная:</div>--}}
									{{--<div class="order_info-invoice">не сформирована</div>--}}
								{{--</span>--}}
                                {{--<span class="order_info-waybill_wrap">--}}
									{{--<div class="order_info-waybill_title">номер TTH:</div>--}}
									{{--<div class="order_info-waybill">112434455</div>--}}
									{{--</span>--}}
                            {{--</div>--}}

                            {{--<a href="" class="order-block_item">--}}
                                {{--<div class="order-block_item-left">--}}
                                    {{--<div class="order-block_item-pic_wrap-inner">--}}
                                        {{--<div class="order-block_item-pic_wrap">--}}
                                            {{--<div class="order-block_item-pic_container">--}}
                                                {{--<img alt="" src="img/item_prev.jpg" class="order-block_item-pic">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="order-block_item-info_wrap">--}}
                                        {{--<span class="order-block_item-info_title">Полное название товара</span>--}}
                                        {{--<span class="order-block_item-info_vendor_code">арт.120100</span>--}}
                                        {{--<span class="order-block_item-info_set">Комплектность: болт</span>--}}
                                        {{--<div class="order-block_item-info_bottom">--}}

                                            {{--<div class="order-block_item-info_rev-price_wrapper">--}}
                                                {{--<div class="reviewStars-input">--}}
                                                    {{--<input id="star-4" type="radio" name="reviewStars" tabindex="0">--}}
                                                    {{--<label for="star-4"></label>--}}

                                                    {{--<input id="star-3" type="radio" name="reviewStars" tabindex="0">--}}
                                                    {{--<label for="star-3"></label>--}}

                                                    {{--<input id="star-2" type="radio" name="reviewStars" tabindex="0">--}}
                                                    {{--<label for="star-2"></label>--}}

                                                    {{--<input id="star-1" type="radio" name="reviewStars" tabindex="0">--}}
                                                    {{--<label for="star-1"></label>--}}

                                                    {{--<input id="star-0" type="radio" name="reviewStars" tabindex="0">--}}
                                                    {{--<label for="star-0"></label>--}}
                                                {{--</div>--}}
                                                {{--<div class="item_reviews">3 отзыва</div>--}}
                                            {{--</div>--}}

                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="order-block_item-right">--}}

                                    {{--<div class="order-block_item-count_wrap">--}}
                                        {{--<div class="order-block_item-count_title">Количество</div>--}}
                                        {{--<div class="order-block_item-count">--}}
                                            {{--<div class="minus"></div>--}}
                                            {{--<input class="count_field" type="text" value="1" size="1">--}}
                                            {{--<div class="plus"></div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="order-block_item-price_wrap">--}}
                                        {{--<span class="order-block_item-price_title">Цена</span>--}}
                                        {{--<span class="order-block_item-price">300 грн</span>--}}
                                    {{--</div>--}}

                                    {{--<div class="order-block_item-sum_wrap">--}}
                                        {{--<span class="order-block_item-sum_title">Сумма</span>--}}
                                        {{--<span class="order-block_item-sum">300 грн</span>--}}
                                    {{--</div>--}}

                                {{--</div>--}}
                            {{--</a>--}}

                        {{--</div>--}}
                        {{--<div class="order_item-wrapper">--}}
                            {{--<div class="order_info">--}}
								{{--<span class="order_info-number_wrap">--}}
									{{--№2--}}
								{{--</span>--}}
                                {{--<span class="order_info-serial-date_wrap">--}}
									{{--<div class="order_info-serial-date_title">код и дата заказа:</div>--}}
									{{--<div class="order_info-serial">1234565</div>--}}
									{{--<div class="order_info-date">5.01.2017</div>--}}
								{{--</span>--}}
                                {{--<span class="order_info-sum_wrap">--}}
									{{--<div class="order_info-sum_title">сумма:</div>--}}
									{{--<div class="order_info-sum">300 грн</div>--}}
								{{--</span>--}}
                                {{--<span class="order_info-status_wrap">--}}
									{{--<div class="order_info-status_title">статус:</div>--}}
									{{--<div class="order_info-status">в обработке</div>--}}

								{{--</span>--}}
                                {{--<span class="order_info-invoice_wrap">--}}
									{{--<div class="order_info-invoice_title">расходная накладная:</div>--}}
									{{--<div class="order_info-invoice">не сформирована</div>--}}
								{{--</span>--}}
                                {{--<span class="order_info-waybill_wrap">--}}
									{{--<div class="order_info-waybill_title">номер TTH:</div>--}}
									{{--<div class="order_info-waybill">112434455</div>--}}
									{{--</span>--}}
                            {{--</div>--}}

                            {{--<a href="" class="order-block_item">--}}
                                {{--<div class="order-block_item-left">--}}
                                    {{--<div class="order-block_item-pic_wrap-inner">--}}
                                        {{--<div class="order-block_item-pic_wrap">--}}
                                            {{--<div class="order-block_item-pic_container">--}}
                                                {{--<img alt="" src="img/item_prev.jpg" class="order-block_item-pic">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="order-block_item-info_wrap">--}}
                                        {{--<span class="order-block_item-info_title">Полное название товара</span>--}}
                                        {{--<span class="order-block_item-info_vendor_code">арт.120100</span>--}}
                                        {{--<span class="order-block_item-info_set">Комплектность: болт</span>--}}
                                        {{--<div class="order-block_item-info_bottom">--}}

                                            {{--<div class="order-block_item-info_rev-price_wrapper">--}}
                                                {{--<div class="reviewStars-input">--}}
                                                    {{--<input id="star-4" type="radio" name="reviewStars" tabindex="0">--}}
                                                    {{--<label for="star-4"></label>--}}

                                                    {{--<input id="star-3" type="radio" name="reviewStars" tabindex="0">--}}
                                                    {{--<label for="star-3"></label>--}}

                                                    {{--<input id="star-2" type="radio" name="reviewStars" tabindex="0">--}}
                                                    {{--<label for="star-2"></label>--}}

                                                    {{--<input id="star-1" type="radio" name="reviewStars" tabindex="0">--}}
                                                    {{--<label for="star-1"></label>--}}

                                                    {{--<input id="star-0" type="radio" name="reviewStars" tabindex="0">--}}
                                                    {{--<label for="star-0"></label>--}}
                                                {{--</div>--}}
                                                {{--<div class="item_reviews">3 отзыва</div>--}}
                                            {{--</div>--}}

                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="order-block_item-right">--}}

                                    {{--<div class="order-block_item-count_wrap">--}}
                                        {{--<div class="order-block_item-count_title">Количество</div>--}}
                                        {{--<div class="order-block_item-count">--}}
                                            {{--<div class="minus"></div>--}}
                                            {{--<input class="count_field" type="text" value="1" size="1">--}}
                                            {{--<div class="plus"></div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="order-block_item-price_wrap">--}}
                                        {{--<span class="order-block_item-price_title">Цена</span>--}}
                                        {{--<span class="order-block_item-price">300 грн</span>--}}
                                    {{--</div>--}}

                                    {{--<div class="order-block_item-sum_wrap">--}}
                                        {{--<span class="order-block_item-sum_title">Сумма</span>--}}
                                        {{--<span class="order-block_item-sum">300 грн</span>--}}
                                    {{--</div>--}}

                                {{--</div>--}}
                            {{--</a>--}}

                        {{--</div>--}}

                        <div class="user-room_order_btn-wrapper">
                            <button class="user-room_order-btn_settings">Настройки</button>
                            <a href="/logout"><button class="user-room_form-btn_exit">Выйти</button></a>
                        </div>

                    </div>

                    {{--<div class="tabs_content user-room_tabs_content">--}}

                        {{--<div class="special_offers-block">--}}
                            {{--<span class="special_offers-block_title">Рекомендуйте наш магазин и получайте вознаграждение, Ваша ссылка</span>--}}
                            {{--<input class="special_offers-ref_link" type="text" name="ref_link" value="https://verhagro/tools/disk/uf.php?attachedId=7786&action=show&ncc=1&ewrewrewrewrwerewrwerw">--}}

                            {{--<div class="special_offers-ref_link-share">Поделились ссылкой: <span class="special_offers-ref_link-share_count">10</span></div>--}}

                            {{--<div class="special_offers-txt_block">--}}
                                {{--Текст условий специальных предложений--}}
                            {{--</div>--}}
                            {{--<div class="special_offers-ref_active">Активных рефиралов: <span class="special_offers-ref_active_count">10</span></div>--}}

                            {{--<div class="special_offers-friend_sum">--}}
                                {{--Сумма покупок друзей: <span class="special_offers-friend_sum_count">1000грн</span>--}}
                            {{--</div>--}}
                            {{--<a href="/sale" class="special_offers-actions_link">Наши акции</a>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                </nav>
            </div>

        </div>
    </section>
@endsection