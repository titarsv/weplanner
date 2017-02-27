@include('admin.layouts.header')
@extends('admin.layouts.main')
@section('title')
    Инфрмация о пользователе {!! $user->email !!}
@endsection
@section('content')

    <div class="content-title">
        <div class="row">
            <div class="col-sm-12">
                <h1>Список желаний</h1>
            </div>
        </div>
        @if(isset($user))
            <div class="row">
                <div class="col-sm-8"><h4>Список закладок пользователя {!! $user->email !!}</h4></div>
                <div class="col-sm-4 text-right"><a href="/admin/users" class="btn btn-info">Назад</a></div>
            </div>
        @endif
    </div>

    <div class="panel-group">
        <div class="panel panel-default">
            <div class="table table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr class="success">
                        <td align="center">Товар</td>
                        <td align="center">Категория товара</td>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($wishlist as $product)
                        <tr>
                            <td align="center">{{ $product->name }}</td>
                            <td align="center">{!! $product->category->name !!}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="colspan">У пользователя нет товаров в списке избранных!</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
