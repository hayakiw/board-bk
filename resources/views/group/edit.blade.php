@extends('layout.app')

@section('content')
<h1>グループ - 編集</h1>

{!! Form::open(['route' => 'groups.store', 'class' => 'form-horizontal']) !!}

@include('group._form')

<div>
  <div>
    <input type="submit" value="保存">
    <a href="{{ route('groups.index') }}">戻る</a>
  </div>
</div>

{!! Form::close() !!}

@endsection
