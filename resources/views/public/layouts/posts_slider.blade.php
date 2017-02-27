@if(isset($posts) && is_array($posts) && count($posts) > 0){?>
<section class="{{ $class }}">
    <h2>{{ $title }}</h2>
    <div class="section-desc">{{ $description }}</div>
    <div id="{{ $id }}" class="providers-carousel carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php
            $i = 0;
            foreach($posts as $post){
            if($i%3 == 0){
                echo '<div class="item'.($i==0?' active':'').'"><div class="container-custom"><div class="row">';
            } ?>

            <div class="col-md-4">
                <div class="thumbnail">
                    <a href="/catalog/company/{{ $post->id }}/">
                        <div class="thumbnail-inner"></div>
                        <img src="{{ $post->avatar }}" alt="">
                        <div class="caption">
                            <span>{{ $post->name }}</span>
                            <div class="caption-heading">{{ $post->first_name }}</div>
                            {{ empty($post->page_brief) ? '<p></p>' : $post->page_brief }}
                        </div>
                    </a>
                </div>
            </div>

            <?php if($i%3 == 2){
                echo '</div></div></div>';
            }
            $i++;
            }

            if($i%3 != 0){
                echo '</div></div></div>';
            }
            ?>
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