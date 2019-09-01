@extends('layout.app')

@php
    $page_title = '会員情報登録';
@endphp

@section('content')

<div class="container">
  <h1>会員情報登録</h1>
  <form class="form-horizontal" action="{{ route('account.activate') }}" method="post">
    @csrf
    <div class="form-group">
      <label class="control-label col-md-3">姓 <span class="required">*</span></label>
      <div class="col-md-6{{ ($errors->has('last_name')) ? ' has-error' : '' }}">
        <input type="text" class="form-control" name="last_name" placeholder="" required value="{{ old('last_name') }}">
          @if ($errors->has('last_name'))
              <div class="attention">{{ $errors->first('last_name') }}</div>
          @endif
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3">名 <span class="required">*</span></label>
      <div class="col-md-6{{ ($errors->has('first_name')) ? ' has-error' : '' }}">
        <input type="text" class="form-control" name="first_name" placeholder="" required value="{{ old('first_name') }}">
          @if ($errors->has('first_name'))
              <div class="attention">{{ $errors->first('first_name') }}</div>
          @endif
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3">セイ <span class="required">*</span></label>
      <div class="col-md-6{{ ($errors->has('last_name_kana')) ? ' has-error' : '' }}">
        <input type="text" class="form-control" name="last_name_kana" placeholder="" required value="{{ old('last_name_kana') }}">
          @if ($errors->has('last_name_kana'))
              <div class="attention">{{ $errors->first('last_name_kana') }}</div>
          @endif
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3">メイ <span class="required">*</span></label>
      <div class="col-md-6{{ ($errors->has('first_name_kana')) ? ' has-error' : '' }}">
        <input type="text" class="form-control" name="first_name_kana" placeholder="" required value="{{ old('first_name_kana') }}">
          @if ($errors->has('first_name_kana'))
              <div class="attention">{{ $errors->first('first_name_kana') }}</div>
          @endif
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3">パスワード <span class="required">*</span></label>
      <div class="col-md-6{{ ($errors->has('password')) ? ' has-error' : '' }}">
        <input type="password" class="form-control" name="password" placeholder="" required value="">
          @if ($errors->has('password'))
              <div class="attention">{{ $errors->first('password') }}</div>
          @endif
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3">パスワード(確認) <span class="required">*</span></label>
      <div class="col-md-6{{ ($errors->has('password_comfirmation')) ? ' has-error' : '' }}">
        <input type="password" class="form-control" name="password_comfirmation" placeholder="" required value="">
          @if ($errors->has('password_comfirmation'))
              <div class="attention">{{ $errors->first('password_comfirmation') }}</div>
          @endif
      </div>
    </div>

    @if ($wsid && ($workspace = $account->workspace($wsid)->first()) && $workspace->property->invite_at != null)
      <input type="hidden" name="workspace_id" value="{{ $workspace->id }}">
    @else
      <div class="form-group">
        <label class="control-label col-md-3">ワークスペース名 <span class="required">*</span></label>
        <div class="col-md-6{{ ($errors->has('workspace.name')) ? ' has-error' : '' }}">
          <input type="text" class="form-control" name="workspace[name]" placeholder="" required value="{{ old('workspace.name') }}">
            @if ($errors->has('workspace.name'))
                <div class="attention">{{ $errors->first('workspace.name') }}</div>
            @endif
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3">ワークスペースの説明 <span class="required">*</span></label>
        <div class="col-md-6{{ ($errors->has('workspace.description')) ? ' has-error' : '' }}">

            <textarea name="workspace[description]" class="form-control" cols="30" rows="10">{{ old('workspace.description') }}</textarea>
            @if ($errors->has('workspace.description'))
                <div class="attention">{{ $errors->first('workspace.description') }}</div>
            @endif
        </div>
      </div>
    @endif
    <div class="form-group">
      <div class="col-md-offset-3 col-md-6">
        <input type="hidden" name="confirmation_token" value="{{ $token ? $token : '' }}">
        <button type="submit" class="btn block btn-info w50 center"> 登録</button>
      </div>
    </div>
  </form>
</div>
@endsection
