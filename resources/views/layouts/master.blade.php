<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body>
        <main id="app">
            @include('partials.sidebar')
            <div class="main">                
                <app></app>
            </div>
        </main>
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>