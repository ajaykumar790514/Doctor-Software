<?php
echo "<pre>";
// print_r($menus);
echo "</pre>";
?>

<div class="row">
<form class="form ajaxsubmit reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
    <div class="col-md-12 table-responsive">

        <table class="table table-striped table-bordered base-styl menuaccess">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Open</th>
                    <th>Close</th>
                </tr>
            </thead>
            <tbody id="">
                <tr>
                    <th>SUNDAY</th>
                    <th><input type="time" class="form-control" name="sun_open" value="<?=$timing['sun']->open?>"></th>
                    <th><input type="time" class="form-control" name="sun_close" value="<?=$timing['sun']->close?>"></th>
                </tr>
                <tr>
                    <th>MONDAY</th>
                    <th><input type="time" class="form-control" name="mon_open" value="<?=$timing['mon']->open?>"></th>
                    <th><input type="time" class="form-control" name="mon_close" value="<?=$timing['mon']->close?>"></th>
                </tr>
                <tr>
                    <th>TUESDAY</th>
                    <th><input type="time" class="form-control" name="tue_open" value="<?=$timing['tue']->open?>"></th>
                    <th><input type="time" class="form-control" name="tue_close" value="<?=$timing['tue']->close?>"></th>
                </tr>
                <tr>
                    <th>WEDNESDAY</th>
                    <th><input type="time" class="form-control" name="wed_open" value="<?=$timing['wed']->open?>"></th>
                    <th><input type="time" class="form-control" name="wed_close" value="<?=$timing['wed']->close?>"></th>
                </tr>
                <tr>
                    <th>THURSDAY</th>
                    <th><input type="time" class="form-control" name="thu_open" value="<?=$timing['thu']->open?>"></th>
                    <th><input type="time" class="form-control" name="thu_close" value="<?=$timing['thu']->close?>"></th>
                </tr>
                <tr>
                    <th>FRIDAY</th>
                    <th><input type="time" class="form-control" name="fri_open" value="<?=$timing['fri']->open?>"></th>
                    <th><input type="time" class="form-control" name="fri_close" value="<?=$timing['fri']->close?>"></th>
                </tr>
                <tr>
                    <th>SATURDAY</th>
                    <th><input type="time" class="form-control" name="sat_open" value="<?=$timing['sat']->open?>"></th>
                    <th><input type="time" class="form-control" name="sat_close" value="<?=$timing['sat']->close?>"></th>
                </tr>
           
            </tbody>
        </table>
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
</div>
