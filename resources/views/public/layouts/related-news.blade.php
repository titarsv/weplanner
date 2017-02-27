<a href="/news/{!! $article->url_alias !!}" class="related_news-item">
    <div class="related_news-item_pic-wrapper">
        <img src="{!! $article->image->get_current_file_url('news_list') !!}" alt="" class="related_news-item_pic">
    </div>
    <div class="related_news-item_txt-wrapper">
        <span class="related_news-item_title">{!! $article->title !!}</span>
        <div class="related_news-item_txt">
            {!! html_entity_decode($article->text) !!}
        </div>
        <div class="related_news-item_more">Читать подробнее</div>
    </div>
</a>