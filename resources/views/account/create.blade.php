@extends('layout.app')

@php
    $page_title = '会員登録';
@endphp

@section('content')

    <form class="form" action="{{ route('account.store') }}" accept-charset="utf-8" method="post">
        @csrf
      <div class="w50 center">
        <h1>会員登録</h1>
      </div>
      <!-- / . -->
      <div class="panel panel-default w50 center">
        <div class="panel-body">
          <table class="deco-tb w100 m_u20">
            <tr>
              <th class="w20"><label class="control-label">メールアドレス <span class="required">*</span></label></th>
              <td @if ($errors->has('email'))class="has-error"@endif><input type="input" name="email" class="form-control w45" required value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <div class="attention">{{ $errors->first('email') }}</div>
                @endif</td>
            </tr>
          </table>
          <button type="submit" class="btn block btn-info w50 center"> 登録</button>
        </div>
        <!-- /. panel-body -->
      </div>
      <!-- / .panel.panel-default -->
    </form>

@endsection
