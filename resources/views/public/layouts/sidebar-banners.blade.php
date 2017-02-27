@if(!empty($banners))
    @foreach($banners as $banner)
        <a href="{{ $banner['link'] }}" class="sidebar_banner">
            <img alt="" src="{{ $banner['image'] }}" class="sidebar_banner-img">
        </a>
    @endforeach
@endif