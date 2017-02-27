@extends('public.layouts.main')
@section('meta')
    <title>Поиск: {{ $search_text }}</title>
    <meta name="description" content="Поиск по запросу: {{ $search_text }}">
    <meta name="keywords" content="{{ $search_text }}">
@endsection

@section('content')
    <div class="container">
        <h2 class="catalog-title">Поиск: {!! $search_text !!}</h2>
    </div>

    <section class="catalog-content">
        <div class="container">
            <div class="row">
                <div class="catalog-cards clearfix" id="category-content">
                    @foreach($products as $product)
                        @include('public.layouts.product', ['product' => $product, 'search' => true])
                    @endforeach
                </div>
                {!! $products->appends(['text' => $search_text])->render() !!}
            </div>
        </div>
    </section>
@endsection