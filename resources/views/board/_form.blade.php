<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
  <label for="" class="control-label col-md-4">タイトル</label>
  <div class="col-md-4">
    <input type="text" name="title" value="{{ old('title') ? old('title') : $board->title }}" class="form-control">
    @if ($errors->has('title'))
      <p>{{ $errors->first('title') }}</p>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
  <label for="" class="control-label col-md-4">説明</label>
  <div class="col-md-4">
    <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ old('description') ? old('description') : $board->description }}</textarea>
    @if ($errors->has('description'))
      <p>{{ $errors->first('description') }}</p>
    @endif
  </div>
</div>
