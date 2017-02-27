@include('admin.layouts.header')
@extends('admin.layouts.main')
@section('title')
    {!! $module->name !!}
@endsection
@section('content')

    <div class="content-title">
        <div class="row">
            <div class="col-sm-12">
                <h1>{!! $module->name !!}</h1>
            </div>
        </div>
    </div>

    <div class="form">
        <form method="post">
            {!! csrf_field() !!}
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Слайды</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table slideshow-images">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="success">
                                        <td>Изображение</td>
                                        <td>Ссылка</td>
                                        <td>Статус</td>
                                        <td>Порядок сортировки</td>
                                        <td align="center">Действия</td>
                                    </tr>
                                </thead>
                                <tbody id="modules-table">
                                    @forelse($settings->banners as $key => $banner)
                                        <tr>
                                            <td>
                                                <input type="hidden" id="module-image-{!! $key !!}" name="settings[banners][{!! $key !!}][image_id]" value="{!! $banner->image_id !!}" />
                                                <div id="module-image-output-{!! $key !!}" class="module-image">
                                                    <img src="{!! $image->get_file_url((int)$banner->image_id) !!}" />
                                                    <button type="button" class="btn btn-del" data-delete="{!! $key !!}" data-toggle="tooltip" data-placement="bottom" title="Удалить изображение">X</button>
                                                    <button type="button" data-open="module-image" data-key="{!! $key !!}" class="btn">Выбрать изображение</button>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" name="settings[banners][{!! $key !!}][link]" class="form-control" value="{!! $banner->link !!}" />
                                            </td>
                                            <td>
                                                <select name="settings[banners][{!! $key !!}][enabled]" class="form-control">
                                                    @if($banner->enabled)
                                                        <option value="1" selected>Отображать</option>
                                                        <option value="0">Скрыть</option>
                                                    @else
                                                        <option value="1">Да</option>
                                                        <option value="0" selected>Нет</option>
                                                    @endif
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="settings[banners][{!! $key !!}][sort_order]" class="form-control" value="{!! $banner->sort_order !!}" />
                                            </td>
                                            <td align="center">
                                                <button class="btn btn-danger" onclick="$(this).parent().parent().remove();">Удалить</button>
                                                @if($key == count($settings->banners) - 1)
                                                    <input type="hidden" value="{!! $key !!}" id="slideshow-iterator" />
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="empty">
                                            <td colspan="5" align="center">Нет добавленных баннеров!</td>
                                        </tr>
                                        <input type="hidden" value="0" id="slideshow-iterator" />
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td align="center"><button type="button" id="button-add-slide" class="btn">Добавить баннер</button></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Настройки модуля</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Статус</label>
                                <div class="form-element col-sm-10">
                                    <select name="status" class="form-control">
                                        @if($module->status)
                                            <option value="1" selected>Включить</option>
                                            <option value="0">Выключить</option>
                                        @else
                                            <option value="1">Включить</option>
                                            <option value="0" selected>Выключить</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-10 col-sm-push-2 text-left">
                                    <button type="submit" class="btn">Сохранить</button>
                                    <a href="/admin/modules" class="btn btn-primary">Назад</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
@section('before_footer')
    @include('admin.layouts.imagesloader')
@endsection
