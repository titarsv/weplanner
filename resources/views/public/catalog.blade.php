@extends('public.layouts.main')
@section('meta')
    @if(!empty($search))
        <title>Поиск {{ $search }}</title>
    @else
        <title>{!! $category->meta_title or $category['meta_title'] !!}</title>
        <meta name="description" content="{!! $category->meta_description or '' !!}">
        <meta name="keywords" content="{!! $category->meta_keywords or '' !!}">
    @endif
@endsection

@section('breadcrumbs')
    @if(!empty($search))
        {!! Breadcrumbs::render('search') !!}
    @else
        {!! Breadcrumbs::render('catalog', $category, $current_brand, $current_model) !!}
    @endif
@endsection

@section('content')

    <section class="main-content">
        <div class="container">
            <div class="main-sidebar">

                <div class="filters">
                    @include('public.layouts.sidebar-menu', ['selected' => isset($category) ? $category->id : 0])

                    <div class="filters_secondary">

                        @if(!empty($brands) && !$brands->isEmpty())
                        <a href="#brand-list" class="showHideContent{!! !empty($models) ? '' : ' show' !!}"><div class="sidebar_subtitle secondary">БРЕНДЫ</div></a>

                        @if(!empty($current_brand))
                        <span class="filter" style="display: inline-block; margin: -15px 0 10px;"><a href="/catalog/{{ $current_brand->url_alias }}" class="active">{{ $current_brand->name }}</a></span>
                        @endif

                            @if(count($brands) > 1 || (empty($current_brand) && count($brands) > 0) )
                            <div id="brand-list" class="hidden_content"{{ !empty($models) ? ' style=display:none' : '' }}>
                                <ul class="cat_menu-list">
                                    @foreach($brands as $brand)
                                        @if(empty($current_brand) || $brand->id != $current_brand->id)
                                        <li class="cat_menu-item brand filter">
                                            <a href="/catalog/{{ $brand->url_alias }}">{{ $brand->name }}</a>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        @endif

                        @if(!empty($models) && !$models->isEmpty())
                        <a href="#model-list" class="showHideContent{!! !empty($units) ? '' : ' show' !!}"><div class="sidebar_subtitle secondary">Модели</div></a>

                        @if(!empty($current_model))
                            <span class="filter" style="display: inline-block; margin: -15px 0 10px;"><a href="/catalog/{{ $current_model->url_alias }}" class="active">{{ $current_model->name }}</a></span>
                        @endif

                            @if(count($models) > 1 || (empty($current_model) && count($models) > 0) )
                            <div id="model-list" class="hidden_content"{!! !empty($units) ? ' style=display:none' : '' !!}>
                                <ul class="cat_menu-list">
                                    @foreach($models as $model)
                                        @if(empty($current_model) || $model->id != $current_model->id)
                                        <li class="cat_menu-item model filter">
                                            <a href="/catalog/{{ $model->url_alias }}">{{ $model->name }}</a>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        @endif

                        @if(!empty($units) && !$units->isEmpty())
                        <a class="showHideContent show" href="#unit-list"><div class="sidebar_subtitle secondary">Выбор узла</div></a>

                        <div id="unit-list" class="hidden_content">
                            <ul class="cat_menu-list">
                                @foreach($units as $unit)
                                    <li class="cat_menu-item unit filter">
                                        <a href="/unit/{{ $unit->url_alias }}?model={{ $current_model->id }}" class="">{{ $unit->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    </div>
                </div>

                @include('public.layouts.sidebar-banners')

                @include('public.layouts.last-reviews')

            </div>

            <div class="main-wrapper">
                @include('public.layouts.search-form')

                @if(!empty($search))
                    <div class="search-results">
                        <div class="search-request">Найдено по запросу "<span class="search-request__key">{{ $search }}</span>"</div>
                        <div class="search-items">{{ trans_choice('app.Search', $products->count()) }} <span class="search-items__count">{{ $products->count() }}</span> {{ trans_choice('app.products', $products->count()) }}</div>
                    </div>
                @endif

                <div class="sort-block">
                    <div class="sort-block_wrapper">
                        <div class="sort-block_title">Сортировать по:</div>
                        <div class="sort-block_cost">
                            @if(!empty($search))
                                <a class="sort-block_cost-item{{ $current_sort == 'price_desc' ? ' active' : '' }}" href="/search?search={{ $search }}&sort=price_desc">дороже</a>
                                <a class="sort-block_cost-item{{ $current_sort == 'price_asc' ? ' active' : '' }}" href="/search?search={{ $search }}&sort=price_asc">дешевле</a>
                            @else
                                <a class="sort-block_cost-item{{ $current_sort == 'price_desc' ? ' active' : '' }}" href="/catalog/{{ $alias }}?sort=price_desc">дороже</a>
                                <a class="sort-block_cost-item{{ $current_sort == 'price_asc' ? ' active' : '' }}" href="/catalog/{{ $alias }}?sort=price_asc">дешевле</a>
                            @endif
                        </div>
                        {{--<div class="sort-block_title">Рейтинг:</div>--}}
                        {{--<div class="sort-block_rating">--}}
                            {{--<a href="" class="sort-block_rating-item down active"></a>--}}
                            {{--<a href="" class="sort-block_rating-item up"></a>--}}
                        {{--</div>--}}
                    </div>
                </div>

                <div class="cat-block">
                    @include('public.layouts.products', ['products' => $products])

                    @if($products->currentPage() < $products->lastPage())
                        @if(!empty($search))
                            <a href="/search?sort={{ $current_sort }}&page={{ $products->currentPage()+1 }}" class="cat-block_more-items_btn" id="paginate" data-alias="/search" data-search="{{ $search }}" data-sort="{{ $current_sort }}" data-current-page="{{ $products->currentPage() }}" data-pages-count="{{ $products->lastPage() }}">СМОТРЕТЬ ЕЩЕ 15 ТОВАРОВ</a>
                        @else
                            <a href="/catalog/{{ $alias }}/?sort={{ $current_sort }}&page={{ $products->currentPage()+1 }}" class="cat-block_more-items_btn" id="paginate" data-alias="/catalog/{{ $alias }}" data-sort="{{ $current_sort }}" data-current-page="{{ $products->currentPage() }}" data-pages-count="{{ $products->lastPage() }}">СМОТРЕТЬ ЕЩЕ 15 ТОВАРОВ</a>
                        @endif
                    @endif
                </div>

                @if(empty($search))
                <div class="seo-block">
                    {!! $current_cat->description !!}
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection