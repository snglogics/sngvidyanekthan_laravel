<div class="mb-3">
  <label class="form-label">Title</label>
  <input type="text" name="title" value="{{ old('title',$club->title??'') }}"
         class="form-control" required>
</div>

<div class="mb-3">
  <label class="form-label">Description</label>
  <textarea name="description" class="form-control" rows="3" required>{{ old('description',$club->description??'') }}</textarea>
</div>

<div class="mb-3">
  <label class="form-label">Image</label>
  @if(!empty($club->image_url))
    <div class="mb-2">
      <img src="{{ $club->image_url }}" width="120" class="img-thumbnail">
    </div>
  @endif
 <input type="file" name="image" class="form-control">
</div>
