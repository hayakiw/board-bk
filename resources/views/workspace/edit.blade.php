@extends('layout.app')

@section('content')
<h1>ワークスペース - 編集</h1>

{!! Form::open(['url' => route('workspaces.update', $workspace), 'class' => 'form-horizontal', 'method' => 'PUT']) !!}

@include('workspace._form')

<div class="form-group">
  <div class="col-md-offset-4 col-md-4">
    <input type="submit" value="保存" class="btn btn-success">
    <a href="{{ route('workspaces.index') }}" class="btn btn-default">戻る</a>
  </div>
</div>

{!! Form::close() !!}

@endsection
