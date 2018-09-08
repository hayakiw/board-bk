@extends('layout.app')

@section('content')
<h1>{{ $workspace->name }} : メンバー管理</h1>

<div class="panel panel-default">
  <div class="panel-heading text-right">
    <a href="{{ route('account.invite_form', ['workspace' => $workspace->id]) }}">招待</a>
  </div>
  <div class="panel-body">
    <table class="table table-striped">
      <thead>
          <tr>
            <th>権限</th>
            <th>Email</th>
            <th>氏名</th>
            <th></th>
            <th>編集/削除</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($workspace->accounts as $account)
        <tr>
          <td>{{ $account->property->getRole() }}</td>
          <td>{{ $account->email }}</td>
          <td>{{ $account->getFullName() }}</td>
          <td></td>
          <td>
            <a href="#TODO:edit" class="btn btn-xs btn-warning">編集</a>
            /
            <form action="#TODO:delete" style="display:inline;">
              <input type="hidden" name="account" value="{{ $account->id }}">
              <button type="submit" class="btn btn-xs btn-danger">削除</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection
