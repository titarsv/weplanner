@include('admin.layouts.header')
@extends('admin.layouts.main')
@section('title')
    Добавление товара
@endsection
@section('content')

    <div class="content-title">
        <div class="row">
            <div class="col-sm-12">
                <h1>Добавление товара</h1>
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
                                <label class="col-sm-2 text-right">Изображение товара</label>
                                <div class="form-element col-sm-4">
                                    <input type="hidden"
                                           id="image"
                                           name="image_id"
                                           value="{!! old('image_id') ? old('image_id') : 1 !!}"
                                    />

                                    <div id="image-output" class="category-image">
                                        <img src="/assets/images/{!! old('href') ? old('href') : 'no_image.jpg' !!}" />
                                        <button type="button" class="btn btn-del" data-toggle="tooltip" data-placement="bottom" title="Удалить изображение">X</button>
                                        <button type="button" data-open="image" id="add-image" class="btn">Выбрать изображение</button>
                                    </div>
                                </div>
                                <div class="form-element col-sm-6">
                                    <label class="gallery-label">Галерея</label>
                                    <div class="row gallery-container">
                                        <div class="col-sm-3 add-gallery-image" id="add-gallery-image">
                                            <div class="add-btn" data-open="gallery"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Описание товара</label>
                                <div class="form-element col-sm-10">
                                    <textarea name="description"
                                              class="form-control"
                                              rows="6">{!! old('description') !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right control-label">Цена</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="price" value="{!! old('price') !!}" />
                                    @if($errors->has('price'))
                                        <p class="warning" role="alert">{!! $errors->first('price',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Старая цена</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="old_price" value="{!! old('old_price') !!}" />
                                    @if($errors->has('old_price'))
                                        <p class="warning" role="alert">{!! $errors->first('old_price',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right control-label">Артикул</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="articul" value="{!! old('articul') !!}" />
                                    @if($errors->has('articul'))
                                        <p class="warning" role="alert">{!! $errors->first('articul',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Каталожный номер</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="catalog_id" value="{!! old('catalog_id') !!}" />
                                    @if($errors->has('catalog_id'))
                                        <p class="warning" role="alert">{!! $errors->first('catalog_id',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right control-label">Количество на складе</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="quantity" value="{!! old('quantity') !!}" />
                                    @if($errors->has('quantity'))
                                        <p class="warning" role="alert">{!! $errors->first('quantity',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Наличие товара</label>
                                <div class="form-element col-sm-10">
                                    <select name="stock" class="form-control">
                                        @if(old('stock') !== null && !old('stock'))
                                            <option value="1">В наличии</option>
                                            <option value="0" selected>Нет в наличии</option>
                                        @else
                                            <option value="1" selected>В наличии</option>
                                            <option value="0">Нет в наличии</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Связи</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Узлы</label>
                                <div class="form-element col-sm-10">
                                    <select data-placeholder="Выберите узлы" name="units[]" id="units_select" class="form-control chosen-select" multiple="multiple">
                                        @foreach($units as $unit)
                                            <option value="{!! $unit->id !!}"
                                                    @if (in_array($unit->id, (array)old('units')))
                                                    selected
                                                    @endif
                                            >{!! $unit->meta_title !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row" id="schemes"></div>
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
                        <h4>Атрибуты товара</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="table table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="success">
                                                <td align="center">Выберите атрибут</td>
                                                <td align="center">Выберите значение атрибута</td>
                                                <td align="center">Действия</td>
                                            </tr>
                                        </thead>
                                        <tbody id="product-attributes">
                                            @if(old('product_attributes') !== null)
                                                @if(session('attributes_error'))
                                                    <tr>
                                                        <td colspan="3">
                                                            <p class="warning" role="alert">{!! session('attributes_error') !!}</p>
                                                        </td>
                                                    </tr>
                                                @endif
                                                @foreach(old('product_attributes') as $key => $attr)
                                                    <tr>
                                                        <td>
                                                            <select class="form-control" onchange="getAttributeValues($(this).val(), '{!! $key !!}')">
                                                                @foreach($attributes as $attribute)
                                                                    <option value="{!! $attribute->id !!}"
                                                                        @if ($attribute->id == $attr['id'])
                                                                            selected
                                                                        @endif
                                                                    >{!! $attribute->name !!}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td align="center" id="attribute-{!! $key !!}-values">
                                                            <input type="hidden" name="product_attributes[{!! $key !!}][id]" value="{!! $attr['id'] !!}"/>
                                                            <select class="form-control" name="product_attributes[{!! $key !!}][value]">';
                                                                @foreach($attributes as $attribute)
                                                                    @if($attribute->id == $attr['id'])
                                                                        @foreach($attribute->values as $value)
                                                                            <option value="{!! $value->id !!}"
                                                                                @if ($value->id == $attr['value'])
                                                                                    selected
                                                                                @endif
                                                                            >{!! $value->name !!}</option>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td align="center">
                                                            <button class="btn btn-danger" onclick="$(this).parent().parent().remove();">Удалить</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <input type="hidden" value="{!! $key !!}" id="attributes-iterator" />
                                            @else
                                                <input type="hidden" value="0" id="attributes-iterator" />
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="3" align="center">
                                                    <button type="button" id="add-attribute" onclick="getAttributes();" class="btn">Добавить</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Аналоги</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Перечень аналогов</label>
                                <div class="col-sm-10 text-left">
                                    <select data-placeholder="Выберите аналоги" name="analogs[]" class="form-control chosen-select" multiple="multiple">
                                        @foreach($products as $product)
                                            <option value="{!! $product->id !!}"
                                                    @if (in_array($product->id, (array)old('analogs')))
                                                    selected
                                                    @endif
                                            >{!! $product->name !!}</option>
                                        @endforeach
                                    </select>
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
                                <div class="col-sm-10 col-sm-push-2 text-left">
                                    <button type="submit" class="btn">Сохранить</button>
                                    <a href="/admin/products" class="btn btn-primary">Назад</a>
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
