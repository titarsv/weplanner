@include('admin.layouts.header')
@extends('admin.layouts.main')
@section('title')
    Редактирование пользователя
@endsection
@section('content')

    <div class="content-title">
        <div class="row">
            <div class="col-sm-12">
                <h1>Редактирование пользователя</h1>
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
                                <label class="col-sm-2 control-label text-right">Имя</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="first_name" value="{!! old('first_name') ? old('first_name') : $user->first_name !!}" />
                                    @if($errors->has('first_name'))
                                        <p class="warning" role="alert">{!! $errors->first('first_name',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Фамилия</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="last_name" value="{!! old('last_name') ? old('last_name') : $user->last_name !!}" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 control-label text-right">Почта</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="email" value="{!! old('email') ? old('email') : $user->email !!}" />
                                    @if($errors->has('email'))
                                        <p class="warning" role="alert">{!! $errors->first('email',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 control-label text-right">Телефон</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="phone" value="{!! old('phone') ? old('phone') : $user->phone !!}" />
                                    @if($errors->has('phone'))
                                        <p class="warning" role="alert">{!! $errors->first('phone',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Адрес</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="address" value="{!! old('address') ? old('address') : $user_data->address !!}" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Компания</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="company" value="{!! old('company') ? old('company') : $user_data->company !!}" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-10 col-sm-push-2 text-left">
                                    <input type="hidden" name="user_id" value="{!! $user->id !!}">
                                    <button type="submit" class="btn">Сохранить</button>
                                    <a href="/admin/users" class="btn btn-primary">Назад</a>
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
