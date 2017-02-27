<a href="#categories-list" class="showHideContent{!! isset($active) ? ' show' : '' !!}"><div class="sidebar_subtitle">КАТАЛОГ ТОВАРОВ</div></a>

<div id="categories-list" class="hidden_content" {!! isset($active) ? '' : ' style="display: none;"' !!}>
    <ul class="cat_menu-list">
        @foreach($root_categories as $category)
            <li class="cat_menu-item{{!empty($selected) && $category->id == $selected ? ' active' : ''}}">
                <a href="/catalog/{{ $category->url_alias }}" class="cat_menu-link">{{ $category->name }}</a>
            </li>
        @endforeach
    </ul>
</div>