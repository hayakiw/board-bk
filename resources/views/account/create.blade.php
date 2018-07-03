@extends('layout.app')

@php
    $page_title = '新規作成 | アカウント';
@endphp

@section('content')
{{ Form::model($account, ['route' => 'accounts.store', 'method' => 'post', 'class' => 'form']) }}
  <h1>アカウント新規作成</h1>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="clearfix">
        @include('account._form', ['account' => $account, 'form_type' => 'create'])
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
      <button class="btn block btn-success btn-sm w59 fl" type="submit">登録</button>
    </div>
  </div>
{{ Form::close() }}
@endsection
