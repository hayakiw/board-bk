@extends('layout.app')

@php
    $page_title = '編集 | アカウント';
@endphp

@section('content')
{{ Form::model($account, ['route' => ['accounts.update', $account->id . '?' . http_build_query($_GET)] , 'method' => 'put', 'class' => 'form']) }}
  <h1>アカウント編集</h1>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="clearfix">
        <input type="hidden" name="id" value="{{ Request::old('id', $account->id) }}">
        @include('account._form', ['account' => $account, 'form_type' => 'edit'])
      </div>
      <!-- / .clearfix -->
    </div>
    <!-- /. panel-body -->
  </div>
  <!-- / .panel.panel-default -->

  <div class="clearfix">
    <div class="fl w15 clearfix">
      <label class="control-label"> </label>
      <a href="{{ route('accounts.index') }}" class="btn block btn-default btn-sm w39  m_r2 fl">戻る</a>
      <button class="btn block btn-success btn-sm w59 fl" type="submit">更新</button>
    </div>
  </div>
{!! Form::close() !!}
@endsection
