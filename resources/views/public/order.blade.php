@extends('public.layouts.main')
@section('meta')
    <title>Оформление заказа</title>
    <meta name="description" content="{!! $settings->meta_description !!}">
    <meta name="keywords" content="{!! $settings->meta_keywords !!}">
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('order') !!}
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

            <div class="cart-block">
                <div id="order_cart_content">
                    @include('public.layouts.cart', ['checkout' => true])
                </div>

                <div class="cart-block_checkout">
                    <form method="post" class="cart-block_checkout-form" id="order-checkout">
                        {!! csrf_field() !!}
                        <div class="cart-block_checkout-user_data">
							<span class="cart-block_checkout-user_data-title">
								<div class="cart-block_checkout-user_data-title_num">1</div>
								Контактные данные
							</span>

                            <div class="cart-block_checkout-user_data-not-registered">
                                <div class="cart-block_checkout-form_wrapper">
                                    <input class="cart-block_checkout-form_input" type="text" id="checkout-step__name" name="first_name" value="{!! $user->first_name or '' !!}" placeholder="Имя*">
                                    <input class="cart-block_checkout-form_input" type="text" id="checkout-step__email" name="email" value="{!! $user->email or '' !!}" placeholder="E-mail">
                                </div>
                                <div class="cart-block_checkout-form_wrapper">
                                    <input class="cart-block_checkout-form_input" type="text" id="checkout-step__lastname" name="last_name" value="{!! $user->last_name or '' !!}" placeholder="Фамилия*">
                                    <input class="cart-block_checkout-form_input" type="text" id="checkout-step__phone" name="phone" value="{!! $user->phone or '' !!}" placeholder="Мобильный телефон">
                                </div>
                            </div>
                            @if(!$user)
                            <div class="cart-block_checkout-user_data-register">
								<span class="cart-block_checkout-user_data-register_alert">
									Зарегистрируйтесь и получите <span class="cart-block_checkout-user_data-register_alert-gift">100 ГРН</span>
								</span>
                                <span class="cart-block_checkout-user_data-register_check">
									<input type="checkbox" id="reg" name="checkout_registration" value="true">
									<label class="cart_register" for="reg">зарегистрироваться</label>
								</span>
                                <div class="cart-block_checkout-form_wrapper cart_reg_wrap" style="display: none;">
                                    <input class="cart-block_checkout-form_input" type="text" name="email" placeholder="E-mail">
                                    <input class="cart-block_checkout-form_input" type="password" id="checkout-step__password" name="password" placeholder="Новый пароль">
                                    <input class="cart-block_checkout-form_input" type="password" id="checkout-step__password_r" name="password_confirmation" placeholder="Повторите пароль">
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="cart-block_checkout-payment">
							<span class="cart-block_checkout-payment_title">
								<div class="cart-block_checkout-payment_title_num">2</div>
								Способ доставки и оплаты
							</span>

                            <div class="cart-block_checkout_form_select">
                                <select name="payment" id="checkout-step__payment" class="sort_list">
                                    <option value="cash">Наличными при получении</option>
                                    <option value="prepayment">Предоплата</option>
                                </select>
                            </div>

                            <span class="cart-block_checkout-payment_delivery-txt">Укажите способ доставки</span>

                            <div class="cart-block_checkout_form_select">
                                <select id="checkout-step__delivery" class="sort_list checkout-step__select checkout-step__payment-select" name="delivery">
                                    <option value="0">Выберите...</option>
                                    <option value="newpost">Новая почта</option>
                                    <option value="ukrpost">Укрпочта</option>
                                    <option value="courier">Курьером по Харькову</option>
                                    <option value="pickup">Самовывоз</option>
                                </select>
                            </div>

                            <div id="checkout-delivery-payment"></div>

                        </div>
                    </form>

                </div>
            </div>

        </div>
    </section>
@endsection