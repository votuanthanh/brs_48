<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Book Reviewing - @yield('title')</title>
        {{ Html::style(elixir('css/app.css')) }}
        {{ Html::style('bower/bootstrapvalidator/dist/css/bootstrapValidator.min.css') }}
        @yield('style')
    </head>
    <body>
        @include('patials.header')
        <div class="wrapper">
            <div class="main">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('patials.footer')
        {{ Html::script(elixir('js/app.js')) }}
        {{ Html::script('bower/bootstrapvalidator/dist/js/bootstrapValidator.min.js') }}
        @yield('script')
    </body>
</html>
