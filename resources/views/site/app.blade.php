<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    @include('site.partials.styles')
</head>
<body>
    <div class="page-holder">
        @include('site.partials.header')
        @yield('content')
        @include('site.partials.footer')
        @include('site.partials.scripts')
    </div>
</body>
</html>
