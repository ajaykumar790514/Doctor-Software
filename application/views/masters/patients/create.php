<div class="card-content collapse show">
    <div class="card-body">
                                    

    <!-- form -->
    <form class="form ajaxsubmit reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">
            <div class="form-group <?=(@$user->user_role==8) ? 'd-none':''?>">
            <!-- <div class="form-group "> -->
                <label for="clinic_id">Clinic</label>
                <select class="form-control" name="clinic_id">
                <?php 
                echo optionStatus('0','-- Select --',1);
                foreach ($clinics as $key => $value) { 
                    $selected = '';
                    if (($user->user_role==7 or $user->user_role==8) && @$value->id == $user->id) {
                        $selected = 'selected';
                    }
                    if (@$row->clinic_id == $value->id) {
                        $selected = 'selected';
                    }
                    $name = $value->name . '( '.$value->code.' )';
                    echo optionStatus($value->id,$name,$value->active,$selected);
                    
                } ?>
                </select>
            </div>
            <div class="col-12 p-0">
                <div class="form-group col-md-6 pl-0 pr-0 pr-md-1">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" value="<?=@$row->name?>" >
                </div>   

                <div class="form-group col-md-3 pl-0 pr-0 pl-md-1 pr-md-1">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender">
                    <?php 
                    $gender['']        = '-- Select --';
                    $gender['male']    = 'Male';
                    $gender['female']  = 'Female';
                    $gender['other']   = 'Other';
                    foreach ($gender as $key => $value) { 
                        $selected = '';
                        if (@$row->gender == $key) {
                            $selected = 'selected';
                        }
                        echo optionStatus($key,$value,1,$selected);
                        
                    } ?>
                    </select>
                </div>            

                <div class="form-group col-md-3 pr-0 pl-0 pl-md-1">
                    <label for="age">Age (Years)</label>
                    <input type="number" class="form-control" placeholder="Age" name="age" value="<?=@$row->age?>" >
                </div>
            </div>
            <div class="col-12 p-0">
                <div class="form-group col-md-6 pl-0 pr-0 pr-md-1">
                    <label for="mobile">Mobile No.</label>
                    <input type="number" class="form-control" placeholder="Mobile No." name="mobile" value="<?=@$row->mobile?>" >
                </div>               

                <div class="form-group col-md-6 pr-0 pl-0 pl-md-1">
                    <label for="marital_status">Marital Status</label>
                    <select class="form-control" name="marital_status">
                    <?php 
                    $ms[''] = '-- Select --';
                    $ms['1'] = 'Married';
                    $ms['2'] = 'Unmarried';
                    foreach ($ms as $key => $value) { 
                        $selected = '';
                        if (@$row->marital_status == $key) {
                            $selected = 'selected';
                        }
                        echo optionStatus($key,$value,1,$selected);
                        
                    } ?>
                    </select>
                </div>
            </div>
            <div class="col-12 p-0">
                <div class="form-group col-md-4 pl-0 pr-0 pr-md-1">
                    <label for="state">State</label>
                    <select class="form-control" name="state">
                    <?php 
                    echo optionStatus('0','-- Select --',1);
                    foreach ($states as $key => $value) { 
                        $selected = '';
                        if (@$row->state == $key) {
                            $selected = 'selected';
                        }
                        echo optionStatus($key,$value,1,$selected);
                        
                    } ?>
                    </select>
                </div>

                <div class="form-group col-md-4 pl-0 pr-0 pl-md-1 pr-md-1">
                    <label for="city">City</label>
                    <select class="form-control" name="city">
                    <?php 
                    echo optionStatus('0','-- Select --',1);
                    foreach ($cities as $key => $value) { 
                        $selected = '';
                        if (@$row->city == $key) {
                            $selected = 'selected';
                        }
                        echo optionStatus($key,$value,1,$selected);
                        
                    } ?>
                    </select>
                </div>

                <div class="form-group col-md-4 pr-0 pl-0 pl-md-1">
                    <label for="pincode">Pincode</label>
                    <input type="number" name="pincode" class="form-control" placeholder="Pincode" value="<?=@$row->pincode?>">
                </div>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea rows="3" class="form-control" name="address" placeholder="Address"><?=@$row->address?></textarea>
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

