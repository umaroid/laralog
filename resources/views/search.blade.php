{{ Form::open(['method' => 'get']) }}
    {{ csrf_field() }}
    <div class="form-group">
        {{ Form::text('keyword', null, ['class' => 'form-control', 'placeholder'=>'課題名で検索']) }} 
    </div>
    <div class="form-group">
        {{ Form::submit('検索', ['class' => 'btn btn-primary']) }}
    </div>
{{ Form::close() }}