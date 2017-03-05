@if(isset($posts) && count($posts) > 0)
<section class="{{ $class }}">
    <h2>{{ $title or '' }}</h2>
    <div class="section-desc">{!! $description or '' !!}</div>
    <div id="{{ $id }}" class="providers-carousel carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php $i = 0; ?>
            @foreach($posts as $post)
                @if($i%3 == 0)
                    <div class="item{{ $i == 0 ? ' active' : '' }}"><div class="container-custom"><div class="row">
                @endif
                <div class="col-md-4">
                    <div class="thumbnail">
                        <a href="/catalog/company/{{ $post->id }}/">
                            <div class="thumbnail-inner"></div>
                            <img src="{{ $post->avatar->url() }}" alt="">
                            <div class="caption">
                                <span>{{ $post->name }}</span>
                                <div class="caption-heading">{{ $post->first_name }}</div>
                                <p>{{ empty($post->preview) ? '' : $post->preview }}</p>
                            </div>
                        </a>
                    </div>
                </div>

                @if($i%3 == 2)
                    </div></div></div>
                @endif
                <?php $i++; ?>
            @endforeach

            @if($i%3 != 0)
                </div></div></div>
            @endif
        </div>
        <!-- Controls -->
        <a class="left control" href="#{{ $id }}" data-slide="prev">
            <span class=""></span>
        </a>
        <a class="right control" href="#{{ $id }}" data-slide="next">
            <span class=""></span>
        </a>
    </div>
</section>
@endif