@extends('layout.app')

@section('content')
<h1>グループ - 編集</h1>

{!! Form::open(['url' => route('workspaces.groups.update', ['workspace' => $workspace->id, 'group' => $group->id]), 'class' => 'form-horizontal', 'method' => 'put']) !!}

@include('group._form')

<div>
  <div>
    <input type="submit" value="保存">
    <a href="{{ route('workspaces.groups.index', ['workspace' => $workspace->id]) }}">戻る</a>
  </div>
</div>

{!! Form::close() !!}

@endsection
