<!-- form -->
<?php if($flag==1){?>
<script type="text/javascript">
    $.validator.addMethod('ckeditorNotEmpty', function(value, element) {
    return CKEDITOR.instances[element.id].getData().trim() !== '';
}, 'Please enter description');
$(".validate-form").validate({
  rules: {
        title:{
            required:true,
            remote:"<?=$remote?>"
        },
        duration:"required",
        // treatment_price:"required",
        appointment_advance:"required",
        // doc:"required",
        // video_url:"required",
        description: {
            ckeditorNotEmpty: true
        }
    },
    messages : {
        title:{
            remote: "Title already exist !"
        },
        duration:"Please enter duration in  min",
        // treatment_price:"Please enter treatment price",
        appointment_advance:"Please enter appointment advance",
        // doc:"Please select photo",
        // video_url:"Please enter video url",
        description: {
            ckeditorNotEmpty: "Please enter description"
        }
    }
});
</script>
<?php }else{?>
    <script type="text/javascript">
$(".validate-form").validate({
  rules: {
        title:{
            required:true,
        },
        duration:"required",
        // treatment_price:"required",
        appointment_advance:"required",
        // video_url:"required",
        description:"required",
    },
    messages : {
        title:"Please enter Title ",
        duration:"Please enter duration in  min",
        // treatment_price:"Please enter treatment price",
        appointment_advance:"Please enter appointment advance",
        // video_url:"Please enter video url",
        description:"Please enter description",
    }
});
</script>
<?php }?>
<div class="card-content collapse show">
    <div class="card-body">
                                    

    <!-- form -->
    <form class="form ajaxsubmit reload-tb validate-form" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">
            <div class="row">
            <input type="hidden" value="<?=$user->id;?>" name="clinic_id">
            <div class="col-6">
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" placeholder="Enter title" name="title" value="<?=@$row->title?>" >
                <label class="error text-danger"></label>
            </div>
            </div>
             <div class="form-group col-6">
                <label for="name">Duration <span class="text-danger">( in min )</span></label>
                <input type="number" class="form-control" placeholder="Duration in min" name="duration" value="<?=@$row->duration?>" >
                <label class="error text-danger"></label>
            </div>
            <!-- <div class="form-group col-6">
                <label for="name">Treatment Price</label>
                <input type="number" class="form-control" name="treatment_price" value="<?//=@$row->treatment_price?>"  placeholder="0">
                <label class="error text-danger"></label>
            </div> -->
            <div class="form-group col-6">
                <label for="name">Advance Amount for Appointment</label>
                <input type="number" class="form-control" name="appointment_advance" value="<?=@$row->appointment_advance?>" placeholder="0">
                <label class="error text-danger"></label>
            </div>
            <div class="form-group col-6">
                <label for="name">Photo</label>
                <input type="file" type="file" name="img[]" class="form-control"
size="55550" accept=".png, .jpg, .jpeg, .gif ,.webP, .svg" multiple="">
                <label class="error text-danger"></label>
            </div>
            <div class="form-group col-12">
                <label for="name">YouTube Link</label>
                <input type="text" class="form-control" name="video_url" value="<?=@$row->video_url?>" >
                <label class="error text-danger"></label>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea rows="5" id="editor" class="form-control" required name="description"><?=@$row->description?></textarea>
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

  <script>
  CKEDITOR.replace( 'editor', {
  toolbar: [
  { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
  { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
  { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
  { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
  '/',
  { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
  { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
  { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
  { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
  '/',
  { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
  { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
  { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
  { name: 'others', items: [ '-' ] },
  ]
  });
  </script>
           