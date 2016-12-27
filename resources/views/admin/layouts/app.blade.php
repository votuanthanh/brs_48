<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Book Reviewing Admin - @yield('title')</title>
        {{ Html::style(elixir('css/app.css')) }}
        {{ Html::style('css/customize.css')}}
        {{ Html::style('bower/raty/lib/jquery.raty.css') }}
    </head>
<body>

    @include('admin.patials.nav')

    <div class="container-fluid main-container">
        @include('admin.patials.sidebar')
        <div class="col-md-10 content">
            <div class="inner-content">
                @yield('content')
            </div>
            <!--END: Inner content -->
        </div>
    </div>
    <!--END: Main -->

    @include('admin.patials.footer')
    {{ Html::script(elixir('js/app.js')) }}
    {{ Html::script('bower/raty/lib/jquery.raty.js') }}
</body>
</html>
