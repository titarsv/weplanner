@extends('public.layouts.main')
@section('meta')
    <title>{!! $brand->title !!}</title>
    <meta name="description" content="{!! $brand->meta_description or '' !!}">
    <meta name="keywords" content="{!! $brand->meta_keywords or '' !!}">
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('brand', $brand) !!}
@endsection

@section('content')
    <section class="main-content">
        <div class="container">
            <div class="main-sidebar">

                <div class="filters">
                    <a class="showHideContent"><div class="sidebar_subtitle">КАТАЛОГ ТОВАРОВ</div></a>

                    <div class="hidden_content">
                        <ul class="cat_menu-list">
                            @foreach($categories as $category)
                                <li class="cat_menu-item">
                                    <a href="/catalog/{{ $category['url_alias'] }}" class="cat_menu-link">{{ $category['name'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @include('public.layouts.sidebar-banners')

                @include('public.layouts.last-reviews')
            </div>

            <div class="main-wrapper">
                @include('public.layouts.search-form')

                <div class="sort-block">
                    <div class="sort-block_wrapper">
                        <div class="sort-block_title">Сортировать по:</div>
                        <ul class="sort-block_cost">
                            <li class="sort-block_cost-item{{ $current_sort == 'price_desc' ? ' active' : '' }}"><a href="/brand/{{ $alias }}?sort=price_desc">дороже</a></li>
                            <li class="sort-block_cost-item{{ $current_sort == 'price_asc' ? ' active' : '' }}"><a href="/brand/{{ $alias }}?sort=price_asc">дешевле</a></li>
                        </ul>
                        {{--<div class="sort-block_title">Рейтинг:</div>--}}
                        {{--<ul class="sort-block_rating">--}}
                        {{--<li class="sort-block_rating-item down active"></li>--}}
                        {{--<li class="sort-block_rating-item up"></li>--}}
                        {{--</ul>--}}
                    </div>
                </div>

                <div class="cat-block">

                    @foreach($products as $product)
                        @include('public.layouts.product', ['product' => $product])
                    @endforeach

                    @if($products->currentPage() < $products->lastPage())
                        <a href="/catalog/{{ $alias }}/?sort={{ $current_sort }}&page={{ $products->currentPage()+1 }}" class="cat-block_more-items_btn" id="paginate" data-alias="/brand/{{ $alias }}" data-sort="{{ $current_sort }}" data-current-page="{{ $products->currentPage() }}" data-pages-count="{{ $products->lastPage() }}">СМОТРЕТЬ ЕЩЕ 15 ТОВАРОВ</a>
                    @endif

                </div>

                <div class="seo-block">
                    {!! $brand->description !!}
                </div>
            </div>
        </div>
    </section>
@endsection