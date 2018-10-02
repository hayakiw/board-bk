@extends('layout.app')

@section('content')
<h1>{{ $group->title }} - 掲示板一覧</h1>

<table class="table table-hover">
  <thead>
    <tr>
      <th>タイトル</th>
      <th>説明</th>
      <th>最新の投稿</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @if ($boards)
      @foreach ($boards as $board)
    <tr>
      <th>{{ $board->title }}</th>
      <td>{{ $board->description }}</td>
      <td>{{ $board->new() }}</td>
      <td><a href="{{ route('workspaces.groups.boards.show', ['workspace' => $workspace->id, 'group' => $group->id, 'board' => $board->id]) }}">表示</a></td>
    </tr>
      @endforeach
    @endif
  </tbody>
</table>

@endsection
