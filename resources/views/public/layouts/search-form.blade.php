<section id="search-prov" class="search-prov">
    <h2>Search over 10 000 providers in over 10 countries</h2>
    <form action="">
        <div class="container-custom">
            <div class="filter-menu-btn">
                <a href="#"></a>
            </div>
            <div class="search-filter dropdown city">
                <select name="city" id="search_city" class="fancyselect hidden">
                    <option value="">{{ trans('app.your_city') }}</option>
                    @foreach($settings->cities as $key => $city)
                        @if(!empty($city->$locale))
                            <option value="{{ $key }}"{{ isset($city_id) && is_numeric($city_id) && $key == $city_id ? ' selected' : '' }}>{{ $city->$locale }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="search-filter dropdown you-event">
                <select name="event" id="search_event" class="fancyselect hidden">
                    <option value="">{{ trans('app.your_event') }}</option>
                    @foreach($settings->events as $key => $event)
                        @if(!empty($event->$locale))
                            <option value="{{ $key }}">{{ $event->$locale }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="search-filter dropdown looking">
                <select name="category" id="search_category" class="fancyselect hidden">
                    <option value="">{{ trans('app.who_are_you_looking_for') }}</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"{{ is_object($category) && $cat->id == $category->id ? ' selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search-filter dropdown date">
                <a data-toggle="dropdown" href="#">{{ trans('app.date') }}</a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li><a href="#">Date</a></li>
                    <li><a href="#">Date</a></li>
                    <li><a href="#">Date</a></li>
                </ul>
            </div>
            <div class="search">
                <button type="submit">{{ trans('app.search') }}</button>
            </div>
            <div class="clear"></div>
        </div>
    </form>
</section>