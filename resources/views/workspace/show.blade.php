@extends('layout.app')

@section('content')
<h1>{{ $workspace->name }}</h1>

<div class="panel panel-default">
  <div class="panel-heading text-right">
      <a href="{{ route('workspaces.groups.create', ['workspace' => $workspace->id]) }}">グループ作成</a>
  </div>
  <div class="panel-body">
    <table class="table">
      <thead>
        <tr>
          <th>グループ</th>
          <th>説明</th>
        </tr>
      </thead>
      <tbody>
      @php
        $count = 0;
      @endphp
      @if ($workspace->groups)
        @foreach ($workspace->groups as $group)
        @php
          if ($count++ > 3) break;
        @endphp
        <tr>
          <td><a href="{{ route('workspaces.groups.show', ['workspaces' => $workspace->id, 'group' => $group]) }}">{{ $group->title }}</a></td>
          <td>{{ $group->description }}</td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>

@endsection
