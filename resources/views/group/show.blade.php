@extends('layout.app')

@section('content')
<h1>{{ $group->title }}</h1>

<div class="panel panel-default">
  <div class="panel-heading">
    掲示板
    <a href="{{ route('workspaces.groups.boards.index', ['workspace' => $workspace->id, 'group' => $group->id]) }}">すべて表示</a>
    <div class="test-right">
      <a href="{{ route('workspaces.groups.boards.create', ['workspace' => $workspace->id, 'group' => $group->id]) }}" class="btn btn-default">新規作成</a>
    </div>
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
          <td>@if($new) {{ $new->account->getFullName() }} : {{ $new->updated_at }}<br>{{ $new->comment}} @endif</td>
          <td><a href="{{ route('workspaces.groups.boards.show', ['workspace' => $workspace->id, 'group' => $group->id, 'board' => $board->id]) }}">表示</a></td>
        </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>

@endsection
