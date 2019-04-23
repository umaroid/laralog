<header>
    <nav class="my-navbar">
        <a $id="logout_icon" class="my-navbar-brand" href="/home">ララログ</a>
        <div class="my-nabvar-control">
            @if(Auth::check())
                <span class="my-navbar-item">ようこそ、{{ Auth::user()->name }}さん</span>
                |
                <a id="logout" class="my-nabvar-item" href="/" >ログアウト</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a class="my-nabvar-item" href="{{ route('login') }}">ログイン</a>
                |
                <a class="my-nabvar-item" href="{{ route('register') }}">会員登録</a>
            @endif
        </div>
    </nav>
</header>