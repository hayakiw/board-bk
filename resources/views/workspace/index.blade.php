@extends('layout.app')

@section('content')
<h1>ワークスペース</h1>

<table class="table">
  <thead>
    <tr>
      <th>ワークスペース</th>
      <th>説明</th>
    </tr>
  </thead>
  <tbody>
  @if ($workspaces)
    @foreach ($workspaces as $workspace)
    <tr>
      <td><a href="{{ route('workspaces.show', $workspace) }}">{{ $workspace->name }}</a></td>
      <td>{{ $workspace->description }}</td>
    </tr>
    @endforeach
  @endif
  </tbody>
</table>

@endsection
