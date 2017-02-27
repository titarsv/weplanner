@foreach($products as $product)
    <a href="/product/{{ $product->url_alias }}" class="product_item product_card">
        <div class="product_item-pic_wrap">
            <div class="product_item-pic_container">
                <img alt="" src="{{ $product->image->get_current_file_url('product_list') }}" class="product_item-pic">
            </div>
            <div class="product_item-sale">-{{ round(($product->old_price/$product->price - 1) * 100) }}%</div>
        </div>
        <span class="product_item-title">{{ $product->name }}</span>
        <div class="product_item-short-descr">{{ $product->description }}</div>
        <div class="product_item-price_wrapper">
            <span class="product_item-sale_price">{{ $product->old_price }} грн</span>
            <span class="product_item-price">{{ $product->price == 0 ? 'договорная цена' :  $product->price.' грн'}}</span>
        </div>
        <div class="product_item-btn btn_buy" data-product-id="{!! $product->id !!}">В КОРЗИНУ</div>
        <div class="item_review_block">
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
    </a>
@endforeach