<img src="{{ $scheme->image->url() }}" alt="{{ $scheme->name }}"
     title="{{ $scheme->name }}" class="map-all map" style="width: 100%" usemap="#map_{{ $scheme->id }}"/>
<map name="map_{{ $scheme->id }}" id="map_{{ $scheme->id }}" class="scheme_map" data-destination="product_scheme_{{ $scheme->id }}">
@foreach($map as $area)
    <area href="#product-{{ $area['id'] }}" shape="{{ $area['shape'] }}" coords="{{ $area['coords'] }}" class="product-{{ $area['id'] }}"
          data-maphilight='{"groupBy":".product-{{ $area['id'] }}","alwaysOn":"{{ in_array($area['id'], $selected) }}"}'
          title="{{ isset($area['title']) ? $area['title'] : $area['id'] }}"{{ isset($area['product_id']) ? ' data-product='.$area['product_id'] : '' }}>
@endforeach
</map>
