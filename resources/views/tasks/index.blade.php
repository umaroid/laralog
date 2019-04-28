@extends('layout')

@section('content')
<h1 style="text-align:center;">Laralog</h1>
    <div class="row">
        <div class="col col-md-4">
            <nav class="panel panel-success">
            <div class="panel-heading">{{ Auth::user()->name }}さんの課題状況</div>
            <div class="panel-body">
                <div style="text-align:center;"><img src="{{ Auth::user()->filename }}" width="45%"></div>
                <p style="text-align: center; font-size: 20px;">タスク数： {{ $all_tasks_count }}</p>
                <table width="100%">
                    <tr>
                    <td style="text-align: center;">未処理</td>
                    <td style="text-align: center;">処理中</td>
                    <td style="text-align: center;">処理済み</td>
                    <td style="text-align: center;">完了</td>
                    </tr>
                    <tr>
                    <td style="text-align: center;" class="oval1">{{ $task_status_1 }}</td>
                    <td style="text-align: center;" class="oval2">{{ $task_status_2 }}</td>
                    <td style="text-align: center;" class="oval3">{{ $task_status_3 }}</td>
                    <td style="text-align: center;" class="oval4">{{ $task_status_4 }}</td>
                    </tr>
                </table>
            </div>
            </nav>
        </div>
        
        <div class="col col-md-4">
            <nav class="panel panel-success">
                <div class="panel-heading">メニュー</div>
                <div class="list-group"><a href="{{ route('posts.index', ['folder' => $current_folder_id]) }}" class="list-group-item">Wiki</a></div>
                <div class="list-group"><a href="{{ route('user.edit', ['folder' => $current_folder_id]) }}" class="list-group-item">ユーザー設定</a></div>
            </nav>
        </div>
        
        <div class="col col-md-4">
            <nav class="panel panel-success">
            <div class="panel-heading">フォルダ</div>
            <div class="panel-body">
                <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
                    フォルダを追加する
                </a>
            </div>
            <div class="list-group">
                @foreach($folders as $folder)
                    <a href="{{ route('tasks.index', ['id' => $folder->id]) }}" class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : ''}}">
                        {{ $folder->title }}
                    </a>
                @endforeach
            </div>
            </nav>
        </div>
        
        <div class="column col-md-12">
            @include('search')
            <div class="panel panel-success">
                <div class="panel-heading">タスク一覧</div>
                    <div class="panel-body">
                        <div class="text-right">
                            <a href="{{ route('tasks.create', ['id' => $current_folder_id]) }}" class="btn btn-default btn-block">
                                タスクを追加する
                            </a>
                        </div>
                    </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>課題名</th>
                            <th>状態</th>
                            <th>期限</th>
                            <th>更新日時</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>
                                    <a href="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}">
                                        {{ $task->title }}
                                    </a>
                                </td>
                                <td>
                                    <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
                                </td>
                                <td>
                                    {{ $task->formatted_due_date }}
                                    @if($task->formatted_due_date < $date && $task->status_label != '完了')
                                        <img src="/img/alert.png" width="24px"></img>
                                    @endif
                                </td>
                                <td>{{ $task->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center mb-5" style="text-align: center;">
            {{ $tasks->links() }}
        </div>
    </div>
@endsection