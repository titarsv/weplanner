@extends('public.layouts.main')
@section('meta')
    <title>{!! $content->meta_title !!}</title>
    <meta name="description" content="{!! $content->meta_description !!}">
    <meta name="keywords" content="{!! $content->meta_keywords !!}">
@endsection

@section('content')
    <section class="main-content">
        <div class="container">

            <div class="main-sidebar">
                <div class="filters">

                    @include('public.layouts.sidebar-menu')

                </div>
            </div>

            <div class="main-wrapper">
                <div class="search-block">
                    <input class="search" type="text" placeholder="Поиск">
                    <button class="search_btn">Поиск</button>
                    <div class="search-example-block">
                        например: <span class="search-example">косилка для мтз</span>
                    </div>
                </div>

                {!! html_entity_decode($content->content) !!}
            </div>

        </div>
    </section>
@endsection