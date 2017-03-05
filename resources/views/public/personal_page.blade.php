@extends('public.layouts.main', ['partition' => 'catalog', 'wrapper_class' => 'catalog-company'])
@section('meta')
    <title>{{ empty($user->user_data->company) ? $user->first_name.' '.$user->last_name : $user->user_data->company }} - {{ $settings->meta_title }}</title>
    <meta name="description" content="{!! $settings->meta_description !!}">
@endsection

@section('content')
    <section class="start-section">
        <div id="carousel-img" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @if(!empty($gallery))
                    @foreach($gallery as $key => $image)
                        <div class="item{{ $key == 0 ? ' active' : '' }}">
                            <img src="{{ $image->url() }}" alt="">
                        </div>
                    @endforeach
                @endif
            </div>
            <a class="left control" href="#carousel-img" data-slide="prev">
            </a>
            <a class="right control" href="#carousel-img" data-slide="next">
            </a>
        </div>
    </section>
    <section class="company-open">
        <div class="heading">
            <div class="container-custom">
                <div class="img">
                    <img src="{{ $user->avatar->url() }}" alt="">
                    <div class="mask"></div>
                </div>
                <div class="company-info">
                    <h2>{{ empty($user->user_data->company) ? $user->first_name.' '.$user->last_name : $user->user_data->company }}</h2>
                    <div class="desc">
                        {!! empty($category) ? '' : '<div>'.$category->name.'</div>' !!}
                        <div>{{ $user->user_data->city_name }}, {{ $user->user_data->country_name }}</div>
                        <div class="stars">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa fa-star{{ $i <= $user->user_data->rating ? ' act' : '' }}" aria-hidden="true"></i>
                            @endfor
                            <span>{!! $user->reviews->count() !!} {{ trans_choice('app.reviews', $user->reviews->count()) }}</span>
                        </div>
                    </div>
                    <div class="kitch">
                        @foreach($attributes as $attribute => $values)
                            {{ $attribute }}:
                            @foreach($values as $val_id => $value)
                                {{ $val_id > 0 ? ', ' : '' }}
                                <a href="/catalog/category/{{ $category->id }}?attr[]={{ $value->id }}">{{ $value->name }}</a>
                            @endforeach
                        @endforeach
                    </div>
                    <ul class="social">
                        <li><a class="fb" href="#"></a></li>
                        <li><a class="vk" href="#"></a></li>
                        <li><a class="in" href="#"></a></li>
                        <li><a class="insta" href="#"></a></li>
                        <li><a class="pt" href="#"></a></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="information">
            <div class="container-custom">
                <div class="row">
                    <div class="col-md-8 for-coordinats">
                        {!! $user->user_data->about !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="bill-coupon" style="left: 805px;">
            <form class="bill-form" action="#">
                <header>
                    <div class="icon"></div>
                    Average bill:
                    <span>${!! $user->user_data->average_bill !!}</span> / guest
                </header>
                <label class="pull-left" for="bill-date">
                    Date
                    <input id="bill-date" class="op-place" type="text" placeholder="dd/mm/yyyy">
                </label>
                <label class="pull-right" for="bill-text">
                    Guests
                    <input id="bill-text" class="op-place" type="text" placeholder="0">
                </label>
                <button class="bill-submit" type="submit">Book now</button>
                <p>Your credit card won’t be charged</p>
                <button class="bill-save">Save to Wishlist</button>
            </form>
            <div class="bill-address">
                @if(!empty($user->user_data->address))
                    <div class="text">Address:</div>
                    <span>{{ $user->user_data->city_name }}, {{ $user->user_data->country_name }}. {{ $user->user_data->address }}</span>
                @endif

                @if(!empty($user->phone))
                    <div class="text">Phone:</div>
                    <span>{{ $user->phone }}</span>
                @endif

                @if(!empty($user->email))
                    <div class="text">E-mail:</div>
                    <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                @endif

                @if(!empty($user->user_data->url))
                    <div class="text">Web-site:</div>
                    <a href="{{ $user->user_data->url }}">{{ $user->user_data->url }}</a>
                @endif

            </div>
        </div>
    </section>
    <section class="company-reviews">
        <div class="container-custom">
            <div class="row">
                <div class="col-md-8">
                    <div class="heading">
                        <span>47 reviews</span>
                        <div class="stars">
                            <i class="fa fa-star act" aria-hidden="true"></i>
                            <i class="fa fa-star act" aria-hidden="true"></i>
                            <i class="fa fa-star act" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="pull-right"><a class="see-all" href="#">See all Review</a></div>
                        <div class="clear"></div>
                    </div>
                    <div class="reviews-block">
                        <div class="image">
                            <img class="img-circle" src="/img/bitmap-1.png" alt="">
                        </div>
                        <div class="text">
                            <div class="name">Artur</div>
                            <p>More expensive than most in Odessa! Fairly small choice however the food was enjoyable.....on main road so can be noisy if you eat outside</p>
                            <div class="date">August 14, 2016</div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="reviews-block">
                        <div class="image">
                            <img class="img-circle" src="/img/bitmap-1.png" alt="">
                        </div>
                        <div class="text">
                            <div class="name">Artur</div>
                            <p>More expensive than most in Odessa! Fairly small choice however the food was enjoyable.....on main road so can be noisy if you eat outside</p>
                            <div class="date">August 14, 2016</div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="reviews-block">
                        <div class="image">
                            <img class="img-circle" src="/img/bitmap-1.png" alt="">
                        </div>
                        <div class="text">
                            <div class="name">Artur</div>
                            <p>More expensive than most in Odessa! Fairly small choice however the food was enjoyable.....on main road so can be noisy if you eat outside</p>
                            <div class="date">August 14, 2016</div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <nav aria-label="Page navigation" class="page-nav">
                        <ul class="pagination">
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li class="ellipsis"><a href="#">...</a></li>
                            <li><a href="#">9</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="tabs-section">
        <div class="nav-tabs-wrap">
            <div class="container-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#photo" data-toggle="tab">Photos</a></li>
                    <li><a href="#video" data-toggle="tab">Video</a></li>
                    <li><a href="#audio" data-toggle="tab">Audio</a></li>
                </ul>
            </div>
        </div>
        <!-- Tab panes -->
        <div class="container-custom">
            <div class="tab-content">
                <div class="tab-pane active" id="photo">
                    <div class="heading">
                        <span>23 Albums</span>
                        <div class="pull-right"><a class="see-all" href="#">See all Review</a></div>
                        <div class="clear"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <div class="thumbnail-inner"></div>
                                <img src="/img/bitmap-1.png" alt="">
                                <div class="caption">
                                    <span>Presenters</span>
                                    <div class="caption-heading">Кирилл Камышанский ведущий, тамада</div>
                                    <p>Автор и ведущий игры «Mad Heads» в Харькове. Частый гость на свадьбах. Ваши гости будут в восторге от Кирилла!</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <div class="thumbnail-inner"></div>
                                <img src="/img/bitmap-2.png" alt="">
                                <div class="caption">
                                    <span>Cakes and confectioner</span>
                                    <div class="caption-heading">Анна Тарасенко — свадебный кондитер</div>
                                    <p>Гости по достоинству оценят наши кулинарные произведения. Неудивительно, ведь выпечка — это сытно и очень вкусно.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <div class="thumbnail-inner"></div>
                                <img src="/img/bitmap-3.png" alt="">
                                <div class="caption">
                                    <span>Photography</span>
                                    <div class="caption-heading">Денис Панченко — фотожурналист</div>
                                    <p>Шеф-редактор портала Geometria.ru. Фотограф от Бога, который сделает ваши свадебные снимки незабываемыми.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="video">2</div>
                <div class="tab-pane" id="audio">3</div>
            </div>
        </div>
    </section>
@endsection