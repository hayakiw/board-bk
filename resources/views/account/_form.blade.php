  <div class="title">認証情報</div>
  <div class="fl w49 m_r2">
    <table class="deco-tb w100 fs13">
      <tr>
        <th class="w20"><label class="control-label">ユーザーID <span class="required">*</span></label></th>
        <td @if ($errors->has('userid'))class="has-error"@endif><input type="input" name="userid" class="form-control w45" placeholder="" required value="{{ Request::old('userid', $account->userid) }}">
          @if ($errors->has('userid'))
              <div class="attention">{{ $errors->first('userid') }}</div>
          @endif</td>
      </tr>
      <tr>
        <th class="w20"><label class="control-label">パスワード @if (isset($form_type) && $form_type == 'create') <span class="required">*</span>@endif</label></th>
        <td @if ($errors->has('password'))class="has-error"@endif><input type="password" name="password" class="form-control w45" placeholder="" value="">
          @if ($errors->has('password'))
              <div class="attention">{{ $errors->first('password') }}</div>
          @endif</td>
      </tr>
    </table>
  </div>
  <!-- / .fl -->
</div>
<div class="clearfix">
  <div class="title m_o20">操作権限</div>
  <div class="fl w49 m_r2">

@php $applicationOld = Request::old('permit_application') ?: $account->permit_application @endphp
  <label class="control-label">
    <input type="checkbox" name="permit_application" value="1"@if($applicationOld) checked="checked"@endif /> 申請処理
  </label><br>

@php $loanOld = Request::old('permit_loan') ?: $account->permit_loan @endphp
  <label class="control-label">
    <input type="checkbox" name="permit_loan" value="1"@if($loanOld) checked="checked"@endif /> 貸与処理
  </label><br>

@php $refundOld = Request::old('permit_refund') ?: $account->permit_refund @endphp
  <label class="control-label">
    <input type="checkbox" name="permit_refund" value="1"@if($refundOld) checked="checked"@endif /> 返還処理
  </label><br>

@php $statisticOld = Request::old('permit_statistic') ?: $account->permit_statistic @endphp
  <label class="control-label">
    <input type="checkbox" name="permit_statistic" value="1"@if($statisticOld) checked="checked"@endif /> 統計資料等
  </label><br>

@php $masterOld = Request::old('permit_master') ?: $account->permit_master @endphp
  <label class="control-label">
    <input type="checkbox" name="permit_master" value="1"@if($masterOld) checked="checked"@endif /> マスタ管理
  </label><br>

@php $accountOld = Request::old('permit_account') ?: $account->permit_account @endphp
  <label class="control-label">
    @if (isset($form_type) && $form_type == 'edit' && $account->id == 1)
    <input type="checkbox" name="permit_account" value="1" checked="checked" disabled="disabled" />
    <input type="hidden" name="permit_account" value="1" />
    @else
    <input type="checkbox" name="permit_account" value="1"@if($accountOld) checked="checked"@endif />
    @endif
    アカウント管理
  </label>

  </div>
  <!-- / .fl -->