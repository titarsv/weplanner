@extends('public.layouts.main')
@section('meta')
    <title>{!! $product->meta_title !!}</title>
    <meta name="description" content="{!! $product->meta_description !!}">
    <meta name="keywords" content="{!! $product->meta_keywords !!}">
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('product', $product) !!}
@endsection

@section('content')
    <section class="main-content product">
        <div class="container">
            <div class="main-product_info">
                <div class="main-product_title-block">
                    <span class="main-product_title">{!! $product->name !!}</span>
                    {{--<span class="main-product_serial-title">{!! $product->catalog_id !!}</span>--}}
                    <span class="main-product_serial-number">Код товара: {!! $product->articul !!}</span>
                </div>

                <div class="main-product_info-wrapper">
                    <div class="main-product_gallery">
                        <div class="main-product_gallery-nav slick-navigation">
                            @foreach($gallery as $image)
                                <img alt="" src="{!! $image->get_current_file_url('product') !!}">
                            @endforeach
                        </div>
                        <div class="main-product_gallery-slider slick-gallery">
                            @foreach($gallery as $image)
                                <img alt="" src="{!! $image->get_current_file_url('product') !!}">
                            @endforeach
                        </div>
                    </div>

                    <div class="main-product_buy-info">
                        <div class="main-product_buy-info_left">
                            <div class="main-product_buy-info_price-wrap">
                                <span class="main-product_buy-info_price">{{ $product->price == 0 ? 'договорная цена' :  $product->price.' грн'}}</span>
                                {{--<a href="" class="main-product_buy-info_availibility">Проверить наличие</a>--}}
                            </div>

                            <div class="main-product_buy-info_button-wrap">
                                <div class="main-product_buy-info_item-counter">
                                    <div class="minus"></div>
                                    <input class="count_field" type="text" value="1" size="1">
                                    <div class="plus"></div>
                                </div>
                                <div class="main-product_buy-info_buttons">
                                    <a href="" class="main-product_buy-info_to-cart-btn btn_buy" data-product-id="{!! $product->id !!}">В корзину</a>
                                    <a href="#" data-mfp-src=".popup-form_one-click" class="main-product_buy-info_one-click-btn">Купить в 1 клик</a>
                                </div>
                            </div>

                            <div class="main-product_buy-info_rating-wrap">
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
                            </div>

                            <div class="main-product_buy-info_vendor-wrap">
                                @foreach($product->attributes as $attribute)
                                <span class="main-product_buy-info_vendor-title">{!! $attribute->info->name !!}:</span>
                                <span class="main-product_buy-info_vendor">{!! $attribute->value->name !!}</span><br>
                                @endforeach
                                <span style="white-space: nowrap;">
                                    <span class="main-product_buy-info_vendor-title">Каталожный номер запчасти:</span>
                                    <span class="main-product_buy-info_vendor">{!! $product->catalog_id !!}</span>
                                </span>
                            </div>

                            {{--<div class="main-product_buy-info_set-wrap">--}}
                                {{--<span class="main-product_buy-info_set-title">Комплектность: </span>--}}
                                {{--<span class="main-product_buy-info_set">болт</span>--}}
                            {{--</div>--}}

                        </div>

                        <div class="main-product_buy-info_mid">
                            <a href="#" data-mfp-src=".popup-form_follow-the-price" class="main-product_buy-info_message">Сообщить, когда цена снизится</a>
                            {{--<a href="" class="main-product_buy-info_to-favourites">Добавить в избранное</a>--}}
                        </div>

                        <div class="main-product_buy-info_right">
                            <ul class="main-product_buy-info_phones">
                                @foreach($settings->branches as $branch)
                                    @if($branch->city == $selected_city)
                                        @foreach($branch->phones as $phone)
                                            <li class="main-product_buy-info_phones-item">{!! $phone !!}</li>
                                        @endforeach
                                    @endif
                                @endforeach
                            </ul>
                            <div data-mfp-src=".popup-form-footer" class="main-footer__callback-btn main-product_buy-info_callback-btn">Перезвоните мне</div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="additionnal-product_info">
                <div class="additionnal-product_info-item">
                    <ul class="additionnal-product_info-delivery">
                        <span class="additionnal-product_info-item_title">Доставка</span>
                        <li class="additionnal-product_info-item_par">курьером по Харькову и области</li>
                        <li class="additionnal-product_info-item_par">по Украине курьерскими службами
                            совместная доставка</li>
                        <li class="additionnal-product_info-item_par">самовывоз со склада</li>
                    </ul>
                </div>
                <div class="additionnal-product_info-item">
                    <ul class="additionnal-product_info-payment">
                        <span class="additionnal-product_info-item_title">Оплата</span>
                        <li class="additionnal-product_info-item_par">наличными</li>
                        <li class="additionnal-product_info-item_par">безналичными с ндс и без ндс</li>
                        <li class="additionnal-product_info-item_par">Visa/Mastercard</li>
                    </ul>
                </div>
                <div class="additionnal-product_info-item">
                    <ul class="additionnal-product_info-troubleshooting">
                        <span class="additionnal-product_info-item_title">Дефектовка</span>
                        <li class="additionnal-product_info-item_par">выезжаем к вам</li>
                        <li class="additionnal-product_info-item_par">выявляем неисправности</li>
                        <li class="additionnal-product_info-item_par">производим замену</li>
                    </ul>
                </div>
            </div>

            <div class="product_specs">
                <nav class="product_specs_tabs">
                    <ul class="tabs_caption">
                        <li class="product_specs_tabs-item active">Описание</li>
                        <li class="product_specs_tabs-item">Характеристики</li>
                        <li class="product_specs_tabs-item">Отзывы <span class="product_specs_tabs-rev_count">({{ count($reviews) }})</span></li>
                    </ul>

                    <div class="tabs_content active">
                        {!! $product->description !!}
                    </div>

                    <div class="tabs_content">
                        @foreach($product->attributes as $attribute)
                            <span class="main-product_buy-info_vendor-title">{!! $attribute->info->name !!}:</span>
                            <span class="main-product_buy-info_vendor">{!! $attribute->value->name !!}</span>
                        @endforeach
                    </div>

                    <div class="tabs_content">
                        <div class="reviews-wrapper">
                            <div class="add_review_btn hide_review_form">Оставить отзыв</div>
                            <div class="review_form hidden_review_form" style="display: none">
                                @if(is_null($user))
                                    <span class="cart-hover__text">Для того, чтобы оставить отзыв, необходимо</span>
                                    <a class="main-header__login cart-hover__btn" href=".popup-form-login">Войти</a>
                                    <span class="cart-hover__text">или</span>
                                    <a class="main-header__reg cart-hover__cart-link" href=".popup-form-login" style="display: block;">Зарегистрироваться</a>
                                    <div class="reply_buttons_container">
                                        <div class="cancel_reply_btn">Отмена</div>
                                    </div>
                                @else
                                <form class="add_review_form review-form" method="post">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="type" value="review">
                                    <input type="hidden" name="product_id" value="{!! $product->id !!}">
                                    <div class="error-message" id="error-review" style="display: none;">
                                        <div class="error-message__text"></div>
                                    </div>
                                    <div class="add_review_form_container">
                                        <div class="form_wrapper">
                                            <input class="form_input" type="text" name="name" value="{!! $user->first_name or '' !!}" placeholder="Ваше имя">
                                        </div>
                                        <div class="form_wrapper">
                                            <input class="form_input" type="email" name="email" value="{!! $user->email or '' !!}" placeholder="E-mail">
                                        </div>
                                    </div>
                                    <div class="add_review_form_container">
                                        <div class="rating_container">
                                            <div class="rating_title">Оценить</div>
                                            <div class="reviewStars-input">
                                                <input id="star-4" type="radio" name="grade" value="5">
                                                <label for="star-4"></label>

                                                <input id="star-3" type="radio" name="grade" value="4">
                                                <label for="star-3"></label>

                                                <input id="star-2" type="radio" name="grade" value="3">
                                                <label for="star-2"></label>

                                                <input id="star-1" type="radio" name="grade" value="2">
                                                <label for="star-1"></label>

                                                <input id="star-0" type="radio" name="grade" value="1">
                                                <label for="star-0"></label>
                                            </div>
                                        </div>
                                        <textarea class="review_text" placeholder="Комментарий" name="review"></textarea>
                                    </div>
                                    <div class="review_buttons_container">
                                        <div class="cancel_review_btn">Отмена</div>
                                        <button type="submit" class="done_review_btn">Оставить отзыв</button>
                                    </div>
                                </form>
                                @endif
                            </div>

                            @forelse($reviews as $review)
                                <div class="review_item">
                                    <div class="user_info_review">
                                        <div class="reviewStars">
                                            @for($i=1; $i<=5; $i++)
                                                @if($i <= $review['parent']->grade)
                                                    <div class="reviewStar active"></div>
                                                @else
                                                    <div class="reviewStar"></div>
                                                @endif
                                            @endfor
                                        </div>
                                        <div class="review_date">{!! $review['parent']->date !!}</div>
                                        <div class="user_name_review">{!! $review['parent']->user->first_name !!}</div>
                                    </div>
                                    <div class="review_text_content">
                                        {!! $review['parent']->review !!}
                                    </div>
                                    <div class="review_helpfulness">
                                        <p>Отзыв полезен?</p>
                                        <button class="like" id="add-like" @if(!$user) @endif
                                        data-review="{!! $review['parent']->id !!}"
                                                data-action="like">Да<span class="already_voted error-message"></span></button>
                                        (<span class="likes">{!! count(json_decode($review['parent']->like)) !!}</span>)
                                        <span> / </span>
                                        <button class="dislike" id="add-dislike" @if(!$user) @endif
                                        data-review="{!! $review['parent']->id !!}"
                                                data-action="dislike">Нет<span class="already_voted error-message"></span></button>
                                        (<span class="dislikes">{!! count(json_decode($review['parent']->dislike)) !!}</span>)
                                    </div>
                                </div>
                                <div class="add_reply">Ответить</div>
                                <div class="hidden_reply" style="display: none">
                                    @if(is_null($user))
                                        <span class="cart-hover__text">Для того, чтобы оставить отзыв, необходимо</span>
                                        <a class="main-header__login cart-hover__btn" href=".popup-form-login">Войти</a>
                                        <span class="cart-hover__text">или</span>
                                        <a class="main-header__reg cart-hover__cart-link" href=".popup-form-login" style="display: block;">Зарегистрироваться</a>
                                        <div class="reply_buttons_container">
                                            <div class="cancel_reply_btn">Отмена</div>
                                        </div>
                                    @else
                                        <form class="add_reply_form review-form" method="post">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="type" value="answer">
                                            <input type="hidden" name="product_id" value="{!! $product->id !!}">
                                            <input type="hidden" name="parent_review_id" value="{!! $review['parent']->id !!}">
                                            <div class="error-message" id="error-answer" style="display: none;">
                                                <div class="error-message__text"></div>
                                            </div>
                                            <div class="add_review_form_container">
                                                <div class="form_wrapper">
                                                    <input class="form_input" type="text" name="name" value="{!! $user->first_name or '' !!}" placeholder="Ваше имя">
                                                </div>
                                                <div class="form_wrapper">
                                                    <input class="form_input" type="email" name="email" value="{!! $user->email or '' !!}" placeholder="E-mail">
                                                </div>
                                            </div>
                                            <div class="add_review_form_container">
                                                <textarea class="reply_text" placeholder="Комментарий" name="review"></textarea>
                                            </div>
                                            <div class="reply_buttons_container">
                                                <div class="cancel_reply_btn">Отмена</div>
                                                <button type="submit" class="done_reply_btn">Ответить</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>

                                @if(!empty($review['comments']))
                                    @foreach($review['comments'] as $comment)
                                        <div class="review_item" style="margin-left: 40px; width: calc(100% - 40px);">
                                            <div class="user_info_review">
                                                <div class="reviewStars">
                                                    @for($i=1; $i<=5; $i++)
                                                        @if($i <= $comment->grade)
                                                            <div class="reviewStar active"></div>
                                                        @else
                                                            <div class="reviewStar"></div>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <div class="review_date">{!! $comment->date !!}</div>
                                                <div class="user_name_review">{!! $comment->user->first_name !!}</div>
                                            </div>
                                            <div class="review_text_content">
                                                {!! $comment->review !!}
                                            </div>
                                            {{--<div class="review_helpfulness">--}}
                                                {{--<p>Отзыв полезен?</p>--}}
                                                {{--<button class="like" id="add-like" @if(!$user) @endif--}}
                                                {{--data-review="{!! $comment->id !!}"--}}
                                                        {{--data-action="like">Да<span class="already_voted">Вы уже голосовали</span></button>--}}
                                                {{--(<span class="likes">{!! count(json_decode($comment->like)) !!}</span>)--}}
                                                {{--<span> / </span>--}}
                                                {{--<button class="dislike" id="add-dislike" @if(!$user) @endif--}}
                                                {{--data-review="{!! $comment->id !!}"--}}
                                                        {{--data-action="dislike">Нет<span class="already_voted">Вы уже голосовали</span></button>--}}
                                                {{--(<span class="dislikes">{!! count(json_decode($comment->dislike)) !!}</span>)--}}
                                            {{--</div>--}}
                                        </div>
                                    @endforeach
                                @endif

                            @empty
                                <div class="review-item">
                                    <div class="review-item__top clearfix">
                                        <div class="review-item__top-left">
                                            <span class="review-item__name">У этого товара пока нет отзывов! Будьте первым!</span>
                                        </div>
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>
                </nav>

            </div>

            @if(!$analogs->isempty() && $user_logged && (in_array('admin', $user_roles) || in_array('manager', $user_roles)))
                <div class="product_alternate-block">
                    <span class="product_alternate-block_title">Альтернативные запчасти</span>

                    <div class="product_items-block">
                        @foreach($analogs as $analog)
                            @include('public.layouts.product-small', ['product' => $analog])
                        @endforeach
                    </div>

                </div>
            @endif

        </div>
    </section>

    <div class="hidden">
        <form class="main-form forms popup-form popup-form_one-click" id="one-click-buy">
            {!! csrf_field() !!}
            <h3 class="popup-form__title">Заказ в 1 клик</h3>
            <div class="error-message">

            </div>
            <input type="hidden" name="product" value="{{ $product->id }}">
            <input type="hidden" name="order" value="Заявка (покупка в 1 клик)">
            <input type="hidden" name="tagmanager" value="/popup_form_one-click.html">
            <div class="popup-form__input-wrap">
                Менеджер перезвонит Вам, узнает все детали и сам оформит заказ на Ваше имя
            </div>
            <div class="popup-form_one-click__left">
                <input type="text" name="name" class="popup-form__input" placeholder="Имя">
            </div>
            <div class="popup-form_one-click__right">
                <input type="text" name="phone" class="popup-form__input" placeholder="Мобильный телефон">
            </div>
            <div class="popup-form__input-wrap">
                <textarea class="popup-form_textarea" name="comment" placeholder="Комментарий"></textarea>
            </div>
            <div class="popup-form__input-wrap">
                <button type="submit" class="popup-form__btn one-click">Заказать</button>
            </div>
        </form>
    </div>

    <div class="hidden">
        <form class="main-form forms popup-form popup-form_follow-the-price" id="sale_price_request" action="/sale_price_request" method="post">
            {!! csrf_field() !!}
            <h3 class="popup-form__title">Сообщить когда изменится цена</h3>
            <div class="error-message">

            </div>
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="order" value="Заявка (следить за ценой)">
            <input type="hidden" name="tagmanager" value="/popup_form_follow-the-price.html">
            <div class="popup-form__input-wrap">
                <input type="text" name="name" class="popup-form__input" placeholder="Имя*">
            </div>
            <div class="popup-form__input-wrap">
                <input type="email" name="email" class="popup-form__input" placeholder="E-mail*">
            </div>
            <div class="popup-form__input-wrap popup-form_follow-the-price_register-check">
                <input type="checkbox" name="analog" id="reg" value="1">
                <label class="cart_register" for="reg">Предложить аналогичную деталь, если она есть</label>
            </div>
            <div class="popup-form__input-wrap">
                <button type="submit" class="popup-form__btn">Следить за ценой</button>
            </div>
        </form>
    </div>
@endsection