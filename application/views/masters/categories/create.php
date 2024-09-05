<div class="card-content collapse show">
    <div class="card-body">
                                    

    <!-- form -->
    <form class="form ajaxsubmit reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">

            <div class="form-group">
                <label for="is_parent">Parent Category</label>
                <select class="form-control" name="is_parent">
                <?php 
                echo optionStatus('0','-- Select --',1);
                foreach ($rows as $mrow) { 
                    $selected = '';
                    if (@$row->is_parent == $mrow->id) {
                        $selected = 'selected';
                    }
                    if (@$row->id!=$mrow->id) {
                        echo optionStatus($mrow->id,$mrow->name,$mrow->active,$selected);
                    }
                    
                } ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" placeholder="Name" name="name" value="<?=@$row->name?>" >
                <label class="error text-danger"></label>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea rows="5" class="form-control" name="description"><?=@$row->description?></textarea>
            </div>

            <div class="form-group col-6 pl-0">
                <label for="space">Thumbnail</label>
                <input type="file" class="form-control" name="thumbnail">
                <input type="hidden" name="old_image" value="<?=@$row->thumbnail?>">
                
            </div>

            <div class="form-group col-6 pr-0">
                <label for="space">Current Thumbnail</label>
                <?php if (@$row->thumbnail) { ?>
                    <img class="img-md" src="<?=img_base_url()?><?=$row->thumbnail?>">
                <?php } ?>
            </div>

        </div>

        <div class="form-actions text-right">
            <button type="reset" data-dismiss="modal" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Cancel
            </button>
            <button type="submit" class="btn btn-primary mr-1"  >
                <i class="ft-check"></i> Save
            </button>
        </div>
    </form>
    <!-- End: form -->

                                </div>
                            </div>

