@extends('layout.app')

@section('content')
<h1>グループ - 新規登録</h1>

{!! Form::open(['url' => route('workspaces.groups.store', ['workspaces' => $workspace->id]), 'class' => 'form-horizontal']) !!}

@include('group._form')

<div class="form-group">
  <div class="col-md-offset-4 col-md-4">
    <input type="submit" value="保存" class="btn btn-success">
    <a href="{{ route('workspaces.show', ['workspaces' => $workspace->id]) }}" class="btn btn-default">戻る</a>
  </div>
</div>

{!! Form::close() !!}

@endsection
