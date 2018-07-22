@extends('layout.app')

@section('content')
<h1>グループ</h1>

<table class="table">
  <thead>
    <tr>
      <th>グループ</th>
      <th>説明</th>
    </tr>
  </thead>
  <tbody>
  @if ($groups)
    @foreach ($groups as $group)
    <tr>
      <td><a href="{{ route('workspaces.groups.show', ['workspaces' => $workspace->id, 'group' => $group->id]) }}">{{ $group->title }}</a></td>
      <td>{{ $group->description }}</td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>

@endsection
