{{ Form::open(['method' => 'get']) }}
    {{ csrf_field() }}
    <div class="form-group">
        {{ Form::text('keyword', null, ['class' => 'form-control']) }} 
    </div>
    <div class="form-group">
        {{ Form::submit('検索', ['class' => 'btn btn-outline-primary']) }}
        <a href={{ route('tasks.index', ['id' => $task->folder_id, 'task_id' => $task->id]) }} class="btn btn-outline-primary">一覧に戻る</a>
    </div>
{{ Form::close() }}