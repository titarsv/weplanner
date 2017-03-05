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
    @include('public.layouts.search-form', ['category' => $category])
    <section class="venues">
        <div class="container-custom">
            <header>
                <div id="filter-btn" class="filter-btn">
                    <a href="#">{{ trans('app.filters') }}</a>
                </div>
                <div class="venues-num">
                    <div class="in-compare"><a href="#">5 {{ trans('app.in_compare') }}</a></div>
                    <span>{{ $contractors->total() }}</span> {{ trans_choice('app.proposition', $contractors->total()) }}
                </div>
                <div class="clear"></div>
            </header>
            <div class="container-custom">
                <div class="row">
                    @foreach($contractors as $contractor)
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <div class="thumbnail-inner"></div>
                                @if($contractor->avatar)
                                <img src="{{ $contractor->avatar->url() }}" alt="">
                                @endif
                                <div class="caption">
                                    <span>{{ $contractor->name }}</span>
                                    <div class="caption-heading">{{ $contractor->first_name }}</div>
                                    <p>{{ empty($contractor->user_data->preview) ? '' : $contractor->user_data->preview }}</p>
                                </div>
                                <div class="hover-caption">
                                    <div class="info">
                                        <a href="/catalog/company/{{ $contractor->id }}/">
                                            <div class="caption-heading">{{ empty($contractor->user_data->company) ? $contractor->first_name.' '.$contractor->last_name : $contractor->user_data->company }}</div>
                                            <span class="city">{{ $contractor->user_data->city_name }}, {{ $contractor->user_data->country_name }}</span>
                                            <div class="stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa fa-star{{ $i <= $contractor->user_data->rating ? ' act' : '' }}" aria-hidden="true"></i>
                                                @endfor
                                            </div>
                                            <div class="bill">
                                                Average bill: <span>${{ round($contractor->user_data->average_bill) }}</span> / guest
                                            </div>
                                        </a>
                                        <div class="add">
                                            <span></span>
                                            <div><a href="#" data-id="{{ $contractor->id }}">Add to Compare</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-4">
                        <div class="thumbnail banner">
                            <span>Баннер</span>
                            <span>300х400</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="thumbnail row-banner">
                            <span>Баннер 930х180</span>
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="Page navigation" class="page-nav">
                {{--<ul class="pagination">--}}
                    {{--<li><a href="#">1</a></li>--}}
                    {{--<li><a href="#">2</a></li>--}}
                    {{--<li><a href="#">3</a></li>--}}
                    {{--<li class="ellipsis"><a href="#">...</a></li>--}}
                    {{--<li><a href="#">9</a></li>--}}
                {{--</ul>--}}
                {{ $contractors->render() }}
            </nav>
        </div>
        <div class="sliding-panel-wrap">
            <div class="sliding-panel">
                <form action="">
                    <header>
                        <h3>{{ trans('app.filters') }}</h3>
                        <div class="close"></div>
                    </header>
                    <hr>
                    <div class="filter-area price">
                        <div class="filter-label">
                            {{ trans('app.price_range') }}
                            <span>{{ trans('app.avg_bill_per') }} {{ $category->currency }}</span>
                        </div>
                        <div class="filter">
                            <div id="slider"></div>
                            <div class="amount-block">
                                <span class="val-0">$10</span>
                                <input type="text" id="amount" readonly>
                                <span class="val-1">$1000</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <hr>
                    <div class="filter-area">
                        <div class="filter-label areas">{{ trans('app.nearby_areas') }}</div>
                        <div class="filter">
                            <div class="dropdown city pull-left" style="width: 100%;">
                                <a data-toggle="dropdown" href="#">{{ trans('app.your_city') }}</a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    @foreach($settings->cities as $key => $city)
                                        @if(!empty($city->$locale))
                                            <li><a data-target="{{ $key }}">{{ $city->$locale }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            {{--<div class="dropdown distance pull-right">--}}
                                {{--<a data-toggle="dropdown" href="#">Distance From</a>--}}
                                {{--<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">--}}
                                    {{--<li><a href="#">Distance From</a></li>--}}
                                    {{--<li><a href="#">Distance From</a></li>--}}
                                    {{--<li><a href="#">Distance From</a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <hr>
                    <div class="filter-area">
                        <div class="filter-label areas">{{ trans('app.your_event') }}</div>
                        <div class="filter">
                            <div class="dropdown city pull-left" style="width: 100%;">
                                <a data-toggle="dropdown" href="#">{{ trans('app.who_are_you_looking_for') }}</a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    @foreach($categories as $cat)
                                        <li><a data-target="#">{{ $cat->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            {{--<div class="dropdown distance pull-right">--}}
                                {{--<a data-toggle="dropdown" href="#">Venue Settings</a>--}}
                                {{--<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">--}}
                                    {{--<li><a href="#">Venue Settings</a></li>--}}
                                    {{--<li><a href="#">Venue Settings</a></li>--}}
                                    {{--<li><a href="#">Venue Settings</a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    @if(!empty($services))
                    <hr>
                    <div class="filter-area">
                        <div class="filter-label">{{ trans('app.services') }}</div>
                        <div class="filter">
                            @foreach($services as $service)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="services[]" value="{{ $service->id }}">{{ $service->name }}
                                </label>
                            </div>
                            @endforeach
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="services[]" value="0">{{ trans('app.all') }}
                                </label>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    @endif
                    <hr>
                    <div class="filter-area">
                        <div class="filter-label">{{ trans('app.sorted_by') }}</div>
                        <div class="filter">
                            @foreach($sort_array as $sort)
                            <div class="checkbox">
                                <label>
                                    <input type="radio" name="sort" value="{{ $sort }}">{{ trans("app.$sort") }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <div class="clear"></div>
                    </div>
                    <hr>
                    <div class="btn-group">
                        <button type="button">{{ trans('app.cancel') }}</button>
                        <button class="apply" type="submit">{{ trans('app.apply_filters') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection