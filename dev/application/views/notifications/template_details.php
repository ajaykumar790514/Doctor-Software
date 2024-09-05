<div class="form-group">
    <label for="template_id">Title</label>
    <input type="text" class="form-control" name="title" value="<?=$row->title?>">
</div>

<div class="form-group">
    <label for="template_id">Body</label>
    <textarea rows="3" name="body" class="form-control"><?=$row->body?></textarea>
</div>

<div class="form-group">
    <label for="template_id">Image</label><br>
    <img src="<?=base_url()?>public\uploads\<?=$row->image?>" class="img-fluid img-md" >
    <input type="hidden" name="image" value="<?=base_url()?>public\uploads\<?=$row->image?>">
</div>

<div class="form-actions text-right">
    <button type="submit" class="btn btn-primary btn-sm mr-1">
        <i class="ft-check"></i> Send
    </button>
</div>
