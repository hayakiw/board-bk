<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
  <label for="" class="control-label col-md-4">グループ名</label>
  <div class="col-md-4">
    <input type="text" name="title" value="{{ old('title') ? old('title') : $group->title }}" class="form-control">
    @if ($errors->has('title'))
      <p>{{ $errors->first('title') }}</p>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
  <label for="" class="control-label col-md-4">説明</label>
  <div class="col-md-4">
    <input type="text" name="description" value="{{ old('description') ? old('description') : $group->description }}" class="form-control">
    @if ($errors->has('description'))
      <p>{{ $errors->first('description') }}</p>
    @endif
  </div>
</div>
