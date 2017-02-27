@include('admin.layouts.header')
@extends('admin.layouts.main')
@section('title')
    Каталог товаров
@endsection
@section('content')

    <div class="content-title">
        <div class="row">
            <div class="col-sm-10">
                <h1>Каталог товаров</h1>
            </div>
            <div class="col-sm-2 text-right">
                <a href="/admin/products/create" class="btn">Добавить</a>
            </div>
            @if($current_search)
                <div class="col-sm-12">
                    <h3>Результаты поиска по запросу: {!! $current_search !!}</h3>
                </div>
            @endif
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

    <form action="products" method="post" id="settings-form">
        {!! csrf_field() !!}
        <div class="settings row">
            <div class="col-sm-4">
                <div class="row">
                    <label for="sort-by" class="col-sm-5">Сортировать по:</label>
                    <div class="form-element col-sm-7">
                        <select name="sort" id="sort-by" class="form-control">

                            @foreach($array_sort as $sort => $value)
                                @if($current_sort['value'] == $sort)
                                    <option value="{!! $sort !!}" selected>{!! $value['name'] !!}</option>
                                @else
                                    <option value="{!! $sort !!}">{!! $value['name'] !!}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <label for="search" class="col-sm-2">Поиск:</label>
                    <div class="form-element col-sm-10">
                        <input type="text" id="search" name="search" placeholder="Введите текст..." class="form-control" />
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <label for="show" class="col-sm-4">Отображать:</label>
                    <div class="form-element col-sm-8">
                        <select name="show" id="show" class="form-control">
                            @foreach($array_show as $show)
                                @if($current_show == $show)
                                    <option value="{!! $show !!}" selected>{!! $show !!}</option>
                                @else
                                    <option value="{!! $show !!}">{!! $show !!}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="panel-group">
        <div class="panel panel-default">
            <div class="table table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="success">
                            <td>Артикул</td>
                            <td class="left">Название</td>
                            <td>Изображение товара</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button"
                                            id="current-cat"
                                            class="btn dropdown-toggle product-sort-button"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">
                                        <span class="dropdown-selected-name">Категория</span>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="/admin/products" class="sort-buttons">Все</a></li>
                                        @forelse($categories as $category)
                                            <li>
                                                <a type="button" data-sort="category" data-value="{!! $category->id !!}" class="sort-buttons" onclick="filterProducts($(this))">
                                                    {!! $category->name !!}
                                                </a>
                                            </li>
                                        @empty
                                            <li><a href="javascript:void()">Нет добавленных категорий!</a></li>
                                        @endforelse
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button"
                                            id="current-cat"
                                            class="btn dropdown-toggle product-sort-button"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">
                                        <span class="dropdown-selected-name">Наличие</span>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="/admin/products" class="sort-buttons">Все</a></li>
                                        <li>
                                            <a type="button" data-sort="stock" data-value="1" class="sort-buttons" onclick="filterProducts($(this))">
                                                В наличии
                                            </a>
                                        </li>
                                        <li>
                                            <a type="button" data-sort="stock" data-value="0" class="sort-buttons" onclick="filterProducts($(this))">
                                                Нет наличии
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td>Действия</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{!! $product->articul !!}</td>
                                <td class="left">{!! $product->name !!}</td>
                                <td>
                                    <img src="/assets/images/{!! $product->image->href !!}" class="img-thumbnail">
                                </td>
                                <td>{!! $product->category ? $product->category->name : '' !!}</td>
                                <td class="status">
                                    <span class="{!! $product->stock ? 'on' : 'off' !!}">
                                        <span class="runner"></span>
                                    </span>
                                </td>
                                <td class="actions">
                                    <a class="btn btn-primary" href="/admin/products/edit/{!! $product->id !!}?page={!! $products->currentPage() !!}" data-toggle="tooltip" data-placement="top" title="Редактировать">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete('products', '{!! $product->id !!}', '{{ $product->name }}')" data-toggle="tooltip" data-placement="top" title="Удалить">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="colspan">Нет товаров!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($products->links())
                <div class="panel-footer text-right">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>

    <div id="products-delete-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Подтверждение удаления</h4>
                </div>
                <div class="modal-body">
                    <p>Удалить товар <span id="products-name"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <a type="button" class="btn btn-primary" id="confirm">Удалить</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            navigateProductFilter();
        });
    </script>
@endsection
