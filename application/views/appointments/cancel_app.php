<div class="card-content collapse show">
    <div class="card-body">
                                    

    <!-- form -->
    <form class="form  ajaxsubmit_cancel  reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data"  onsubmit="return confirmSubmission()">
        <div class="form-body w-100 pb-5">
        <div class="col-12">
            <label for="">Enter Remark</label>
            <textarea name="remark" cols="50" rows="5" class="form-control" placeholder="Enter Remark"></textarea>
        </div>
        <div class="form-actions text-right">
            <button type="reset" data-dismiss="modal" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Cancel
            </button>
            <button type="submit" class="btn btn-primary mr-1"  >
                <i class="ft-check"></i> Update
            </button>
        </div>
    </form>
    <!-- End: form -->

                                </div>
                            </div>
