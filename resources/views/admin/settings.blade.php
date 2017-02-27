@include('admin.layouts.header')
@extends('admin.layouts.main')
@section('title')
    Настройки магазина
@endsection
@section('content')

    <div class="content-title">
        <div class="row">
            <div class="col-sm-12">
                <h1>Настройки магазина</h1>
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
                        <h4>Мета-теги</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right control-label">Мета-тег Title</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title', $settings->meta_title) !!}" />
                                    @if($errors->has('meta_title'))
                                        <p class="warning" role="alert">{!! $errors->first('meta_title',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Мета-тег Description</label>
                                <div class="form-element col-sm-10">
                                    <textarea name="meta_description" class="form-control" rows="6">{!! old('meta_description', $settings->meta_description) !!}</textarea>
                                    @if($errors->has('meta_description'))
                                        <p class="warning" role="alert">{!! $errors->first('meta_description',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Мета-тег Keywords</label>
                                <div class="form-element col-sm-10">
                                    <textarea name="meta_keywords" class="form-control" rows="6">{!! old('meta_keywords', $settings->meta_keywords) !!}</textarea>
                                    @if($errors->has('meta_description'))
                                        <p class="warning" role="alert">{!! $errors->first('meta_description',':message') !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Текст на главной странице</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Содержание</label>
                                <div class="form-element col-sm-10">
                                    <textarea id="text-area" name="about" class="form-control" rows="6">{!! old('about', $settings->about) !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Пользовательское соглашение</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Содержание</label>
                                <div class="form-element col-sm-10">
                                    <textarea id="text-area-terms" name="terms" class="form-control" rows="6">{!! old('terms', $settings->terms) !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Социальные сети</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Facebook</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="socials[facebook]" value="{!! old('socials.facebook', $settings->socials->facebook) !!}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Вконтакте</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="socials[vkontakte]" value="{!! old('socials.vkontakte', $settings->socials->vkontakte) !!}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-right">Instagram</label>
                                <div class="form-element col-sm-10">
                                    <input type="text" class="form-control" name="socials[instagram]" value="{!! old('socials.instagram', $settings->socials->instagram) !!}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Филиалы</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group phones">
                            <div class="row">
                                <label class="col-sm-2 text-right">Филиал</label>
                                <div class="form-element col-sm-10">
                                    @if(old('phones'))
                                        @foreach(old('phones') as $key => $phone)
                                            <div class="input-group">
                                                <input type="text" name="city[]" class="form-control" placeholder="Город" value="{!! old('city.'.$key) !!}" />
                                                <input type="text" name="branch_address[]" class="form-control" placeholder="Адрес" value="{!! old('branch_address.'.$key) !!}" />
                                                <input type="text" name="phones[]" class="form-control" placeholder="Телефоны (через запятую)" value="{!! $phone !!}" />
                                                <span class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="Удалить" onclick="$(this).parent().remove();">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </span>
                                            </div>
                                            @if($errors->has('phones.' . $key))
                                                <p class="warning" role="alert">{!! $errors->first('phones.' . $key,':message') !!}</p>
                                            @endif
                                        @endforeach
                                    @elseif($settings->branches !== null)
                                        @foreach($settings->branches as $branch)
                                            <div class="input-group">
                                                <input type="text" name="city[]" class="form-control" placeholder="Город" value="{!! $branch->city !!}" />
                                                <input type="text" name="branch_address[]" class="form-control" placeholder="Адрес" value="{!! $branch->address !!}" />
                                                <input type="text" name="phones[]" class="form-control" placeholder="Телефоны (через запятую)" value="{!! implode(',', $branch->phones) !!}" />
                                                <span class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="Удалить" onclick="$(this).parent().remove();">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </span>
                                            </div>
                                        @endforeach
                                    @endif
                                    <button type="button" class="btn" id="button-add-branch">Добавить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Почта, с которой будут отправляться рассылки</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group emails">
                            <div class="row">
                                <label class="col-sm-2 text-right">E-mail</label>
                                <div class="form-element col-sm-10">
                                    @if(old('site_email'))
                                        <div class="input-group">
                                            <input type="text" name="site_email" class="form-control" value="{!! old('site_email') !!}" />
                                        </div>
                                        @if($errors->has('site_email.' . $key))
                                            <p class="warning" role="alert">{!! $errors->first('site_email.' . $key,':message') !!}</p>
                                        @endif
                                    @else
                                        <div class="input-group">
                                            <input type="text" name="site_email" class="form-control" value="{!! !empty($settings->site_email) ? $settings->site_email : '' !!}" />
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Почта, на которую будут приходить заказы и заявки</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group emails">
                            <div class="row">
                                <label class="col-sm-2 text-right">E-mail</label>
                                <div class="form-element col-sm-10">
                                    @if(old('notify_emails'))
                                        @foreach(old('notify_emails') as $key => $email)
                                            <div class="input-group">
                                                <input type="text" name="notify_emails[]" class="form-control" value="{!! $email !!}" />
                                                <span class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="Удалить" onclick="$(this).parent().remove();">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </span>
                                            </div>
                                            @if($errors->has('notify_emails.' . $key))
                                                <p class="warning" role="alert">{!! $errors->first('notify_emails.' . $key,':message') !!}</p>
                                            @endif
                                        @endforeach
                                    @elseif($settings->notify_emails !== null)
                                        @foreach($settings->notify_emails as $email)
                                            <div class="input-group">
                                                <input type="text" name="notify_emails[]" class="form-control" value="{!! $email !!}" />
                                                <span class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="Удалить" onclick="$(this).parent().remove();">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </span>
                                            </div>
                                        @endforeach
                                    @endif
                                    <button type="button" class="btn" id="button-add-email">Добавить</button>
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
                                <label class="col-sm-2 text-right">Обновить кэш изображений</label>
                                <div class="form-element col-sm-10">
                                    <button type="button" class="btn" id="update_images_sizes">Обновить</button></h4>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-10 col-sm-push-2 text-left">
                                    <button type="submit" class="btn">Сохранить</button>
                                    <a href="/admin" class="btn btn-primary">На главную</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'text-area', {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
        });
        CKEDITOR.replace('text-area-terms', {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
        });
    </script>
@endsection
