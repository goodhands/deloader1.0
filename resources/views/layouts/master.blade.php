<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body>
        <main id="app">
            @include('partials.sidebar')
            <div class="main">                
                <div class="menu">
                    <button class="btn btn-transparent">
                        <span class="caret-line top"></span>
                        <span class="caret-line bottom"></span>
                    </button>
                </div>
                {{-- insert page here --}}
                <router-view></router-view>

                @include('partials.subscribe')
                @include('partials.footer')
            </div>
        </main>
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>