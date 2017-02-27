@if(isset($posts) && count($posts) > 0)
<section class="providers-portfolio">
    <h2>Our Providers Portfolio</h2>
    <div class="section-desc">See what is our providers made for our customers</div>
    <div id="ri-grid" class="ri-grid ri-grid-size-2">
        <ul>
            @foreach($posts as $post)
                <li><a href="/catalog/company/{{ $post->user_id }}/"><img src="{{ $post->thumb->url() }}"/></a></li>
            @endforeach
        </ul>
    </div>
</section>
@endif