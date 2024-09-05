<div class="card-content collapse show">
    <div class="card-body">
                                    

    <!-- form -->
    <form class="form ajaxsubmit reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">
            <div class="col-12 p-0">
                <div class="form-group col-md-8 pl-0 pr-0 pr-md-1">
                    <label for="name">Branch Name</label>
                    <input type="text" class="form-control" placeholder="Branch Name" name="name" value="<?=@$row->name?>" >
                </div>               

                <div class="form-group col-md-4 pr-0 pl-0 pl-md-1">
                    <label for="name">Branch Code</label>
                    <input type="text" class="form-control" placeholder="Branch Code" name="code" value="<?=@$row->code?>" >
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

            <div class="form-group">
                
            </div>

            <div class="col-12 p-0">
                <div class="form-group col-md-6 pl-0 pr-0 pr-md-1">
                    <label for="landmark">Landmark</label>
                    <input type="number" name="landmark" class="form-control" placeholder="Landmark" value="<?=@$row->landmark?>">
                </div>               

                <div class="form-group col-md-6 pr-0 pl-0 pl-md-1">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?=@$row->email?>">
                </div>
            </div>

            <div class="col-12 p-0">
                <div class="form-group col-md-6 pl-0 pr-0 pr-md-1">
                    <label for="contact">Contact</label>
                    <input type="number" class="form-control" placeholder="Contact" name="contact" value="<?=@$row->contact?>" >
                </div>               

                <div class="form-group col-md-6 pr-0 pl-0 pl-md-1">
                    <label for="alternet_contact">Alternet Contact</label>
                    <input type="text" class="form-control" placeholder="Alternet Contact" name="alternet_contact" value="<?=@$row->alternet_contact?>" >
                </div>
            </div>

            <div class="col-12 p-0">
                <div class="form-group col-md-6 pl-0 pr-0 pr-md-1">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?=@$row->username?>">
                </div>               

                <div class="form-group col-md-6 pr-0 pl-0 pl-md-1">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" value="<?=@$row->password?>">
                </div>
            </div>

            <div class="col-12 p-0">
                <div class="form-group col-md-6 pl-0 pr-0 pr-md-1">
                    <label for="banner">Banner</label>
                    <input type="file" class="form-control" name="banner">
                    <input type="hidden" name="old_banner" value="<?=@$row->banner?>">
                </div>               

                <div class="form-group col-md-6 pr-0 pl-0 pl-md-1">
                    <label for="space">Current Banner</label>
                    <?php if (@$row->banner) { ?>
                        <img class="img-md" src="<?=img_base_url()?><?=$row->banner?>">
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

