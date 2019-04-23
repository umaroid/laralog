@extends('layout')

@section('content')
    <h1>{{ $post->title }}</h1>
    <a href="/posts" class="btn btn-default">戻る</a>
    <div>
        {{ $post->body }}
    </div>
    <hr>
    <small>Written on {{ $post->created_at }}</small>
@endsection