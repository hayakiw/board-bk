
<div class="form-group">
  <label class="control-label col-md-3">ワークスペース名 <span class="required">*</span></label>
  <div class="col-md-6{{ ($errors->has('name')) ? ' has-error' : '' }}">
    <input type="text" class="form-control" name="name" placeholder="" required value="{{ old('name') ? old('name') : $workspace->name }}">
      @if ($errors->has('name'))
          <div class="attention">{{ $errors->first('name') }}</div>
      @endif
  </div>
</div>
<div class="form-group">
  <label class="control-label col-md-3">ワークスペースの説明 <span class="required">*</span></label>
  <div class="col-md-6{{ ($errors->has('description')) ? ' has-error' : '' }}">

      <textarea name="description" class="form-control" cols="30" rows="10">{{ old('description') ? old('description') : $workspace->description }}</textarea>
      @if ($errors->has('description'))
          <div class="attention">{{ $errors->first('description') }}</div>
      @endif
  </div>
</div>
@if (isset($with_invite) && $with_invite === true)
<div class="form-group">
    <label class="control-label col-md-3">ユーザーの招待 <span class=""></span>
      
      <a href="javascript:void(0);" onclick="addrow()" class="btn btn-xs btn-primary">+</a></label>
  <div class="col-md-6">
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
  </div>
</div>

<script>
function addrow() {
  var $row = $("#basic-row");
  var $table = $row.closest('table');
  var $insert = $('<tr></tr>').append($row.html());
  $insert.find('input[disabled="disabled"]').removeAttr("disabled");
  $table.append($insert);
}

function removerow(self) {
  $(self).closest('tr').remove();
}

</script>
@endif
