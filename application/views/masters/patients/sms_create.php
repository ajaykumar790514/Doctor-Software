<div class="card-content collapse show">
    <div class="card-body">
    <form id="myForm" enctype="multipart/form-data">
        <div class="form-body w-100">
            <div class="form-group">
                <label for="">Select Template</label>
                <select name="template" id="template" class="form-control">
                    <option value="">--Select Template--</option>
                    <?php foreach($templates as $temp):?>
                       <option value="<?=$temp->id;?>">
                       <?php if (strlen($temp->template) > 20): ?>
                    <?= substr($temp->template, 0, 100) . '...'; ?>
                    <?php else: ?>
                        <?= $temp->template; ?>
                    <?php endif; ?>
                       </option>
                     <?php endforeach;?>   
                </select>
            </div>
        </div>
        <div class="form-actions text-right">
            <button type="reset" data-dismiss="modal" class="btn btn-danger mr-1">
                <i class="ft-x"></i> CANCEL
            </button>
            <button  type="button" id="btnsubmit" class="btn btn-primary mr-1"  >
                <i class="ft-check"></i> SEND 
            </button>
        </div>
    </form>
      </div>
    </div>

    <script>
    //Send SMS
    
    $(document).ready(function () {
    $("#btnsubmit").on("click", function() {
       $('#showModal').modal('hide');
       Swal.fire({
                title: 'Are you sure?',
                text: "You want to send this SMS!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, send it!'
                }).then((result) => {
                    if(result.value==true){
                if ($("#myForm").valid()) {
                    $("#btnsubmit").prop('disabled', true);
                    var search = $("#name").val();
                    var clinic = $("#clinic").val();
                    var formData = new FormData($("#myForm")[0]);
                    formData.append('search', search);
                    formData.append('clinic', clinic);
                    $.ajax({
                        url: '<?=$action_url?>',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            console.log("Success Data:", data);
                            try {
                                var parsedData = JSON.parse(data);
                                console.log("Parsed Data:", parsedData);

                                if (parsedData.res.trim() == 'success') {
                                    $("#btnsubmit").prop('disabled', false);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: parsedData.msg,
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                    
                                    $("#myForm")[0].reset();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: parsedData.msg
                                    });
                                }
                            } catch (e) {
                                console.error("Error parsing JSON: ", e);
                                alert_toastr("error","Error parsing server response.");
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX Error: ", status, error);
                            alert_toastr("error","AJAX Error: " + status);
                        }
                    });
                }
            }
        }).catch(swal.noop);
            return false;
    });
});

</script>


