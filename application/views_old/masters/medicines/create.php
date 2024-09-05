<div class="card-content collapse show">
    <div class="card-body">
                                    

    <!-- form -->
    <form class="form ajaxsubmit reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">
            <div class="col-12 p-0">
                <div class="form-group col-md-6 pl-0 pr-0 pr-md-1">
                    <label for="parent_cat_id">Category</label>
                    <select class="form-control" name="parent_cat_id">
                    <?php 
                    echo optionStatus('0','-- Select --',1);
                    foreach ($categories as $crow) { 
                        $selected = '';
                        if (@$row->parent_cat_id == $crow->id) {
                            $selected = 'selected';
                        }
                        echo optionStatus($crow->id,$crow->name,$crow->active,$selected);
                        
                    } ?>
                    </select>
                </div>

                <div class="form-group col-md-6 pr-0 pl-0 pl-md-1">
                    <label for="sub_cat_id">Sub Category</label>
                    <select class="form-control" name="sub_cat_id">
                    <?php 
                    echo optionStatus('0','-- Select --',1);
                    foreach ($sub_categories as $scrow) { 
                        $selected = '';
                        if (@$row->sub_cat_id == $scrow->id) {
                            $selected = 'selected';
                        }
                        echo optionStatus($scrow->id,$scrow->name,$scrow->active,$selected);
                        
                    } ?>
                    </select>
                </div>
            </div>

            <div class="form-group ">
                <label for="name">Name</label>
                <input type="text" class="form-control" placeholder="Name" name="name" value="<?=@$row->name?>" >
            </div>               

            <div class="col-12 p-0">               

                <div class="form-group col-md-6 pl-0 pr-0 pr-md-1 ">
                    <label for="unit_type_id">Unit Type</label>
                    <select class="form-control" name="unit_type_id">
                    <?php 
                    echo optionStatus('0','-- Select --',1);
                    foreach ($unit_master as $urow) { 
                        $selected = '';
                        if (@$row->unit_type_id == $urow->id) {
                            $selected = 'selected';
                        }
                        echo optionStatus($urow->id,$urow->name,$urow->active,$selected);
                        
                    } ?>
                    </select>
                </div>

                <div class="form-group col-md-6 pr-0 pl-0 pl-md-1 ">
                    <label for="unit_value">Unit Value</label>
                    <input type="text" class="form-control" placeholder="Unit Value" name="unit_value" value="<?=@$row->unit_value?>" >
                </div>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea rows="5" class="form-control" name="description"><?=@$row->description?></textarea>
            </div>

            <div class="col-12 p-0">
                <div class="form-group col-md-6 pl-0 pr-0 pr-md-1">
                    <label for="photo">Image</label>
                    <input type="file" class="form-control" name="photo">
                    <input type="hidden" name="old_photo" value="<?=@$row->photo?>">
                </div>               

                <div class="form-group col-md-6 pr-0 pl-0 pl-md-1">
                    <label for="space">Current Image</label>
                    <?php if (@$row->photo) { ?>
                        <img class="img-md" src="<?=img_base_url()?><?=$row->photo?>">
                    <?php } ?>
                </div>
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

