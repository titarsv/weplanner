@foreach($units as $unit)
    <tr>
        <td width="50%" style="padding-left: calc(25px * {!! $child !!});">
            {{ $unit->name }}
        </td>
        <td class="description">
            <img src="{{ $unit->image->get_current_file_url() }}" class="img-thumbnail" alt="image" />
        </td>
        <td>
            {{ $unit->sort_order }}
        </td>
        <td class="status">
            <span class="{!! $unit->status ? 'on' : 'off' !!}">
                <span class="runner"></span>
            </span>
        </td>
        <td class="actions" align="center">
            <a class="btn btn-primary" href="/admin/units/edit/{!! $unit->id !!}" data-toggle="tooltip" data-placement="top" title="Редактировать">
                <i class="glyphicon glyphicon-edit"></i>
            </a>
            <button type="button" class="btn btn-danger" onclick="confirmDelete('units', '{!! $unit->id !!}', '{!! $unit->name !!}')" data-toggle="tooltip" data-placement="top" title="Удалить">
                <i class="glyphicon glyphicon-trash"></i>
            </button>
        </td>
    </tr>
@endforeach

