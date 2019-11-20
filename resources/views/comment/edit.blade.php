{{-- @extends('layout.app')

@section('content') --}}

{!! Form::open(['url' => route('workspaces.groups.comments.update', $params), 'class' => 'form-horizontal', 'method' => 'put']) !!}

@include('comment._form', ['comment' => $comment])

<div>
  <div>
    <a class="btn btn-default btn-cancel-comment" href="#">キャンセル</a>
    <input type="submit" value="更新" class="btn btn-success btn-submit-comment">
  </div>
</div>

{!! Form::close() !!}

{{-- @endsection --}}
