@extends('layout.app')

@section('content')
<h1>ワークスペース</h1>

<div class="container-fluid">
  <div class="text-right">
    <a href="#TODO">メンバー管理</a>
    <a href="{{ route('workspaces.create') }}" class="btn btn-default">新規登録</a>
  </div>

</div>

<table class="table">
  <thead>
    <tr>
      <th>ワークスペース</th>
      <th>説明</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  @if ($workspaces)
    @foreach ($workspaces as $workspace)
    <tr>
      <td><a href="{{ route('workspaces.show', $workspace) }}">{{ $workspace->name }}</a></td>
      <td>{!! nl2br(e($workspace->description)) !!}</td>
      <th><a href="{{ route('workspaces.edit', $workspace->id) }}" class="btn btn-warning">編集</a></th>
    </tr>
    @endforeach
  @endif
  </tbody>
</table>

@endsection
