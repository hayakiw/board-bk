
<div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
  <div class="col-md-12">
    <textarea name="comment" class="form-control" rows="5" style="resize: vertical">{{ old('comment') ? old('comment') : $comment->comment }}</textarea>
    @if ($errors->has('comment'))
      <p>{{ $errors->first('comment') }}</p>
    @endif
  </div>
</div>
