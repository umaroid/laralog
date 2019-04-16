@extends('layout')

@section('content')
<h1 style="text-align:center;">Laralog</h1>
    <div class="row">
        <div class="col col-md-4">
            <nav class="panel panel-default">
            <div class="panel-heading">カテゴリ</div>
            <div class="panel-body">
                <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
                    カテゴリを追加する
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
        <div class="col col-md-4">
            <nav class="panel panel-default">
                <div class="panel-heading">メニュー</div>
                <div class="list-group"><a href="#" class="list-group-item">Wiki</a></div>
                <div class="list-group"><a href="#" class="list-group-item">ファイル</a></div>
                <div class="list-group"><a href="#" class="list-group-item">ガントチャート</a></div>
                <div class="list-group"><a href="#" class="list-group-item">プロジェクトメンバー</a></div>
                <div class="list-group"><a href="#" class="list-group-item">設定</a></div>
                <br>
            </nav>
        </div>
        <div class="col col-md-4">
            <nav class="panel panel-default">
            <div class="panel-heading">マイアカウント</div>
            <div class="panel-body">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
            </nav>
        </div>
        
        <div class="column col-md-12">
            @include('search')
            <div class="panel panel-default">
                <div class="panel-heading">タスク</div>
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
                                    @if($task->formatted_due_date < $date)
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
        <div class="d-flex justify-content-center mb-5">
            {{ $tasks->links() }}
        </div>
    </div>
@endsection