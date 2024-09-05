<div class="card-content collapse show">
    <div class="card-body">
    <!-- form -->
 
    <form class="form submit ajaxsubmit reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">

             <div class="form-group">
                <label for="cat_id">Video Category</label>
                <select class="form-control" name="cat_id">
                <?php 
                echo optionStatus('0','-- Select --',1);
                foreach ($vcat as $mrow) { 
                    $selected = '';
                    if (@$row->cat_id == $mrow->id) {
                        $selected = 'selected';
                    }
                    if (@$row->id!=$mrow->id) {
                        echo optionStatus($mrow->id,$mrow->name,$mrow->active,$selected);
                    }
                    
                } ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" placeholder="type title..." name="title" value="<?=@$row->title?>" >
                <label class="error text-danger"></label>
            </div>  

             <div class="form-group">
                <label for="name">Url</label>
                <input type="text" class="form-control" placeholder="type url..." name="url" value="<?=@$row->url?>" >
                <label class="error text-danger"></label>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea rows="5" class="form-control" placeholder="type description..." name="description"><?=@$row->description?></textarea>
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

