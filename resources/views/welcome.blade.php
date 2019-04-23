@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset-3 col-md-6">
                <h1 style="text-align: center; padding-bottom: 2em;">
                        Welcome to Laralog!
                    </h1>
                    <div style="text-align: center; margin-bottom: 3em;">
                        <h4>ララログは、あなた専用のタスク管理ツールです。</h4>
                        <br>
                        <h4>ご利用が初めての方は、まずは会員登録からどうぞ。</h4>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            ログイン
                        </a>
                        <span style="padding-right: 1.0em;"></span>
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            新規会員登録
                        </a>
                    </div>
            </div>
        </div>
    </div>
@endsection