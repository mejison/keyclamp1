<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('tenant/header.php')
<body class="bg-gray-100 h-screen antialiased">
@include('tenant/top-sidebar.php')

<div class="container-fluid">
    <div class="row">
        @include('tenant/sidebar.php')

    </div>
</div>




@stack('body')
</body>
</html>
