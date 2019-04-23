@extends('layout')

@section('content')
<h1>Wiki</h1>
@if(count($posts) > 0)
    @foreach($posts as $post)
        <div class="well">
            <h4><a href="{{ route('posts.edit', ['id' => $current_folder_id, 'post_id' => $post->id]) }}">{{ $post->title }}</a></h4>
            <small>最終更新日時： {{ $post->created_at }}</small>
        </div>
    @endforeach
@else
    <p>Wikiを作成しましょう！</p>
@endif
    <div class="text-right">
        <a href="{{ route('posts.create', ['id' => $current_folder_id]) }}" class="btn btn-default btn-block">
            Wikiを追加する
        </a>
    </div>
    <p style="padding-top: 3em;"><a href={{ route('tasks.index', ['id' => $current_folder_id]) }} class="btn btn-outline-primary">トップに戻る</a></p>
@endsection