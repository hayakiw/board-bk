@extends('layout.app')

@section('content')

{!! Form::open(['url' => route('workspaces.groups.comments.update', $params), 'class' => 'form-horizontal', 'method' => 'put']) !!}

@include('comment._form', ['comment' => $comment])

<div>
  <div>
    <input type="submit" value="更新" class="btn btn-success">
  </div>
</div>

{!! Form::close() !!}

@endsection
