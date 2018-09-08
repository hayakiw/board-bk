@extends('layout.app')

@section('content')
<h1>{{ $workspace->name }} : メンバー管理</h1>

<form class="form-horizontal">
  
      
      <a href="javascript:void(0);" onclick="addrow()" class="btn btn-xs btn-primary">+</a></label>
    <table class="table">
        <tbody>
          @if (old("invites"))
          @for ($i = 0; $i < count(old("invites")); $i++)
          
          @php
              var_dump(old("invites.$i.email"));
              var_dump($errors->has("invites.$i.email"));
          @endphp
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
</form>

@endsection
