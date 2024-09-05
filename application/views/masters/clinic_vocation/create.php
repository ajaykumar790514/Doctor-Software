<!-- form -->
<script type="text/javascript">
$(".validate-form").validate({
  rules: {
    date:{
            required:true,
        },
        clinic_id:"required",
    },
    messages : {
        date:"Please select date",
        clinic_id:"Please select clinic",
    }
});
</script>
<form class="form ajaxsubmit validate-form reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
    <div class="form-body w-100">
        <div class="form-group col-md-6">
            <label for="date">Select Clinic</label>
            <select name="clinic_id" id="" class="form-control">
            <option value="">--Select--</option>
            <?php foreach($clinics as $clinic):?>
            <option value="<?=$clinic->id;?>"  <?php if(@$row->clinic_id==$clinic->id){echo "selected";};?> ><?=$clinic->name;?> ( <?=$clinic->code;?> )</option>
            <?php endforeach;?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="date">Select Date</label>
            <input type="date" class="form-control"  name="date" value="<?=@$row->date?>">
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

