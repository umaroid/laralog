<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>LaraLog</title>
        @yield('styles')
        <link rel="stylesheet" href="/css/styles.css">
    </head>
    <body>
        @include('nav')
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
        @yield('scripts')
    </body>
</html>