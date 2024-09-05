<div class="card-content collapse show">
    <div class="card-body">
                                    

    <!-- form -->
    <form class="form ajaxsubmit reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">
            <div class="col-12 p-0">
                <div class="form-group col-md-6 pl-0 pr-0 pr-md-1">
                    <label for="parent_cat_id">Category</label>
                    <select class="form-control" name="parent_cat_id" <?=(@$row) ? 'readonly':''?> >
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
                    <select class="form-control" name="sub_cat_id" <?=(@$row) ? 'readonly':''?>>
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

            <div class="form-group">
                <label for="product_id">Medicine</label>
                <select class="form-control" name="product_id" <?=(@$row) ? 'readonly':''?>>
                <?php 
                echo optionStatus('0','-- Select --',1);
                foreach ($products as $prow) { 
                    $selected = '';
                    if (@$row->product_id == $prow->id) {
                        $selected = 'selected';
                    }
                    echo optionStatus($prow->id,$prow->name,$prow->active,$selected);
                    
                } ?>
                </select>
            </div>

            <div class="form-group current-qty text-center d-none">
                Current Total Quantity - <span></span>
            </div>

            <div class="form-group ">
                <label for="qty">Quantity</label>
                <input type="number" class="form-control" placeholder="Quantity" name="qty" value="<?=@$row->qty?>" >
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
<?php if(@$row->product_id): ?>
<script type="text/javascript">
    setTimeout(function() {
        $('select[name=product_id]').change();
    }, 500);
    
</script>
<?php endif; ?>
