<a href="/news/{!! $article->url_alias !!}" class="news_item">
    <div class="news_item-pic_wrapper">
        <img class="news_item-pic" alt="" src="{!! $article->image->get_current_file_url('news_list') !!}">
    </div>
    <div class="news_item-info_wrapper">
        <div class="news_item-info_stats">
            <span class="news_item-info_date">{!! $article->date !!}</span>
            <span class="news_item-info_views">{!! $article->visits !!} {{ trans_choice('app.visits', $article->visits) }}</span>
        </div>
        <span class="news_item-info_title">{!! $article->title !!}</span>
        <div class="news_item-info_txt-prev">
            {!! html_entity_decode($article->text) !!}
        </div>
        <span class="news_item-info_more">Читать подробнее</span>
    </div>
</a>