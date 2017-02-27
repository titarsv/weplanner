@foreach($products as $product)
    @include('public.layouts.product', ['product' => $product])
@endforeach