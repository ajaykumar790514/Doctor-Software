<div class="card-content collapse show">
    <div class="card-body">
                                    

    <!-- form -->
    <form class="form ajaxsubmit reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">
            
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" placeholder="Title" name="name" value="<?=(@$row->name) ? $row->name : '' ?>" >
            </div>

            <div class="form-group">
                <label for="name">Description</label>
                <textarea class="form-control" placeholder="Title" name="Description" rows="3" ><?=(@$row->description) ? $row->description : '' ?></textarea>
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

