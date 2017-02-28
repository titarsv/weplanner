<!DOCTYPE html>
<html lang="en">
@include('public.layouts.header')
<body>
<div class="wrapper catalog">
    @include('public.layouts.main_menu')
    @yield('content')
</div>
@include('public.layouts.footer')
@include('public.layouts.footer-scripts')
</body>
</html>