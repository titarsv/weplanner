@include('admin.layouts.header')
@extends('admin.layouts.main')
@section('title')
    Редактирование узла
@endsection
@section('content')

    <div class="content-title">
        <div class="row">
            <div class="col-sm-12">
                <h1>Редактирование узла {{ $unit->name }}</h1>
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
                                    <input type="text" data-translit="input" class="form-control" name="name" value="{!! old('name', $unit->name) !!}" />
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
                                    <textarea name="description" class="form-control" rows="6">{!! old('description',  $unit->description) !!}</textarea>
                                    @if($errors->has('description'))
                                        <p class="warning" role="alert">{!! $errors->first('description',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Модели техники</label>
                                <div class="form-element col-sm-10">
                                    <select name="categories[]" class="form-control chosen-select" multiple="multiple">
                                        @foreach($categories as $category)
                                            <option value="{!! $category->id !!}"
                                                    @if (in_array($category->id, (array)old('categories')))
                                                    selected
                                                    @elseif (in_array($category->id, $added_categories))
                                                    selected
                                                    @endif
                                            >{!! $category->meta_title !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Изображение узла</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Выберите изображение </label>
                                <div class="form-element col-sm-10">
                                    <input type="hidden" id="image" name="image_id" value="{!! old('image_id', $unit->image_id) !!}" />
                                    <div id="image-output" class="category-image">
                                        <img src="/assets/images/{!! old('href', $unit->image->href) !!}" />
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
                        <h4>Схемы</h4>
                    </div>
                    <div class="panel-body">
                        @if($errors->has('schemes'))
                            <p class="warning" role="alert">{!! $errors->first('schemes',':message') !!}</p>
                        @endif
                        <div class="form-group attribute-value">
                            <div class="row">
                                <div class="form-element col-sm-12">
                                    @if(old('schemes'))
                                        @foreach(old('schemes') as $id => $scheme)
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="form-element col-sm-12">
                                                        <div class="row form-group">
                                                            <div class="col-xs-10">
                                                                <input name="schemes[{{ $id }}][id]" value="{{ $scheme->id }}" type="hidden">
                                                                <input placeholder="Название" name="schemes[{{ $id }}][name]" class="form-control" value="{{ $scheme['name'] }}" type="text">
                                                            </div>
                                                            <div class="col-xs-2">
                                                                <button class="btn btn-danger" style="float:right;" onclick="$(this).parent().parent().remove();">Удалить</button>
                                                            </div>
                                                            <div class="col-sm-push-1 col-sm-10">
                                                                <input id="module-image-1" name="schemes[{{ $id }}][image_id]" value="{{ !empty($scheme['image_id']) ? $scheme['image_id'] : 1 }}" type="hidden">
                                                                <div id="module-image-output-1" class="module-image" style="width: 100%;margin-top: 15px;">
                                                                    <img src="/assets/images/{{ !empty($scheme['href']) ? $scheme['href'] : 'no_image.jpg' }}">
                                                                    <button type="button" class="btn btn-del" data-delete="1" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Удалить изображение">X</button>
                                                                    <button type="button" data-open="module-image" data-key="1" class="btn">Выбрать изображение</button>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <textarea rows="5" placeholder="Карта" name="schemes[{{ $id }}][map]" class="form-control">
                                                                    {{--{{ $scheme['map'] }}--}}
                                                                    @foreach($scheme['map'] as $area)
                                                                        <area href="#product-{{ $area['id'] }}" shape="{{ $area['shape'] }}" coords="{{ $area['coords'] }}">
                                                                    @endforeach
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <input type="hidden" value="{!! $id ? $id : 0 !!}" id="scheme-values-iterator" />
                                    @elseif($unit->schemes !== null)
                                        @foreach($unit->schemes as $id => $scheme)
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="form-element col-sm-12">
                                                        <div class="row form-group">
                                                            <div class="col-xs-10">
                                                                <input name="schemes[{{ $id }}][id]" value="{{ $scheme->id }}" type="hidden">
                                                                <input placeholder="Название" name="schemes[{{ $id }}][name]" class="form-control" value="{{ $scheme->name }}" type="text">
                                                            </div>
                                                            <div class="col-xs-2">
                                                                <button class="btn btn-danger" style="float:right;" onclick="$(this).parent().parent().remove();">Удалить</button>
                                                            </div>
                                                            <div class="col-sm-push-1 col-sm-10">
                                                                <input id="module-image-{{ $id }}" name="schemes[{{ $id }}][image_id]" value="{{ !empty($scheme->image_id) ? $scheme->image_id : 1 }}" type="hidden">
                                                                <div id="module-image-output-{{ $id }}" class="module-image" style="width: 100%;margin-top: 15px;position: relative">
                                                                    <div class="map_cont">
                                                                        <img src="/assets/images/{{ $scheme->image->href }}">
                                                                        <button type="button" class="btn btn-del" data-delete="{{ $id }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Удалить изображение">X</button>
                                                                        <button type="button" data-open="module-image" data-key="{{ $id }}" class="btn">Выбрать изображение</button>
                                                                        <div class="scheme-settings" style="display: none">
                                                                            <label for="area_id_{{ $id }}">ID Выбранной запчасти: </label>
                                                                            <input type="text" id="area_id_{{ $id }}">
                                                                            <label for="areas_form_{{ $id }}">Форма областей</label>
                                                                            <select id="areas_form_{{ $id }}" name="schemes[{{ $id }}][form]">
                                                                                <option value=""{{ empty($scheme->form) ? ' selected' : ''}}>Не изменять</option>
                                                                                <option value="round"{{ $scheme->form == 'round' ? ' selected' : ''}}>Круглая</option>
                                                                                <option value="rect"{{ $scheme->form == 'rect' ? ' selected' : ''}}>Прямоугольная</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <textarea rows="5" placeholder="Карта" name="schemes[{{ $id }}][map]" class="form-control" id="areas-data-{{ $id }}">
@foreach($scheme['map'] as $area)
<area href="#product-{{ $area['id'] }}" shape="{{ $area['shape'] }}" coords="{{ $area['coords'] }}">
@endforeach
                                                                </textarea>
                                                                <button type="button" data-key="{{ $id }}" class="scheme-areas btn" style="margin-top: 10px;">Настроить области</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <input type="hidden" value="0" id="attribute-values-iterator" />
                                    @else
                                        <input type="hidden" value="0" id="scheme-values-iterator" />
                                    @endif
                                </div>
                                <div class="col-sm-12 text-right">
                                    <button type="button" class="btn" id="button-add-scheme">Добавить</button>
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
                                    <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title', $unit->meta_title)  !!}" />
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
                                    <textarea name="meta_description" class="form-control" rows="6">{!! old('meta_description', $unit->meta_description) !!}</textarea>
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
                                    <textarea name="meta_keywords" class="form-control" rows="6">{!! old('meta_keywords', $unit->meta_keywords) !!}</textarea>
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
                                    <input type="text" data-translit="output" class="form-control" name="url_alias" value="{!! old('url_alias', $unit->url_alias) !!}" />
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
                                    <input type="text" class="form-control" name="sort_order" value="{!! old('sort_order', $unit->sort_order) !!}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Статус</label>
                                <div class="form-element col-sm-10">
                                    <select name="status" class="form-control">
                                        @if(old('status') || $unit->status)
                                            <option value="1" selected>Включено</option>
                                            <option value="0">Отключено</option>
                                        @elseif(!old('status') || !$unit->status)
                                            <option value="1">Включено</option>
                                            <option value="0" selected>Отключено</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 col-sm-push-2 text-left">
                                <button type="submit" class="btn">Сохранить</button>
                                <a href="/admin/categories" class="btn btn-primary">Назад</a>
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
