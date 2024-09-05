<div class="card-content collapse show">
    <div class="card-body">
                                    

    <!-- form -->
    <form class="form ajaxsubmit reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">
            
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" placeholder="Title" name="title" value="<?=(@$row->title) ? $row->title : '' ?>" >
            </div>

            <div class="form-group">
                <label for="icon_class">Icon Class</label>
                <input type="text" class="form-control" placeholder="Icon Class" name="icon_class" value="<?=(@$row->icon_class) ? $row->icon_class : '' ?>" >            
            </div>

            <div class="form-group">
                <label for="work">Parent Menu</label>
                <select class="form-control" name="parent">
                <?php 
                echo optionStatus('','-- Select --',1);
                foreach ($menus as $mrow) { 
                    $selected = '';
                    if (@$row->parent == $mrow->id) {
                        $selected = 'selected';
                    }
                    if (@$row->id!=$mrow->id) {
                        echo optionStatus($mrow->id,$mrow->title,$mrow->status,$selected);
                    }
                    
                } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="url">Url</label>
                <input type="text" class="form-control" placeholder="Url" name="url" value="<?=(@$row->url) ? $row->url : '' ?>" >
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

