@extends('layout.app')

@php
    $page_title = '会員情報登録';
@endphp

@section('content')

    <form class="form" action="{{ route('account.activate') }}" accept-charset="utf-8" method="post">
        @csrf
      <div class="w50 center">
        <h1>会員情報登録</h1>
      </div>
      <!-- / . -->
      <div class="panel panel-default w50 center">
        <div class="panel-body">
          <table class="deco-tb w100 m_u20">
            <tr>
              <th class="w20"><label class="control-label">姓 <span class="required">*</span></label></th>
              <td @if ($errors->has('last_name'))class="has-error"@endif><input type="input" name="last_name" class="form-control w45" required value="{{ old('last_name') }}">
                @if ($errors->has('last_name'))
                    <div class="attention">{{ $errors->first('last_name') }}</div>
                @endif</td>
            </tr>
            <tr>
              <th class="w20"><label class="control-label">名 <span class="required">*</span></label></th>
              <td @if ($errors->has('first_name'))class="has-error"@endif><input type="input" name="first_name" class="form-control w45" required value="{{ old('first_name') }}">
                @if ($errors->has('first_name'))
                    <div class="attention">{{ $errors->first('first_name') }}</div>
                @endif</td>
            </tr>
            <tr>
              <th class="w20"><label class="control-label">セイ <span class="required">*</span></label></th>
              <td @if ($errors->has('last_name_kana'))class="has-error"@endif><input type="input" name="last_name_kana" class="form-control w45" required value="{{ old('last_name_kana') }}">
                @if ($errors->has('last_name_kana'))
                    <div class="attention">{{ $errors->first('last_name_kana') }}</div>
                @endif</td>
            </tr>
            <tr>
              <th class="w20"><label class="control-label">メイ <span class="required">*</span></label></th>
              <td @if ($errors->has('first_name_kana'))class="has-error"@endif><input type="input" name="first_name_kana" class="form-control w45" required value="{{ old('first_name_kana') }}">
                @if ($errors->has('first_name_kana'))
                    <div class="attention">{{ $errors->first('first_name_kana') }}</div>
                @endif</td>
            </tr>
            <tr>
              <th class="w20"><label class="control-label">パスワード <span class="required">*</span></label></th>
              <td @if ($errors->has('password'))class="has-error"@endif><input type="password" name="password" class="form-control w45" required value="{{ old('password') }}">
                @if ($errors->has('password'))
                    <div class="attention">{{ $errors->first('password') }}</div>
                @endif</td>
            </tr>
            <tr>
              <th class="w20"><label class="control-label">パスワード(確認) <span class="required">*</span></label></th>
              <td @if ($errors->has('password_comfirmation'))class="has-error"@endif><input type="password" name="password_comfirmation" class="form-control w45" required value="{{ old('password_comfirmation') }}">
                @if ($errors->has('password_comfirmation'))
                    <div class="attention">{{ $errors->first('password_comfirmation') }}</div>
                @endif</td>
            </tr>
          </table>
          <input type="hidden" name="confirmation_token" value="{{ $token ? $token : '' }}">
          <button type="submit" class="btn block btn-info w50 center"> 登録</button>
        </div>
        <!-- /. panel-body -->
      </div>
      <!-- / .panel.panel-default -->
    </form>

@endsection
