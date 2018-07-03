@extends('layout.app')

@section('content')

    <form class="form" accept-charset="utf-8" method="post">
      <h1>アカウント管理</h1>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="clearfix">
            <div class="fl w29 m_r2">
              <table class="deco-tb w100">
                <tr>
                  <th class="w20"><label class="control-label">ユーザーID</label></th>
                  <td class="w30"><input type="input" name="userid" class="form-control w100" placeholder="" required value="{{ $search['userid'] ?? '' }}" placeholder="例：taro"></td>
                </tr>
              </table>
            </div>
            <div class="fl w29">
              <button class="btn btn-primary btn-xs w20 vb m_o5" type="submit"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span> 検索</button>
              <a href="{{ route('accounts.create') }}?{{ http_build_query($_GET) }}" class="btn btn-default btn-xs">新規作成</a>
            </div>
          </div>
          <!-- / .clearfix -->
        </div>
        <!-- /. panel-body -->
      </div>
      <!-- / .panel.panel-default -->
    </form>

      <div class="panel panel-default">
        <div class="panel-body">
          <table class="deco-tb w100">
            <thead>
              <tr>
                <th>ID</th>
                <th>ユーザーID</th>
                <th class="w15">編集</th>
                <th class="w15">削除</th>
              </tr>
            </thead>
            <tbody>
            @foreach($accounts as $account)
              <tr>
                  <td>{{ $account->id }}</td>
                  <td>{{ $account->userid }}</td>
                  <td><a href="{{ route('accounts.edit', ['account' => $account->id ]) }}?{{ http_build_query($_GET) }}" class="btn btn-success btn-sm">編集</a></td>
                  <td>@if ($account->id != 1)
                      {{ Form::model($account, ['route' => ['accounts.destroy', 'account' => $account->id] , 'method' => 'delete', 'data-confirm' => '本当に削除しますか？']) }}
                          <input type="submit" value="削除" class="btn btn-danger btn-sm btn-destroy">
                      {{ Form::close() }}
                      @endif
                  </td>
              </tr>
            @endforeach
            </tbody>
          </table>

          <div class="text-center">
            {!! $accounts->appends($search)->links() !!}
          </div>

        </div>
        <!-- /. panel-body -->
      </div>
      <!-- / .panel.panel-default -->
@endsection
