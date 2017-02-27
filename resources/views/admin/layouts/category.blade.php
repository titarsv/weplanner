@foreach($categories as $category)
    <tr @if($category->parent_id) class="collapsed" data-child="{!! $child !!}" @endif>
        <td width="50%" style="padding-left: calc(25px * {!! $child !!});">
            @if($category->parent_id)
                <div class="category-{!! $category->parent_id !!} collapse">
                    @if(!$category->children->isEmpty())
                        <a class="category-collapse-link" data-target=".category-{!! $category->id !!}" data-child="{!! $child + 1 !!}">{{ $category->name }}</a>
                    @else
                        {{ $category->name }}
                    @endif
                </div>
            @else
            @if(!$category->children->isEmpty())
                <a class="category-collapse-link" data-target=".category-{!! $category->id !!}" data-child="{!! $child + 1 !!}">{{ $category->name }}</a>
            @else
                {{ $category->name }}
            @endif
            @endif
        </td>
        <td class="description">
            @if($category->parent_id)
                <div class="category-{!! $category->parent_id !!} collapse" data-child="{!! $child !!}">
                    <img src="{{ $category->image->get_current_file_url() }}" class="img-thumbnail" alt="image" />
                </div>
            @else
               <img src="{{ $category->image->get_current_file_url() }}" class="img-thumbnail" alt="image" />

            @endif

        </td>
        <td>
            @if($category->parent_id)
                <div class="category-{!! $category->parent_id !!} collapse" data-child="{!! $child !!}">
                    {{ $category->sort_order }}
                </div>
            @else
                {{ $category->sort_order }}
            @endif
        </td>
        <td class="status">
            @if($category->parent_id)
                <div class="category-{!! $category->parent_id !!} collapse" data-child="{!! $child !!}">
                    <span class="{!! $category->status ? 'on' : 'off' !!}">
                        <span class="runner"></span>
                    </span>
                </div>
            @else
                <span class="{!! $category->status ? 'on' : 'off' !!}">
                    <span class="runner"></span>
                </span>
            @endif
        </td>
        <td class="actions" align="center">
            @if($category->parent_id)
                <div class="category-{!! $category->parent_id !!} collapse" data-child="{!! $child !!}">
                <a class="btn btn-primary" href="/admin/categories/edit/{!! $category->id !!}" data-toggle="tooltip" data-placement="top" title="Редактировать">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>
                <button type="button" class="btn btn-danger" onclick="confirmDelete('categories', '{!! $category->id !!}', '{!! $category->name !!}')" data-toggle="tooltip" data-placement="top" title="Удалить">
                    <i class="glyphicon glyphicon-trash"></i>
                </button>
                </div>
            @else
                <a class="btn btn-primary" href="/admin/categories/edit/{!! $category->id !!}" data-toggle="tooltip" data-placement="top" title="Редактировать">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>
                <button type="button" class="btn btn-danger" onclick="confirmDelete('categories', '{!! $category->id !!}', '{!! $category->name !!}')" data-toggle="tooltip" data-placement="top" title="Удалить">
                    <i class="glyphicon glyphicon-trash"></i>
                </button>
            @endif

        </td>
    </tr>
    @if(!$category->children->isEmpty())
        @include('admin.layouts.category', ['categories' => $category->children, 'child' => $child + 1])
    @endif
@endforeach

