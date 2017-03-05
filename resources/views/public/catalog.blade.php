@extends('public.layouts.main', ['partition' => 'catalog', 'wrapper_class' => 'catalog'])
@section('meta')
    <title>{!! $settings->meta_title !!}</title>
    <meta name="description" content="{!! $settings->meta_description !!}">
    <meta name="keywords" content="{!! $settings->meta_keywords !!}">
@endsection

@section('content')
    <section class="start-section">
        <div class="flex-mid">
            <h1>WEDDING <span>&amp;</span> EVENT <span>PLANNER</span></h1>
            <h2 class="slogan">Your wedding planning adventure starts here! Beautiful details. Inspiring ideas. Real weddings.</h2>
        </div>
    </section>
    @include('public.layouts.search-form')
    @include('public.layouts.categories')
    @include('public.layouts.posts_slider', ['class' => 'most-popular', 'title' => 'Most Popular', 'id' => 'popular-carousel', 'posts' => $popular, 'description' => 'Discover hundreds of popular providers recommended by <b>Wedding</b> <span>&amp;</span> <b>Event</b> Planner'])
    <section class="video-section">
        <div class="video-heading">GREAT WEDDING ON SAFARI IN KRUGER NATIONAL PARK</div>
    </section>
    @include('public.layouts.posts_slider', ['class' => 'new-providers', 'title' => 'New Providers', 'id' => 'providers-carousel', 'posts' => $providers, 'description' => 'Discover hundreds of popular providers recommended by <b>Wedding</b> <span>&amp;</span> <b>Event</b> Planner'])
    @include('public.layouts.providers_portfolio')
@endsection