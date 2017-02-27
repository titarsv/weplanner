@extends('public.layouts.main')
@section('meta')
    <title>Спасибо за заказ</title>
@endsection
@section('content')
    <section class="main-content">
        <div class="container">

            <div class="thank_you-block">
                @if($confirmed)
                    <span class="thank_you-block_title">Поздравляем, Ваш заказ успешно оформлен!</span>
                @else
                    <span class="thank_you-block_title">Спасибо за заказ!</span>
                @endif
                @if($confirmed)
                    <div class="thank_you-block_order-num_wrap">
                        Номер Вашего заказа:
                        <span class="thank_you-block_order-num">№{!! $order->id !!}</span>
                    </div>
                @else
                    <div class="thank_you-block_order-num_wrap">
                        Номер Вашего заказа:
                        <span class="thank_you-block_order-num">№{!! $order->id !!}</span>
                    </div>
                    <div class="thank_you-block_txt">В ближайшее время наш менеджер свяжеться с Вами,
                        для уточнения условий доставки и оплаты</div>
                @endif
            </div>

            <div class="thank_you-block_items_wrap">
                <div class="thank_you-block_items-header">
                    <span class="thank_you-block_items-num">№</span>
                    <span class="thank_you-block_items-title">название товара:</span>
                    <span class="thank_you-block_items-count">количество:</span>
                    <span class="thank_you-block_items-price">цена:</span>
                    <span class="thank_you-block_items-sum">сумма:</span>
                </div>

                @forelse($order->getProducts() as $key => $product)
                    @continue(!is_object($product['product']))
                    <div class="thank_you-block_item">
                        <span class="thank_you-block_items-num">{{ $key+1 }}</span>
                        <span class="thank_you-block_items-title">{!! $product['product']->name !!} ({!! $product['product']->articul !!})</span>
                        <span class="thank_you-block_items-count">{!! $product['quantity'] !!}</span>
                        <span class="thank_you-block_items-price">{!! $product['product']->price !!}грн</span>
                        <span class="thank_you-block_items-sum">{!! $product['product']->price * $product['quantity'] !!}грн</span>
                    </div>
                @empty
                    <h3>Нет товаров!</h3>
                @endforelse

                <div class="thank_you-block_items-footer">Итого: <span class="thank_you-block_items-footer_sum">{{ $order->total_price }} грн</span></div>

            </div>

            {{--<div class="thank_you-special_offers-block">--}}
                {{--<span class="special_offers-block_title">Рекомендуйте наш магазин и получайте вознаграждение, Ваша ссылка</span>--}}
                {{--<input class="special_offers-ref_link" type="text" name="ref_link" value="https://verhagro/tools/disk/uf.php?attachedId=7786&amp;action=show&amp;ncc=1&amp;ewrewrewrewrwerewrwerw">--}}

                {{--<div class="thank_you-certificate-block">--}}
                    {{--<a href="" class="thank_you-certificate-block_item">--}}
                        {{--<img src="img/sert-example.jpg" alt="" class="thank_you-certificate-block_item-pic">--}}
                    {{--</a>--}}
                    {{--<a href="" class="thank_you-certificate-block_item">--}}
                        {{--<img src="img/sert-example.jpg" alt="" class="thank_you-certificate-block_item-pic">--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="thank_you-sales_info-block">
                <span class="thank_you-sales_info-block_title">Получайте информацию о скидках и специальных предложениях:</span>
                <form method="post" class="thank_you-sales_info-block_form">
                    <input class="thank_you-sales_info-block_input" type="text" name="email" placeholder="E-MAIL">
                    <input class="thank_you-sales_info-block_input" type="text" name="phone" placeholder="ТЕЛЕФОН">
                    <button class="thank_you-sales_info-block_btn">Отправить</button>
                </form>
            </div>

        </div>
    </section>
@endsection