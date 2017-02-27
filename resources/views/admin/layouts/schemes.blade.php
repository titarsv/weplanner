<div class="col-sm-2">
    <label class="text-right" style="float: right;">Схемы</label>
    <ul class="nav nav-tabs">
        @foreach($schemes as $key => $scheme)
            <li{{ $key == 0 ? ' class="active"' : '' }}>
                <a href="#scheme_{{ $scheme->id }}" data-toggle="tab">
                    <img src="{{ $scheme->image->url() }}" style="width: 100%">
                </a>
            </li>
        @endforeach
    </ul>
</div>
<div class="form-element col-sm-10">
    <div class="tab-content">
        @foreach($schemes as $key => $scheme)
            <div class="tab-pane{{ $key == 0 ? ' active' : '' }}" id="scheme_{{ $scheme->id }}" style="position: relative;">
                @include('public.layouts.map', ['scheme' => $scheme, 'map' => $scheme->areas, 'selected' => isset($schemes_positions[$scheme->id]) ? $schemes_positions[$scheme->id] : []])
                <input type="hidden" name="product_scheme[{{ $scheme->id }}]" id="product_scheme_{{ $scheme->id }}"
                       value="{{ isset($schemes_positions[$scheme->id]) ? $schemes_positions[$scheme->id][0] : '' }}">
            </div>
        @endforeach
    </div>
</div>