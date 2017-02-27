@include('admin.layouts.header')
@extends('admin.layouts.main')
@section('title')
    Список запросов скидки
@endsection
@section('content')

    <div class="content-title">
        <div class="row">
            <div class="col-sm-12">
                <h1>Список запросов скидки</h1>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs">
        <li{!! empty($status) || $status == 'new' ? ' class="active"' : '' !!}><a href="/admin/personal_sales">Новые</a></li>
        <li{!! $status == 'old' ? ' class="active"' : '' !!}><a href="/admin/personal_sales?status=old">Обработанные</a></li>
    </ul>
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="table table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr class="success">
                        <td>Имя</td>
                        <td>E-mail</td>
                        <td>Товар</td>
                        <td>Интересуют аналоги</td>
                        {!! $status == 'old' ? '<td>Статус</td>' : '' !!}
                        <td align="center">Дата и время запроса</td>
                        {!! $status == 'old' ? '' : '<td align="center">Действия</td>' !!}
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($sales))
                        @foreach($sales as $sale)
                            <tr>
                                <td>
                                    <span>{{ $sale->name }}</span>
                                </td>
                                <td>{!! $sale->email !!}</td>
                                <td>
                                    <a href="/product/{!! $sale->product->url_alias !!}" target="_blank">{!! $sale->product->name !!}</a>
                                </td>
                                <td class="status" align="center">
                                    {{ $sale->analog }}
                                </td>
                                @if($status == 'old')
                                    <td>
                                        {!! $status_array[$sale->status] !!}
                                    </td>
                                @endif
                                <td align="center">
                                    {!! $sale->updated_at !!}
                                </td>
                                @if($status != 'old')
                                <td class="actions" align="center">
                                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#personal_sales-submit-modal" data-placement="top" title="Дать скидку" onclick="$('#personal_sale_id').val({{ $sale->id }})">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete('personal_sales', '{!! $sale->id !!}')" data-toggle="tooltip" data-placement="top" title="Отказать">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @elseif(empty($sales))
                        <tr>
                            <td colspan="6" align="center">Еще не добавлено ни одного запроса!</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>

            @if($sales->links())
                <div class="panel-footer text-right">
                    {!! $sales->links() !!}
                </div>
            @endif
        </div>
    </div>

    <div id="personal_sales-delete-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Подтверждение отказа</h4>
                </div>
                <div class="modal-body">
                    <p>Отказать в скидке?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <a type="button" class="btn btn-primary" id="confirm">Отказать</a>
                </div>
            </div>
        </div>
    </div>

    <div id="personal_sales-submit-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="/admin/personal_sales/update" method="post">
                    {!! csrf_field() !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Дать скидку</h4>
                    </div>
                    <div class="modal-body">
                            <input type="hidden" name="id" id="personal_sale_id">
                            <input type="text" placeholder="Размер скидки" name="sale_size">
                            <input type="radio" name="unit" value="%" id="percent" checked><label for="percent">%</label>
                            <input type="radio" name="unit" value="грн" id="uah"><label for="uah">грн</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-default">Подтвердить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
