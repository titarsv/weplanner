@include('admin.layouts.header')
@extends('admin.layouts.main')
@section('title')
    Список статей
@endsection
@section('content')

    <div class="content-title">
        <div class="row">
            <div class="col-sm-10">
                <h1>Список статей</h1>
            </div>
            <div class="col-sm-2 text-right">
                <a href="/admin/articles/create" class="btn">Добавить</a>
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
                        <td>Заголовок</td>
                        <td>Изображение</td>
                        <td>Alias</td>
                        <td align="center">Опубликовано</td>
                        <td align="center">Действия</td>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($articles as $article)
                        <tr>
                            <td>
                                <p>{{ $article->title }}</p>
                            </td>
                            <td>
                                <img class="img-thumbnail" src="{!! $article->image->get_current_file_url() !!}" >
                            </td>
                            <td>
                                <p>{{ $article->url_alias }}</p>
                            </td>
                            <td class="status" align="colspan">
                                <span class="{!! $article->published ? 'on' : 'off' !!}">
                                    <span class="runner"></span>
                                </span>
                            </td>
                            <td align="center" class="actions">
                                <a class="btn btn-primary" href="/admin/articles/edit/{!! $article->id !!}" data-toggle="tooltip" data-placement="top" title="Редактировать">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger" onclick="confirmDelete('articles', '{!! $article->id !!}', '{!! $article->title !!}')" data-toggle="tooltip" data-placement="top" title="Удалить">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="colspan">Нет добавленных статей!</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($articles->links())
                <div class="panel-footer text-right">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </div>

    <div id="articles-delete-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Подтверждение удаления</h4>
                </div>
                <div class="modal-body">
                    <p>Удалить статью <span id="articles-name"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <a type="button" class="btn btn-primary" id="confirm">Удалить</a>
                </div>
            </div>
        </div>
    </div>

@endsection
