@extends('layout.app')

@section('content')
<h1>グループ - 編集</h1>

{!! Form::open(['url' => route('workspaces.groups.update', ['workspace' => $workspace->id, 'group' => $group->id]), 'class' => 'form-horizontal', 'method' => 'put']) !!}

@include('group._form')

<div>
  <div>
    <input type="submit" value="保存" class="btn btn-success">
    <a href="{{ route('workspaces.show', ['workspace' => $workspace->id]) }}" class="btn btn-default">戻る</a>
  </div>
</div>

{!! Form::close() !!}

@endsection
