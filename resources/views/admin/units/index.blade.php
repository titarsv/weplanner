@include('admin.layouts.header')
@extends('admin.layouts.main')
@section('title')
    Список узлов
@endsection
@section('content')

    <div class="content-title">
        <div class="row">
            <div class="col-sm-10">
                <h1>Список узлов</h1>
            </div>
            <div class="col-sm-2 text-right">
                <a href="/admin/units/create" class="btn">Добавить</a>
            </div>
        </div>
    </div>


    @if (session('message-success'))
        <div class="alert alert-success">
            {{ session('message-success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('message-error'))
        <div class="alert alert-danger">
            {{ session('message-error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="panel-group">
        <div class="panel panel-default">
            <div class="table table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="success">
                            <td>Название узла</td>
                            <td>Изображение</td>
                            <td>Порядок сортировки</td>
                            <td>Статус</td>
                            <td align="center">Действия</td>
                        </tr>
                    </thead>
                    <tbody class="category-table">
                        @if(!$units->isEmpty())
                            @include('admin.layouts.unit', ['units' => $units, 'child' => 1])
                        @else
                            <tr>
                                <td colspan="6" class="colspan">Нет добавленных узлов!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
           @if ($units->links())
                <div class="panel-footer text-right">
                    {{ $units->links() }}
                </div>
           @endif
        </div>
    </div>

    <div id="categories-delete-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Подтверждение удаления</h4>
                </div>
                <div class="modal-body">
                    <p>Удалить категорию <span id="categories-name"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <a type="button" class="btn btn-primary" id="confirm">Удалить</a>
                </div>
            </div>
        </div>
    </div>

@endsection
