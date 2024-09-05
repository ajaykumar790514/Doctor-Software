<!-- form -->
<script type="text/javascript">
$(".validate-form").validate({
  rules: {
        name:{
            required:true,
            remote: "<?=$remote_url?><?=@$row->id?>"
        }
    },
    messages : {
        name:{
            remote: "Plan Master Already Exists!"
        }
    }
});
</script>
<form class="form ajaxsubmit validate-form reload-tb" action="<?=$action_url[0]?>/<?=@$id?>" method="POST" enctype="multipart/form-data">
    <div class="form-body w-100">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" placeholder="Name" name="name" value="<?=@$row->name?>">
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="name">Actual Price</label>
            <input type="text" id="name" class="form-control" placeholder="Actual Price" name="actual_price" value="<?=@$row->actual_price?>" required>
         </div>   
  
        <div class="form-group col-md-3 col-sm-6">
            <label for="discounted_price">Discounted Price</label>
            <input type="text" class="form-control" placeholder="Discounted Price" name="discounted_price" value="<?=@$row->discounted_price?>" required>
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="duration">Duration (days)</label>
            <input type="text" class="form-control" placeholder="Duration" name="duration" value="<?=@$row->duration?>" required>
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="space">Space ( MB )</label>
            <input type="text" class="form-control" placeholder="Space" name="space" value="<?=@$row->space?>" required>
        </div>
        
        <div class="form-group col-md-3 col-sm-6">
            <label for="duration">Sequence</label>
            <input type="number" class="form-control" placeholder="Sequence" name="sequence" value="<?=@$row->sequence?>" required>
        </div>

        <!-- <div class="form-group col-md-3 col-sm-6">
            <label for="duration">Color</label>
            <input type="color" class="form-control" placeholder="Color" name="color" value="<?=@$row->color?>">
        </div> -->

        <div class="form-group col-md-3 col-sm-6">
            <label for="space">Diary Limitation</label>
            <input type="number" class="form-control" placeholder="Diary Limitation" name="diary_limitation" value="<?=@$row->diary_limitation?>" required>
        </div>

        <!-- <div class="form-group col-md-6">
            <label for="space">Plan Details Line 1</label>
            <textarea class="form-control" placeholder="Plan Details Line 1" name="plan_detail_line_1" ><?=@$row->plan_detail_line_1?></textarea>
        </div>

        <div class="form-group col-md-6">
            <label for="space">Plan Details Line 2</label>
            <textarea class="form-control" placeholder="Plan Details Line 2" name="plan_detail_line_2"><?=@$row->plan_detail_line_2?></textarea>
        </div> -->

        <div class="form-group col-md-3 col-sm-6">
            <label for="">Folders</label>
            <select class="form-control" name="is_folders" required>
                <option value="" Disabled Selected>Select</option>
                <option value="1" <?=(@$row->is_folders=='1') ? 'selected' : ''?>>Yes</option>
                <option value="0" <?=(@$row->is_folders=='0') ? 'selected' : ''?>>No</option>
            </select>            
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="">Multiple pins</label>
            <select class="form-control" name="is_multiple_pins" required>
                <option value="" Disabled Selected>Select</option>
                <option value="1" <?=(@$row->is_multiple_pins=='1') ? 'selected' : ''?>>Yes</option>
                <option value="0" <?=(@$row->is_multiple_pins=='0') ? 'selected' : ''?>>No</option>
            </select>            
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="">Encryption</label>
            <select class="form-control" name="is_encryption" required>
                <option value="" Disabled Selected>Select</option>
                <option value="1" <?=(@$row->is_encryption=='1') ? 'selected' : ''?>>Yes</option>
                <option value="0" <?=(@$row->is_encryption=='0') ? 'selected' : ''?>>No</option>
            </select>            
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="">Phone verification on death</label>
            <select class="form-control" name="is_phone_verification_death" required>
                <option value="" Disabled Selected>Select</option>
                <option value="1" <?=(@$row->is_phone_verification_death=='1') ? 'selected' : ''?>>Yes</option>
                <option value="0" <?=(@$row->is_phone_verification_death=='0') ? 'selected' : ''?>>No</option>
            </select>            
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="">File upload</label>
            <select class="form-control" name="is_file_upload" required>
                <option value="" Disabled Selected>Select</option>
                <option value="1" <?=(@$row->is_file_upload=='1') ? 'selected' : ''?>>Yes</option>
                <option value="0" <?=(@$row->is_file_upload=='0') ? 'selected' : ''?>>No</option>
            </select>            
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="">Login reminder on phone</label>
            <select class="form-control" name="is_login_reminders_phone" required>
                <option value="" Disabled Selected>Select</option>
                <option value="1" <?=(@$row->is_login_reminders_phone=='1') ? 'selected' : ''?>>Yes</option>
                <option value="0" <?=(@$row->is_login_reminders_phone=='0') ? 'selected' : ''?>>No</option>
            </select>            
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="">Login reminder on email</label>
            <select class="form-control" name="is_login_reminders_email" required>
                <option value="" Disabled Selected>Select</option>
                <option value="1" <?=(@$row->is_login_reminders_email=='1') ? 'selected' : ''?>>Yes</option>
                <option value="0" <?=(@$row->is_login_reminders_email=='0') ? 'selected' : ''?>>No</option>
            </select>            
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="">Ads</label>
            <select class="form-control" name="is_ads" required>
                <option value="" Disabled Selected>Select</option>
                <option value="1" <?=(@$row->is_ads=='1') ? 'selected' : ''?>>Yes</option>
                <option value="0" <?=(@$row->is_ads=='0') ? 'selected' : ''?>>No</option>
            </select>            
        </div>

        

        <div class="form-group col-md-3 col-sm-6">
            <label for="">Phone Verification of Diary Delivery</label>
            <select class="form-control" name="diary_delivery_verification_phone" required>
                <option value="" Disabled Selected>Select</option>
                <option value="1" <?=(@$row->diary_delivery_verification_phone=='1') ? 'selected' : ''?>>Yes</option>
                <option value="0" <?=(@$row->diary_delivery_verification_phone=='0') ? 'selected' : ''?>>No</option>
            </select>            
        </div>

        
        <div class="form-group col-md-3 col-sm-6">
            <label for="">Email Verification of Diary Delivery</label>
            <select class="form-control" name="diary_delivery_verification_email" required>
                <option value="" Disabled Selected>Select</option>
                <option value="1" <?=(@$row->diary_delivery_verification_email=='1') ? 'selected' : ''?>>Yes</option>
                <option value="0" <?=(@$row->diary_delivery_verification_email=='0') ? 'selected' : ''?>>No</option>
            </select>            
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="">Phone & Chat Support</label>
            <select class="form-control" name="is_phone_chat_support" required>
                <option value="" Disabled Selected>Select</option>
                <option value="1" <?=(@$row->is_phone_chat_support=='1') ? 'selected' : ''?>>Yes</option>
                <option value="0" <?=(@$row->is_phone_chat_support=='0') ? 'selected' : ''?>>No</option>
            </select>            
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="">No of nominees</label>
            <input type="number" name="no_of_nominees" class="form-control" value="<?=@$row->no_of_nominees?>" required >
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="">Delete data after handover (days)</label>
            <input type="number" name="delete_data_handover_days" class="form-control" value="<?=@$row->delete_data_handover_days?>" required >
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label for="">Email Support (hours)</label>
            <input type="number" name="email_support_hours" class="form-control" value="<?=@$row->email_support_hours?>" required >
        </div>
        
        <!-- <div class="col-md-3 col-sm-6"></div>
        <div class="col-md-3 col-sm-6"></div>
    </div>
    <div class="form-body w-100"> -->
        
        <div class="form-group col-md-3 col-sm-6 pl-0">
            <label for="space">Photo</label>
            <input type="file" class="form-control" name="photo">
            <input type="hidden" name="old_photo" value="<?=@$row->photo?>">
            
        </div>

        <div class="form-group col-md-3 col-sm-6 pr-0">
            <label for="space">Current Photo</label>
            <?php if (@$row->photo) { ?>
                <img class="img-md" src="<?=img_base_url()?><?=$row->photo?>">
            <?php } ?>
        </div>
        

        
    </div>

    <div class="form-actions text-right">
        <button type="reset" class="btn btn-danger btn-sm mr-1" data-dismiss="modal">
            <i class="ft-x"></i> Cancel
        </button>
        <button type="submit" class="btn btn-primary btn-sm mr-1">
            <i class="ft-check"></i> Save
        </button>
    </div>
</form>
<!-- End: form -->

