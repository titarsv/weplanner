@if ($breadcrumbs)
    <nav class="breadcrumbs">
        <div class="container">
            <ul>
                @foreach ($breadcrumbs as $breadcrumb)
                    @if (!$breadcrumb->last)
                        <li class="breadcrumbs_item"><a class="breadcrumbs_item-link" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                    @else
                        <li class="breadcrumbs_item"><span class="breadcrumbs_item-link active">{{ $breadcrumb->title }}</span></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </nav>
@endif
