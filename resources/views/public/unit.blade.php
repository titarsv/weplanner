@extends('public.layouts.main')
@section('meta')
    <title>{!! $unit->meta_title !!}</title>
    <meta name="description" content="{!! $unit->meta_description or '' !!}">
    <meta name="keywords" content="{!! $unit->meta_keywords or '' !!}">
@endsection

@section('breadcrumbs')
    @if(count($parent_categories) == 3)
        {!! Breadcrumbs::render('catalog', $parent_categories[0], $parent_categories[1], $parent_categories[2], $unit) !!}
    @else
        {!! Breadcrumbs::render('brand', $unit) !!}
    @endif
@endsection

@section('content')
    <section class="main-content">
        <div class="container">
            <div class="main-sidebar">

                <div class="filters">
                    @include('public.layouts.sidebar-menu', ['active' => true])

                    <div class="filters_secondary">

                        @if(!empty($brands) && !$brands->isEmpty())
                            <a href="#brand-list" class="showHideContent{!! !empty($models) ? '' : ' show' !!}"><div class="sidebar_subtitle secondary">БРЕНДЫ</div></a>

                            @if(!empty($parent_categories[1]))
                                <span class="filter" style="display: inline-block; margin: -15px 0 10px;"><a href="/catalog/{{ $parent_categories[1]->url_alias }}" class="active">{{ $parent_categories[1]->name }}</a></span>
                            @endif

                            @if(count($brands) > 1 || (empty($parent_categories[1]) && count($brands) > 0) )
                                <div id="brand-list" class="hidden_content"{{ !empty($models) ? ' style=display:none' : '' }}>
                                    <ul class="cat_menu-list">
                                        @foreach($brands as $brand)
                                            @if(empty($parent_categories[1]) || $brand->id != $parent_categories[1]->id)
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

                            @if(!empty($parent_categories[2]))
                                <span class="filter" style="display: inline-block; margin: -15px 0 10px;"><a href="/catalog/{{ $parent_categories[2]->url_alias }}" class="active">{{ $parent_categories[2]->name }}</a></span>
                            @endif

                            @if(count($models) > 1 || (empty($parent_categories[2]) && count($models) > 0) )
                                <div id="model-list" class="hidden_content"{!! !empty($units) ? ' style=display:none' : '' !!}>
                                    <ul class="cat_menu-list">
                                        @foreach($models as $model)
                                            @if(empty($parent_categories[2]) || $model->id != $parent_categories[2]->id)
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

                            @if(!empty($unit))
                                <span class="filter" style="display: inline-block; margin: -15px 0 10px;"><a href="/catalog/{{ $unit->url_alias }}" class="active">{{ $unit->name }}</a></span>
                            @endif

                            <div id="unit-list" class="hidden_content">
                                <ul class="cat_menu-list">
                                    @foreach($units as $item)
                                        @if(empty($unit) || $item->id != $unit->id)
                                        <li class="cat_menu-item unit filter">
                                            <a href="/unit/{{ $item->url_alias }}?model={{ $unit->id }}" class="">{{ $item->name }}</a>
                                        </li>
                                        @endif
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

                <div class="scheme-filter-block">
                    <span class="category-block_title">{{ $unit->name }}</span>
                    @if(!empty($unit))
                        <span class="category-block_subtitle">Выберите подходящую деталь на схеме:</span>
                        <div class="category-block_filter-items">
                            <ul class="category-block_filter-items__left" id="schemes">
                                @foreach($unit->schemes as $key => $scheme)
                                    <li class="category-block_filter-item{{ $key == 0 ? ' active' : '' }}"><a href="#scheme_{{ $scheme->id }}" data-toggle="tab">{{ $scheme->name }}</a></li>
                                @endforeach
                            {{--</div>--}}
                            {{--<div class="category-block_filter-items__right">--}}
                                <li class="category-block_filter-hide_scheme" data-toggle="tab"><a href="#scheme_hide" data-toggle="tab">Скрыть схему</a></li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade in" id="scheme_hide"></div>
                            @foreach($unit->schemes as $key => $scheme)
                                <div class="tab-pane fade in{{ $key == 0 ? ' active' : '' }}" id="scheme_{{ $scheme->id }}">
                                    <div class="scheme-block-wrapper">
                                        <div id="mapdiv" class="scheme-block">
                                            @include('public.layouts.map', ['scheme' => $scheme, 'map' => $maps[$scheme->id], 'selected' => $selected_in_maps[$scheme->id]])
                                        </div>
                                    </div>
                                    <div class="scale-block">
                                        <span class="scale-block_title">Масштаб 100%</span>
                                        <span class="scale-block_minus active"><span class="scale-block_minus-txt">уменьшить</span> -</span>
                                        <span class="scale-block_plus"><span class="scale-block_minus-txt">увеличить</span> +</span>
                                        <span class="scale-block_clear show_all_products">Показать все товары</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>



                <div class="cat-block">

                    @foreach($products as $product)
                        @include('public.layouts.product', ['product' => $product])
                    @endforeach

                    {{--<a class="cat-block_more-items_btn">СМОТРЕТЬ ЕЩЕ 500 ТОВАРОВ</a>--}}

                </div>

                <div class="seo-block">
                    {!! $unit->description !!}
                </div>
            </div>
        </div>
    </section>
@endsection