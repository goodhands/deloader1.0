<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body>
        @include('partials.sidebar')
        <main>
            <div class="menu">
                <button class="btn btn-transparent">
                    <span class="caret-line top"></span>
                    <span class="caret-line bottom"></span>
                </button>
            </div>
            {{-- insert page here --}}

            @include('partials.subscribe')
            @include('partials.footer')
        </main>
    </body>
</html>