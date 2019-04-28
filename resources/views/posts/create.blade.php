@extends('layout')

@section('content')
    <h1>新規作成</h1>
     @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $message)
                <p>{{ $message }}</p>
            @endforeach
        </div>
    @endif
    <form action="{{ route('posts.create', ['id' => $folder_id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
        </div>
        <div class="form-group">
            <label for="body">本文</label>
            <textarea id="body" name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : ' ' }}" rows="30">{{ old('body') }}</textarea>
            <p></p>
            <button type="submit" class="btn btn-primary">登録</button>
        </div>
    </form>
@endsection