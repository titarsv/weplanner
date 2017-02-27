@if(isset($recommended) && $recommended !== null)
    <a class="showHideContent recommend"><div class="we-recommend">Рекомендуем</div></a>
    <div class="hidden_content">
        <div class="related_news-items_wrappper">

            @foreach($recommended as $article)
                @include('public.layouts.related-news', ['article' => $article])
            @endforeach

        </div>
    </div>
@endif