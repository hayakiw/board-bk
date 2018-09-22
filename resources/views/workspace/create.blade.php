@extends('layout.app')

@php
  $layout = [
    'js' => [
      'invite_form',
    ],
  ];
@endphp

@section('content')
<h1>ワークスペース - 新規登録</h1>

{!! Form::open(['url' => route('workspaces.store'), 'class' => 'form-horizontal']) !!}

@include('workspace._form', ['with_invite' => true])

<div class="form-group">
  <div class="col-md-offset-4 col-md-4">
    <input type="submit" value="保存" class="btn btn-success">
    <a href="{{ route('workspaces.index') }}" class="btn btn-default">戻る</a>
  </div>
</div>

{!! Form::close() !!}

@endsection
