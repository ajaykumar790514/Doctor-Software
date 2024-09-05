<div class="card-content collapse show">
    <div class="card-body">
                                    

    <!-- form -->
    <form class="form ajaxsubmit reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">
           
            <div class="form-group">
                <label for="parent_cat_id">Transfer To</label>
                <select class="form-control" name="clinic_id" required>
                <?php 
                echo optionStatus('','-- Select --',1);
                foreach ($clinics as $crow) { 
                    $cname = $crow->name.' ('.$crow->code.')';
                    echo optionStatus($crow->id,$cname,$crow->active);
                    
                } ?>
                </select>
            </div>

            <div class="form-group ">
                <label for="qty">Quantity <small>(MAX - <?=$inventory->qty?>)</small></label>
                <input type="number" class="form-control" placeholder="Quantity" name="qty" value="" max="<?=$inventory->qty?>" min="1" required >
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

