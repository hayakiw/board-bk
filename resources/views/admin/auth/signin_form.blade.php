@extends('layout.app')

@php
    $page_title = 'ログイン';
@endphp

@section('content')

    <form class="form" action="{{ route('admin.auth.signin') }}" accept-charset="utf-8" method="post">
        @csrf
      <div class="w50 center">
        <h1>ログイン</h1>
      </div>
      <!-- / . -->
      <div class="panel panel-default w50 center">
        <div class="panel-body">
          <table class="deco-tb w100 m_u20">
            <tr>
              <th class="w20"><label class="control-label">ユーザーID <span class="required">*</span></label></th>
              <td @if ($errors->has('name'))class="has-error"@endif><input type="input" name="name" class="form-control w45" required value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <div class="attention">{{ $errors->first('name') }}</div>
                @endif</td>
            </tr>
            <tr>
              <th><label class="control-label">パスワード <span class="required">*</span></label></th>
              <td @if ($errors->has('name'))class="has-error"@endif><input type="password" name="password" class="form-control w45" required value="">
                @if ($errors->has('password'))
                    <div class="attention">{{ $errors->first('password') }}</div>
                @endif</td>
            </tr>
          </table>
          <button type="submit" class="btn block btn-info w50 center"> ログイン</button>
        </div>
        <!-- /. panel-body -->
      </div>
      <!-- / .panel.panel-default -->
    </form>

@endsection
