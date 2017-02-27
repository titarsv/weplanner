@extends('public.layouts.main')
@section('meta')
    <title>Новости</title>
    <meta name="description" content="{!! $settings->meta_description !!}">
    <meta name="keywords" content="{!! $settings->meta_keywords !!}">
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('articles') !!}
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

                @if(!empty($search))
                <div class="search-results">
                    <div class="search-request">Найдено по запросу "<span class="search-request__key">{{ $search }}</span>"</div>
                    <div class="search-items">{{ trans_choice('app.Search', $articles->count()) }} <span class="search-items__count">{{ $articles->count() }}</span> {{ trans_choice('app.news', $articles->count()) }}</div>
                </div>
                @endif

                <div class="news_items-block">
                    @if($articles !== null)
                        @foreach($articles as $article)
                            @include('public.layouts.news', ['article' => $article])
                        @endforeach

                        {{--<a class="news_more-items_btn">ЕЩЕ СТАТЬИ</a>--}}
                    @else
                        <div class="error-message__text">Еще нет добавленных новостей!</div>
                    @endif
                </div>

            </div>
        </div>
    </section>
@endsection