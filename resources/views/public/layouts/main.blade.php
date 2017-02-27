<!DOCTYPE html>
<html>
@include('public.layouts.header')

<body class="account-body{{ Request::path()=='/' ? ' home' : '' }}">
    @include('public.layouts.header-main')
    @include('public.layouts.nav')

    @yield('breadcrumbs')
    @yield('content')
    @include('public.layouts.footer')
</main>
@include('public.layouts.footer-scripts')
</body>
</html>