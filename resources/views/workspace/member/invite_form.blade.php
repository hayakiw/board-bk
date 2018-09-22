@extends('layout.app')

@php
  $layout = [
    'js' => [
      'invite_form',
    ],
  ];
@endphp

@section('content')
<h1>{{ $workspace->name }} : メンバー管理</h1>

@if ($errors->has('invite'))
    <div class="attention">{{ $errors->first('invite') }}</div>
@endif

{!! Form::open([
  'route' => ['workspace.member.invite', 'workspace' => $workspace->id], 'method' => 'post'
  ], [
    'class' => 'form_horizontal',
  ]) !!}
  <table class="table">
    <tbody>
      @if (old("invites"))
      @for ($i = 0; $i < count(old("invites")); $i++)
      <tr>
        <th><label for="" class="control-label">Eメール</label></th>
        <td class="{{ $errors->has("invites.{$i}.email") ? ' has-error' : '' }}">
          <input type="email" name="invites[][email]" value="{{ old("invites.{$i}.email") }}" class="form-control">
          
          @if ($errors->has("invites.{$i}.email"))
          <div class="attention">{{ $errors->first("invites.{$i}.email") }}</div>
          @endif
        </td>
        <td>
          <a href="javascript:void(0);" class="btn btn-xs btn-danger" onclick="removerow(this)">-</a>
        </td>
      </tr>
      @endfor
      @else
      <tr id="basic-row">
        <th><label for="" class="control-label">Eメール</label></th>
        <td>
          <input type="email" name="invites[][email]" value="" class="form-control">
        </td>
        <td>
          <a href="javascript:void(0);" class="btn btn-xs btn-danger" onclick="removerow(this)">-</a>
        </td>
      </tr>
      @endif
      <tr id="basic-row" style="display:none;">
        <th><label for="" class="control-label">Eメール</label></th>
        <td>
          <input type="email" name="invites[][email]" value="" class="form-control" disabled="disabled">
        </td>
        <td>
          <a href="javascript:void(0);" class="btn btn-xs btn-danger" onclick="removerow(this)">-</a>
        </td>
      </tr>
    </tbody>
  </table>
  <a href="javascript:void(0);" onclick="addrow()" class="btn btn-default">追加</a></label>
  <button type="submit" class="btn btn-success">送信</button>
{!! Form::close() !!}

@endsection
