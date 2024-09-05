<div class="card-content collapse show">
    <div class="card-body">
                                    

    <!-- form -->
    <form class="form ajaxsubmit reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">
            
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" placeholder="Name" name="name" value="<?=(@$row->name) ? $row->name : '' ?>" >
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" placeholder="Email" name="email" value="<?=(@$row->email) ? $row->email : '' ?>" >            
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" placeholder="Username" name="username" value="<?=(@$row->username) ? $row->username : '' ?>" >            
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" placeholder="Password" name="password" value="<?=(@$row->password) ? $row->password : '' ?>" >            
            </div>

            <div class="form-group">
                <label for="work">User Role</label>
                <select class="form-control" name="user_role">
                <?php 
                echo optionStatus('','-- Select --',1);
                foreach ($user_role as $urrow) { 
                    $selected = '';
                    if ($urrow->id!=4 && $urrow->id!=5 && $urrow->id!=6  && $urrow->id!=2) {
                        if (@$row->user_role == $urrow->id) {
                        $selected = 'selected';
                    }
                    echo optionStatus($urrow->id,$urrow->name,$urrow->status,$selected);
                    }
                    
                    
                } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" class="form-control" placeholder="photo" name="photo" >  
                <?php if (@$row->photo) { ?>
                    <img src="<?=$row->photo?>">
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

