<div class="search-block">
    <form action="{{ !empty($action) ? $action : '/search' }}" method="get">
        <input name="search" class="search" type="text" placeholder="Поиск">
        <button class="search_btn">Поиск</button>
        {{--<div class="search-example-block">--}}
            {{--например: <span class="search-example">косилка для мтз</span>--}}
        {{--</div>--}}
    </form>
</div>