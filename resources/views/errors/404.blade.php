@extends('public.layouts.main')
@section('meta')
    <title>Ошибка 404. Страница не найдена</title>
@endsection
@section('content')
    <section class="main-content">
        <div class="container">
            <div class="main-sidebar">
                <div class="filters">
                    @include('public.layouts.sidebar-menu', ['active' => true])
                </div>
            </div>

            <div class="main-wrapper">
                @include('public.layouts.search-form')

                <div class="not-found_wrapper">
                    <div class="not-found">
                        <span class="not-found_title">404</span>
                        <span class="not-found_subtitle">not found</span>
                        <span class="not-found_descr1">Упс, страница не найдена</span>
                        <span class="not-found_descr2">Запрашиваемая страница не существует, или удалена</span>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection