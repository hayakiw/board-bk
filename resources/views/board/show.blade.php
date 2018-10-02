@extends('layout.app')

@section('content')
<h1>{{ $board->title }}</h1>


<div class="panel panel-default">
  <div class="panel-body">

    @if ($comments)
      @foreach ($comments as $comment)
    <div class="row">
      <div class="col-md-4">{{ $comment->account->getFullName() }}</div>
      <div class="col-md-4 col-md-offset-4 text-right">{{ $comment->created_at }} edit trash</div>
      
      <div class="col-md-12">{{ $comment->comment }}</div>
    </div><hr>
      @endforeach
    @endif

    <div>
      <div>

        {!! Form::open(['url' => route('workspaces.groups.comments.store', ['workspace' => $workspace->id, 'group' => $group->id, 'type' => 'board', 'id' => $board->id]), 'class' => 'form-horizontal']) !!}

        @include('comment._form', ['comment' => new \App\Models\Comment()])

        <div class="form-group">
          <div class="col-md-12 text-right">
            <input type="hidden" name="commentable_type" value="boards">
            <input type="submit" value="登録" class="btn btn-success">
          </div>
        </div>

        {!! Form::close() !!}
      </div>
    </div>

  </div>
</div>

@endsection
