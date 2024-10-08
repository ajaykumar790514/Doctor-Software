<form enctype="multipart/form-data" method="post">
<div class="row">
            <div class="col-8 mb-3">
<input type="file" id="files" name="img[]" class="form-control"
size="55550" accept=".png, .jpg, .jpeg, .gif, .webP, .svg" multiple="" required>
</div>
<div class="col-4">
<button id="imgsubmit" type="button" class="btn btn-primary" onclick="add_prop_img(<?php echo $pid;?>)"><i id="loader" class=""></i>Add Image</button>
</div>
</form>
<div class="card-body card-dashboard">
   <div class="table-responsive pt-1">
       <table class="table table-bordered base-style" id="mytable">
<tr>
<th>S.No.</th>
<th>Images</th>
<th>Sequence</th>
<th>Actions</th>


</tr>

<?php $i=1;foreach($images as $product){ ?>
<tr>
    <td><?php echo $i++ ?></td>
    <td> 
        <?php if(!empty($product->img)) { ?>
            <img src="<?php echo IMGS_URL.$product->img; ?>" alt="" height="100" width="100">
        <?php } ?> 
    </td>
    <td><input type="number" name="seq" id="seq<?php echo $product->id; ?>" value="<?= $product->seq;?>" onchange="update_prod_seq(<?php echo $product->id; ?>)"></td>
    <td>
    <?php if($product->is_cover != 1) {?>
    <a href="javascript:void(0)" onclick="deleteimage(<?php echo $product->id; ?>)"><i class="la la-trash"></i></a>
    <?php } ?>
    <?php if($product->is_cover == 1) {?>
    <a href="javascript:void(0)" class="btn btn-primary btn-sm">Cover</a>
    <?php } else{ ?>
        <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="makecover(<?php echo $product->id; ?>)">Make Cover</a>
    <?php } ?>
    </td>
</tr>
<?php } ?>
</table>
   </div>
</div>

<script>
    function add_prop_img(pid){
        var element = document.getElementById("loader");
        element.className = 'fa fa-spinner fa-spin';
        $("#imgsubmit").prop('disabled', true);
        var form_data = new FormData();

// Read selected files
var totalfiles = $('#files')[0].files;
for (var i = 0; i < totalfiles.length; i++) {
  // var name = document.getElementById('files').files[i].name;
//   console.log(document.getElementById('files').files[i]);
   form_data.append("file[]", document.getElementById('files').files[i]);
   form_data.append("pid", pid);
// console.log(form_data);
}
$.ajax({
     url: '<?php echo base_url('treatment/add_image'); ?>', 
     type: 'post',
     data: form_data,
     contentType: false,
     processData: false,
     success: function (response) {
        var element = document.getElementById("loader");
                element.classList.remove("fa-spinner");
                $("#imgsubmit").prop('disabled', false);
// console.log(response);
$('#showModal .modal-body').load("<?php echo base_url('treatment/property-image/')?>"+<?=$pid ?>);

toastr.success('Image Added Successfully..');
       },
       error: function(xhr, status, error) {
                 console.log(xhr.responseText);
        }       
   });

        

          
    }
</script>
<script>
    function deleteimage(imageid){
       
        if(confirm('Do you want to delete?') == true)
        {
            $('#showModal .modal-body').load("<?php echo base_url('treatment/delete_image/')?>"+<?=$pid ?>+"/"+imageid );
            toastr.success('Image Deleted Successfully..');
        }
    }
</script>
<script>
    function makecover(imageid){
       
        if(confirm('Are You Sure?') == true)
        {
            $('#showModal .modal-body').load("<?php echo base_url('treatment/make_cover/')?>"+<?=$pid ?>+"/"+imageid );
            toastr.success('Cover Updated Successfully..');
        }
    }
</script>
<script>
    function update_prod_seq(imageid){
       
        var seq = $('#seq'+imageid).val();
            $('#showModal .modal-body').load("<?php echo base_url('treatment/update_prod_seq/')?>"+<?=$pid ?>+"/"+imageid+"/"+seq );
            toastr.success('Sequence Updated Successfully..');

    }
</script>