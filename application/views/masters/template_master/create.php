<div class="card-content collapse show">
    <div class="card-body">
    <form class="form ajaxsubmit reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">
            <div class="form-group">
                <label for="template_id">Template ID</label>
                <input type="text" class="form-control" name="template_id" placeholder="Enter template ID" value="<?=@$row->dlt_te_id?>">
            </div>
        </div>
        <div class="form-body w-100">
           <div class="form-group">
                <label for="template">Template Name</label>
                <textarea class="form-control" name="template" placeholder="Enter template " ><?=@$row->template?></textarea>
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

