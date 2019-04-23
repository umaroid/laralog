<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Laralog</title>
        @yield('styles')
        <link rel="stylesheet" href="/css/styles.css">
    </head>
    <body style="background-color: #FFFFCC;">
        @include('nav')
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
        @if(Auth::check())
            <script>
                document.getElementById('logout').addEventListener('click', function(event) {
                    event.preventDefault();
                    document.getElementById('logout-form').submit();
                });
            </script>
        @endif
        @yield('scripts')
    </body>
</html>