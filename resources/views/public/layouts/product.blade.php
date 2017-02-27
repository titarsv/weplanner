{{--@if(!empty($slider))--}}
{{--<div class="product-slider__item">--}}
{{--@elseif(!empty($search))--}}
{{--<div class="col-lg-3 col-sm-6">--}}
{{--@else--}}
{{--<div class="col-lg-4 col-sm-6">--}}
{{--@endif--}}
    {{--<div class="product-cart" data-product-id="{!! $product->id !!}">--}}
        {{--@if(!empty($account_wishlist))--}}
            {{--<a href="javascript:void(0)" id="button-wishlist" class="product-cart__delete-btn" data-product-id="{!! $product->id !!}" data-action="remove">--}}
                {{--<i class="product-cart__delete-icon">&#xe808</i>--}}
            {{--</a>--}}
        {{--@endif--}}
        {{--<a href="/product/{!! $product->url_alias !!}" class="product-cart__thumb" style="background-image: url({!! $product->image->get_current_file_url('product_list') !!});"></a>--}}
        {{--<a href="/product/{!! $product->url_alias !!}" class="product-cart__name">{!! $product->name !!}</a>--}}
        {{--<div class="product-cart__help-wrap clearfix">--}}
            {{--<span class="product-cart__price">{!! $product->price !!} грн</span>--}}
            {{--<ul class="product-cart__star-list">--}}
                {{--@for($i=1; $i<=5; $i++)--}}
{{--                    @break($product->rating == null)--}}

                    {{--@if($i <= $product->rating)--}}
                        {{--<li class="product-cart__star"><i class="close-popup-btn__star-icon">&#xe809;</i></li>--}}
                    {{--@else--}}
                        {{--<li class="product-cart__star"><i class="close-popup-btn__star-icon">&#xe80a;</i></li>--}}
                    {{--@endif--}}
                {{--@endfor--}}
            {{--</ul>--}}
        {{--</div>--}}
        {{--<div class="clearfix">--}}
            {{--<a href="javascript:void(0)" class="product-cart__btn btn_buy" data-product-id="{!! $product->id !!}" @if(!empty($account_wishlist)) style="width: 100%;" @endif>Купить</a>--}}
            {{--@if(empty($account_wishlist))--}}
                {{--<a href="javascript:void(0)"--}}
                   {{--class="product-cart__fav button-wishlist"--}}
                   {{--data-product-id="{!! $product->id !!}"--}}
                   {{--@if($user && in_array($product->id, $user->wishlist('array')))--}}
                       {{--data-action="remove"--}}
                   {{--@else--}}
                       {{--data-action="add"--}}
                   {{--@endif--}}
                {{-->--}}
                    {{--<i class="close-popup-btn__fav-icon">--}}
                        {{--@if($user && in_array($product->id, $user->wishlist('array')))--}}
                            {{--&#xe801;--}}
                        {{--@else--}}
                            {{--&#xe800;--}}
                        {{--@endif--}}
                    {{--</i>--}}
                {{--</a>--}}
                {{--<div class="cart-hover small-fav-hover wishlist-error">--}}
                    {{--<span class="cart-hover__text">Войдите, чтобы сохранять понравившиеся Вам товары</span>--}}
                    {{--<a href="/login" class="cart-hover__btn">Войти</a>--}}
                    {{--<a href="/register" class="cart-hover__cart-link">Зарегистрироваться</a>--}}
                {{--</div>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}


        <div class="cat-block_item product product-{{ $product->id }}">
            <div class="cat-block_item-left">
                <div class="cat-block_item-pic_wrap">
                    <div class="cat-block_item-pic_container">
                        <img alt="" src="{{ $product->image->get_current_file_url('product_list') }}" class="cat-block_item-pic">
                    </div>
                </div>
            </div>
            <div class="cat-block_item-right">
                <div class="cat-block_item-info_wrap">
                    <a class="cat-block_item-info_title" href="/product/{{ $product->url_alias }}">{{ $product->name }}</a>
                    <span class="cat-block_item-info_vendor_code">Код товара: {{ $product->articul }}</span>
                    {{--<span class="cat-block_item-info_set">Комплектность: болт</span>--}}
                    <div class="cat-block_item-info_bottom">

                        <div class="cat-block_item-info_rev-price_wrapper">
                            <div class="reviewStars">
                                @for($i=1; $i<=5; $i++)
                                    @break($product->rating == null)

                                    @if($i <= $product->rating)
                                        <div class="reviewStar active"></div>
                                    @else
                                        <div class="reviewStar"></div>
                                    @endif
                                @endfor
                            </div>
                            <div class="item_reviews">{{ $product->reviews->count() }} {{ trans_choice('app.reviews', $product->reviews->count()) }}</div>
                            <span class="cat-block_item-price">{{ $product->price == 0 ? 'договорная цена' :  $product->price.' грн'}}</span>
                        </div>

                        <div class="cat-block_item-counter">
                            <div class="minus"></div>
                            <input class="count_field" type="text" value="1" size="1">
                            <div class="plus"></div>
                        </div>

                        <a class="cat-block_item-cart_btn btn_buy" data-product-id="{!! $product->id !!}">В корзину</a>

                        {{--<a class="cat-block_item-status">Наличие на складе</a>--}}

                    </div>
                </div>
            </div>
        </div>