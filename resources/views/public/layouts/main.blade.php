<!DOCTYPE html>
<html lang="en">
@include('public.layouts.header')
<body>
<div class="wrapper {{ $wrapper_class or '' }}">
    @include('public.layouts.main_menu', ['partition' => $partition])
    @yield('content')
</div>
@include('public.layouts.footer')
@include('public.layouts.footer-scripts')
</body>
</html>