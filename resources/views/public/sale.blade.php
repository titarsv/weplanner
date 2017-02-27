@extends('public.layouts.main')
@section('meta')
    <title>Акции</title>
    <meta name="description" content="Акции">
    <meta name="keywords" content="Акции">
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('sale') !!}
@endsection

@section('content')

    <section class="main-content">
        <div class="container">
            <div class="main-sidebar absolute">
                <div class="filters">
                    @include('public.layouts.sidebar-menu')
                </div>
            </div>

            <div class="main-wrapper">
                @include('public.layouts.search-form')
            </div>

            <div class="sales-block">
                @foreach($actions as $action)
                    <a href="{{ $action['link'] }}" class="sales-block_item">
                        <div class="sales-block_item-pic_wrapper">
                            <img src="{{ $action['image'] }}" alt="" class="sales-block_item-pic">
                        </div>
                        <div class="sales-block_item-txt_wrapper">
                            <div class="sales-block_item-txt">
                                {{ $action['text'] }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="action_items-block">
                <span class="action_items-title related">Акции на конкрентые товары</span>
                <div class="product_items-block sale">
                    @include('public.layouts.sale-products', ['products' => $products])

                    @if($products->currentPage() < $products->lastPage())
                        <a href="/sale/&page={{ $products->currentPage()+1 }}" class="cat-block_more-items_btn" id="paginate" data-alias="/sale" data-sort="" data-current-page="{{ $products->currentPage() }}" data-pages-count="{{ $products->lastPage() }}">СМОТРЕТЬ ЕЩЕ 15 ТОВАРОВ</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection