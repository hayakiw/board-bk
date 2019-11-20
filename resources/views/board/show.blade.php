@extends('layout.app')

@section('content')
<h1>{{ $board->title }}</h1>
<div class="panel panel-default">
  <div class="panel-body">
    {!! nl2br(e($board->description)) !!}
  </div>
</div>


<div class="panel panel-default">
  <div class="panel-body">

    @if ($comments)
      @foreach ($comments as $comment)
    <div class="row comment-row" id="comment-{{ $comment->seq }}">
      <div class="col-md-4">#{{ $comment->seq }} {{ $comment->account->getFullName() }}</div>
      <div class="col-md-4 col-md-offset-4 text-right">{{ $comment->created_at }} @if($comment->isAccountHas(auth('web')->user()->id)) 
        <div class="dropdown" style="display:inline-block;">
          <a class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu pull-right" role="menu">
            <li role="presentation"><a class="edit-comment" href="#" data-target-id="{{ $comment->seq }}" data-href="{{ route('workspaces.groups.comments.edit', ['workspace' => $workspace, 'group' => $group, 'board' => $board, 'type' => 'board', 'id' => $comment->id]) }}">編集</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a href="#">削除</a></li>
          </ul>
        </div>
      @endif</div>
      
      <div class="col-md-12 comment-area">{!! nl2br(e($comment->comment)) !!}</div>
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


<script>
$(function() {
  $('.edit-comment').on('click', function(){
    var targetId = 'comment-' + $(this).attr('data-target-id');
    var url = $(this).attr('data-href');
    var $target = $('#' + targetId);

    $.ajax({
      url: url,
      type: 'GET',
      dataType: 'text',
    }).done(function (response) {
      $target.find('.comment-area').hide();
      var editCommentArea = $('<div></div>').addClass('edit-comment-area');
      editCommentArea.append(response);
      $target.append(editCommentArea);
      // console.log($target);
    }).fail(function(data) {
      console.log('failed get comment');
    });
  });

  $('.comment-row').on('click', '.btn-cancel-comment', function (e) {
    e.preventDefault();
    // console.log( $(this).closest('.edit-comment-area')) ;
    var $commentArea = $(this).closest('.comment-row').find('.comment-area');
    $(this).closest('.edit-comment-area').remove();
    $commentArea.show();
  });

  $('.comment-row').on('click', '.btn-submit-comment', function (e) {
    e.preventDefault();
    var $form = $(this).closest('form');
    var url = $form.attr('action');
    var method = $form.attr('method');
    var formData = new FormData($form);

    $.ajax({
      url: url,
      type: method,
      dataType: 'text',
      data: formData
    }).done(function(response) {
      console.log(response);
    }).fail(function(data) {
      console.log('Request faild update comment.');
    });
  });
});

</script>

@endsection
