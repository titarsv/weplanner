<section class="categories">
    <h2>Our Categories</h2>
    <div class="section-desc">Discover hundreds of local providers recommended by <b>Wedding</b> <span>&amp;</span> <b>Event</b> Planner</div>
    <div class="categories-block container-custom">
        @if(isset($categories) && count($categories) > 0)
            <?php $i = 1; ?>
            @foreach($categories as $category)
                @if($i == 1)
                    <ul class="categories-list">
                @endif

                <li>
                    <a href="/catalog/{{ $category->slug }}"><span class="categories-icon {{ $category->slug }}"></span>{{ $category->name }}</a>
                </li>

                @if($i == 6)
                    </ul>
                    <?php $i = 1; ?>
                @else
                    <?php $i++; ?>
                @endif
            @endforeach
            @if($i != 1)
                </ul>
            @endif
        @endif
    </div>
</section>