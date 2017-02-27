@extends('public.layouts.main')
@section('meta')
    <title>{!! $article->meta_title !!}</title>
    <meta name="description" content="{!! $article->meta_description !!}">
    <meta name="keywords" content="{!! $article->meta_keywords !!}">
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('articles_item', $article) !!}
@endsection

@section('content')
    <section class="main-content">
        <div class="container">
            <div class="main-sidebar">
                <div class="filters">

                    @include('public.layouts.sidebar-menu')

                    {{--<a class="showHideContent"><div class="sidebar_subtitle">РУБРИКИ</div></a>--}}

                    {{--<div class="hidden_content">--}}
                        {{--<ul class="cat_menu-list">--}}
                            {{--<li class="cat_menu-item news">--}}
                                {{--<a href="#" class="cat_menu-link">Название 1</a>--}}
                            {{--</li>--}}
                            {{--<li class="cat_menu-item news">--}}
                                {{--<a href="#" class="cat_menu-link">Название 2</a>--}}
                            {{--</li>--}}
                            {{--<li class="cat_menu-item news">--}}
                                {{--<a href="#" class="cat_menu-link">Название 3</a>--}}
                            {{--</li>--}}
                            {{--<li class="cat_menu-item news">--}}
                                {{--<a href="#" class="cat_menu-link">Название 4</a>--}}
                            {{--</li>--}}
                            {{--<li class="cat_menu-item news">--}}
                                {{--<a href="#" class="cat_menu-link">Название 5</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}

                </div>

                @include('public.layouts.recommended-news')

            </div>

            <div class="main-wrapper">
                @include('public.layouts.search-form', ['action' => '/news'])

                <div class="news_item-block">
                    <div class="news_item-block_pic-wrapper">
                        <img class="news_item-pic" alt="" src="{!! $article->image->get_current_file_url('news_list') !!}">
                    </div>
                    <div class="news_item-block_txt-wrapper">
                        <div class="news_item-block-info_stats">
                            <span class="news_item-info_date">{!! $article->date !!}</span>
                            <span class="news_item-info_views">{!! $article->visits !!} {{ trans_choice('app.visits', $article->visits) }}</span>
                        </div>
                        <span class="news_item-title">{!! $article->title !!}</span>
                        <div class="news_item-txt">
                            {!! $article->text !!}
                        </div>
                    </div>

                    <div class="news_item-block_socials-wrapper">
                        <span class="news_item-block_socials-title">Поделиться в:</span>
                        <a href="" class="news_item-block_socials-item socials-item_vk"></a>
                        <a href="" class="news_item-block_socials-item socials-item_fb"></a>
                        <a href="" class="news_item-block_socials-item socials-item_ok"></a>
                    </div>
                </div>

                @if(!$products->isempty())
                <div class="action_items-block">

                    <span class="action_items-title related">Сопутствующие товары</span>

                    <div class="product_items-block">

                        @foreach($products as $product)
                            @include('public.layouts.product-small', ['product' => $product])
                        @endforeach

                    </div>
                </div>
                @endif

                @if(isset($similar) && $similar !== null)
                <div class="more_news-block">
                    <span class="more_news-block_title">Другие статьи</span>
                    <div class="related_news-items_wrappper">

                        @foreach($similar as $article)
                            @include('public.layouts.related-news', ['article' => $article])
                        @endforeach

                    </div>
                </div>
                @endif

                {{--<a class="news_more-items_btn">ЕЩЕ сТАТЬИ</a>--}}

            </div>
        </div>
    </section>
@endsection