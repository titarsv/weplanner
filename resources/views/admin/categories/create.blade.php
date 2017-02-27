@include('admin.layouts.header')
@extends('admin.layouts.main')
@section('title')
    Добавление категории
@endsection
@section('content')

    <div class="content-title">
        <div class="row">
            <div class="col-sm-12">
                <h1>Добавление категории</h1>
            </div>
        </div>
    </div>

    @if(session('message-error'))
        <div class="alert alert-danger">
            {{ session('message-error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="form">
        <form method="post">
            {!! csrf_field() !!}
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Общая информация</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right control-label">Название</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" data-translit="input" class="form-control" name="name" value="{!! old('name') !!}" />
                                    @if($errors->has('name'))
                                        <p class="warning" role="alert">{!! $errors->first('name',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Описание</label>
                                <div class="form-element col-sm-10">
                                    <textarea name="description" class="form-control" rows="6">{!! old('description') !!}</textarea>
                                    @if($errors->has('description'))
                                        <p class="warning" role="alert">{!! $errors->first('description',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Родительская категория</label>
                                <div class="form-element col-sm-10">
                                    <select name="parent_id" class="form-control">
                                        <option value="0">Не выбрано</option>
                                        @foreach($categories as $category)
                                            <option value="{!! $category->id !!}"
                                                    @if ($category->id == old('parent_id'))
                                                    selected
                                                    @endif
                                            >{!! $category->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<div class="row">--}}
                                {{--<label class="col-sm-2 text-right">Связанный атрибут (для фильтрации в главном меню)</label>--}}
                                {{--<div class="form-element col-sm-10">--}}
                                    {{--<select name="related_attribute_id" class="form-control">--}}
                                        {{--<option value="null">Не выбрано</option>--}}
                                        {{--@foreach($attributes as $attribute)--}}
                                            {{--<option value="{!! $attribute->id !!}"--}}
                                                {{--@if ($attribute->id == old('related_attribute_id'))--}}
                                                {{--selected--}}
                                                {{--@endif--}}
                                            {{-->{!! $attribute->name !!}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Изображение категории</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Выберите изображение </label>
                                <div class="form-element col-sm-10">
                                    <input type="hidden" id="image" name="image_id" value="{!! old('image_id', 1) !!}" />
                                    <div id="image-output" class="category-image">
                                        <img src="/assets/images/{!! old('href', 'no_image.jpg') !!}" />
                                        <button type="button" class="btn btn-del" data-toggle="tooltip" data-placement="bottom" title="Удалить изображение">X</button>
                                        <button type="button" data-open="image" id="add-image" class="btn">Выбрать изображение</button>
                                    </div>
                                    @if($errors->has('image_id'))
                                        <p class="warning" role="alert">{!! $errors->first('image_id', ':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>SEO</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right control-label">Title</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title') !!}" />
                                    @if($errors->has('meta_title'))
                                        <p class="warning" role="alert">{!! $errors->first('meta_title',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Meta description</label>
                                <div class="form-element col-sm-10">
                                    <textarea name="meta_description" class="form-control" rows="6">{!! old('meta_description') !!}</textarea>
                                    @if($errors->has('meta_description'))
                                        <p class="warning" role="alert">{!! $errors->first('meta_description',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Meta keywords</label>
                                <div class="form-element col-sm-10">
                                    <textarea name="meta_keywords" class="form-control" rows="6">{!! old('meta_keywords') !!}</textarea>
                                    @if($errors->has('meta_keywords'))
                                        <p class="warning" role="alert">{!! $errors->first('meta_keywords',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right control-label">Alias</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" data-translit="output" class="form-control" name="url_alias" value="{!! old('url_alias') !!}" />
                                    @if($errors->has('url_alias'))
                                        <p class="warning" role="alert">{!! $errors->first('url_alias',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Настройки</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Порядок сортировки</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="sort_order" value="{!! old('sort_order', 0) !!}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Отображать в популярных</label>
                                <div class="form-element col-sm-10">
                                    <select name="display_as_popular" class="form-control">
                                        @if(old('display_as_popular') !== null && !old('display_as_popular'))
                                            <option value="1">Да</option>
                                            <option value="0" selected>Нет</option>
                                        @else
                                            <option value="1" selected>Да</option>
                                            <option value="0">Нет</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<div class="row">--}}
                                {{--<label class="col-sm-2 text-right">Отображать в футере</label>--}}
                                {{--<div class="form-element col-sm-10">--}}
                                    {{--<select name="display_in_footer" class="form-control">--}}
                                        {{--@if(old('display_in_footer') !== null && !old('display_in_footer'))--}}
                                            {{--<option value="1">Да</option>--}}
                                            {{--<option value="0" selected>Нет</option>--}}
                                        {{--@else--}}
                                            {{--<option value="1" selected>Да</option>--}}
                                            {{--<option value="0">Нет</option>--}}
                                        {{--@endif--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Статус</label>
                                    <div class="form-element col-sm-10">
                                    <select name="status" class="form-control">
                                        @if(old('status') !== null && !old('status'))
                                            <option value="1">Включено</option>
                                            <option value="0" selected>Отключено</option>
                                        @else
                                            <option value="1" selected>Включено</option>
                                            <option value="0">Отключено</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-10 col-sm-push-2 text-left">
                                    <button type="submit" class="btn">Сохранить</button>
                                    <a href="/admin/categories" class="btn btn-primary">Назад</a>
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