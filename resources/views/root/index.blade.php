@extends('layout.app')

@section('content')
<h1>root.index</h1>

@php
// var_dump($workspaces);
@endphp
  <ul>
    @if ($workspaces)
      @foreach ($workspaces as $workspace)
        <li>{{ $workspace->name }} : {{ $workspace->description }}</li>
      @endforeach
    @endif
  </ul>

@endsection
