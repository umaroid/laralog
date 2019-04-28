@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset-3 col-md-6">
                <nav class="panel panel-default">
                    <div class="panel-heading">ユーザー設定</div>
                    <div class="panel-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('user.edit', ['folder' => $current_folder_id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">ユーザー名</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" />
                            </div>
                            <div class="form-group">
                                <label for="name">アバタ―画像</label>
                                <input type="file" id="filename" name="filename" value="{{$user->filename}}"/>
                                <div style="text-align: center;"><img src="{{ Auth::user()->filename }}" width="35%"></div>
                            </div>
                            <div class="form-group">
                                <label for="password">パスワード</label>
                                <input type="text" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">パスワード（確認）</label>
                                <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
                            </div>
                            <div class="text-right">
                                <span style="padding-top: 3em;"><a href={{ route('tasks.index', ['id' => $current_folder_id]) }} class="btn btn-outline-primary">戻る</a></span>
                                <button type="submit" class="btn btn-primary">送信</button>
                            </div>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection