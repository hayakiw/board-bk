@extends('layout.app')

@section('content')
<h1>{{ $group->title }} - 掲示板一覧</h1>

{!! Form::open(['url' => route('workspaces.groups.boards.store', ['workspaces' => $workspace->id, 'group' => $group->id]), 'class' => 'form-horizontal']) !!}

@include('board._form')

<div class="form-group">
  <div class="col-md-offset-4 col-md-4">
    <input type="submit" value="保存" class="btn btn-success">
    <a href="{{ route('workspaces.groups.boards.index', ['workspaces' => $workspace->id, 'group' => $group->id]) }}" class="btn btn-default">戻る</a>
  </div>
</div>

{!! Form::close() !!}

@endsection
