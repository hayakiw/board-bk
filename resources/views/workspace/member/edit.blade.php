@extends('layout.app')

@section('content')
<h1>{{ $workspace->name }} : メンバー管理</h1>

<form class="form-horizontal">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <p class="form-static-control"></p>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">氏名</label>
    <div class="col-sm-10">
      <p class="form-static-control"></p>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">権限</label>
    <div class="col-sm-10">
      <p class="form-static-control"></p>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">更新</button>
    </div>
  </div>
</form>

@endsection
