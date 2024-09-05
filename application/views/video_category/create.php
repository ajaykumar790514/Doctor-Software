<div class="card-content collapse show">
    <div class="card-body">
    <!-- form -->
 
    <form class="form submit ajaxsubmit reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">
            
            <div class="form-group">
                <label for="name">Video Category Name</label>
                <input type="text" class="form-control" placeholder="Name..." name="name" value="<?=@$row->name?>" >
                <label class="error text-danger"></label>
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

