@include('admin.layouts.header')
@extends('admin.layouts.main')
@section('title')
    Редактирование атрибута
@endsection
@section('content')


    <div class="content-title">
        <div class="row">
            <div class="col-sm-12">
                <h1>Редактирование атрибута</h1>
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
                                    <input type="text" data-translit="input" class="form-control" name="name" value="{!! old('name', $attribute->name) !!}" />
                                    @if($errors->has('name'))
                                        <p class="warning" role="alert">{!! $errors->first('name',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($errors->has('values'))
                            <p class="warning" role="alert">{!! $errors->first('values',':message') !!}</p>
                        @endif

                        <div class="form-group attribute-value">
                            <div class="row">
                                <label class="col-sm-2 text-right">Значения</label>
                                <div class="form-element col-sm-10">

                                    @if(old('values'))
                                        @foreach(old('values') as $id => $value)
                                            @if($id == 'new')
                                                @foreach($value as $new_id => $new_attribute)
                                                    <div class="row form-group">
                                                        <div class="col-xs-11 attribute-name">
                                                            <input type="text"
                                                                   name="values[new][{!! $new_id !!}][name]"
                                                                   class="form-control"
                                                                   value="{!! $new_attribute['name'] !!}"
                                                            />

                                                            @if($errors->has('values.new.' . $new_id . '.name'))
                                                                <p class="warning" role="alert">{!! $errors->first('values.new.' . $new_id . '.name',':message') !!}</p>
                                                            @endif
                                                        </div>

                                                        <div class="col-xs-1 text-center">
                                                            <button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove();">
                                                                <i class="glyphicon glyphicon-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                @endforeach
                                            @else
                                            <div class="row form-group">
                                                <div class="col-xs-11 attribute-name">
                                                    <input type="text"
                                                           name="values[{!! $id !!}][name]"
                                                           class="form-control"
                                                           value="{!! $value['name'] !!}"
                                                    />

                                                    @if($errors->has('values.' . $id . '.name'))
                                                        <p class="warning" role="alert">{!! $errors->first('values.' . $id . '.name',':message') !!}</p>
                                                    @endif
                                                </div>
                                                <div class="col-xs-1 text-center">
                                                    <button type="button" class="btn btn-danger" onclick="deleteAttribute({!! $id !!}); $(this).parent().parent().remove();">
                                                        <i class="glyphicon glyphicon-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @endif

                                        @endforeach
                                            <input type="hidden" value="{!! isset($new_id) ? $new_id : 0 !!}" id="attribute-values-iterator" />

                                    @elseif($attribute->values !== null)
                                        @foreach($attribute->values as $key => $value)
                                            <div class="row form-group">
                                                <div class="col-xs-11 attribute-name">
                                                    <input type="text" name="values[{!! $value->id !!}][name]" class="form-control" value="{!! $value->name !!}" />
                                                </div>
                                                <div class="col-xs-1 text-center">
                                                    <button type="button" class="btn btn-danger" onclick="deleteAttribute({!! $value->id !!}); $(this).parent().parent().remove();"><i class="glyphicon glyphicon-trash"></i></button>
                                                </div>
                                            </div>
                                        @endforeach
                                            <input type="hidden" value="0" id="attribute-values-iterator" />
                                    @else
                                        <input type="hidden" value="0" id="attribute-values-iterator" />
                                    @endif
                                </div>
                                <div class="col-sm-12 text-right">
                                    <button type="button" class="btn" id="button-add-attribute">Добавить</button>
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
                        <div class="row">
                            <div class="col-sm-10 col-sm-push-2 text-left">
                                <button type="submit" class="btn">Сохранить</button>
                                <a href="/admin/attributes" class="btn btn-primary">Назад</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
