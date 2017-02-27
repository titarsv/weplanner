@if(!$reviews->isempty())
<div class="reviews-block">
    @foreach($reviews as $review)
    <a href="/product/{{ $review->product->url_alias }}" class="reviews-item">
        <img alt="" src="{{ $review->product->image->url('product') }}" class="reviews-item_img">
        <div class="reviews-item_info">
            <div class="reviews-item_rating">
                <div class="reviewStars">
                    @for($i=1; $i<=5; $i++)
                        @break($review->product->rating == null)

                        @if($i <= $review->product->rating)
                            <div class="reviewStar active"></div>
                        @else
                            <div class="reviewStar"></div>
                        @endif
                    @endfor
                </div>

                <span class="reviews-item_date">{{ $review->created_at->format('d.m.Y') }}</span>

                <div class="reviews-item_title">
                    {{ $review->product->name }}
                </div>

                <div class="reviews-item_title">
                    {{ $review->user->first_name.' '.$review->user->last_name }}
                </div>
                <div class="reviews-item_text">
                    <span class="reviews-item_top-quote">"</span>
                        {{ $review->review }}
                    <span class="reviews-item_bottom-quote">"</span>
                </div>
                <div class="reviews-item_more">
                    Подробнее
                </div>
            </div>
        </div>
    </a>
    @endforeach
</div>
@endif