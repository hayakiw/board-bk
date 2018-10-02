@extends('layout.app')

@section('content')
<h1>{{ $group->title }}</h1>

<div class="panel panel-default">
  <div class="panel-heading">
    掲示板
    <a href="{{ route('workspaces.groups.boards.index', ['workspace' => $workspace->id, 'group' => $group->id]) }}">すべて表示</a>
  </div>
  <div class="panel-body">
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
          @php
              $new = $board->new();
          @endphp
          <td>{{ $new->comment }} : {{ $new->updated_at }}</td>
          <td><a href="{{ route('workspaces.groups.boards.show', ['workspace' => $workspace->id, 'group' => $group->id, 'board' => $board->id]) }}">表示</a></td>
        </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>

@endsection
