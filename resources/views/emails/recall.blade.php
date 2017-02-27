<div class="header" style="text-align: center;">
    <img src="{!! url('/img/logo.png') !!}" alt="logo" title="ВерхАгро" width="217" height="67" />
    <p style="font-size: 20px;">Поступил заказ обратного звонка на сайте ВерхАгро!</p>
    <p style="font-size: 20px;">Имя:<b>{{ $name }}</b></p>
    <p style="font-size: 20px;">Телефон:<b>{{ $phone }}</b></p>
    @if(isset($product))
        <p>Заявка пришла по следующему товару: <a href="{{ url('/product/'.$product->url_alias) }}">{{ $product->name }} (Код товара: {{ $product->articul }})</a></p>
    @endif
    @if(isset($comment))
        <p><b>Пользователь оставил следующий комментарий:</b><br>{{ $comment }}</p>
    @endif
</div>