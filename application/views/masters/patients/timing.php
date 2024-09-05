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
                    <th><input type="time" class="form-control" name="su_open"></th>
                    <th><input type="time" class="form-control" name="su_close"></th>
                </tr>
                <tr>
                    <th>MONDAY</th>
                    <th><input type="time" class="form-control" name="mo_open"></th>
                    <th><input type="time" class="form-control" name="mo_close"></th>
                </tr>
                <tr>
                    <th>TUESDAY</th>
                    <th><input type="time" class="form-control" name="tu_open"></th>
                    <th><input type="time" class="form-control" name="tu_close"></th>
                </tr>
                <tr>
                    <th>WEDNESDAY</th>
                    <th><input type="time" class="form-control" name="we_open"></th>
                    <th><input type="time" class="form-control" name="we_close"></th>
                </tr>
                <tr>
                    <th>THURSDAY</th>
                    <th><input type="time" class="form-control" name="th_open"></th>
                    <th><input type="time" class="form-control" name="th_close"></th>
                </tr>
                <tr>
                    <th>FRIDAY</th>
                    <th><input type="time" class="form-control" name="fr_open"></th>
                    <th><input type="time" class="form-control" name="fr_close"></th>
                </tr>
                <tr>
                    <th>SATURDAY</th>
                    <th><input type="time" class="form-control" name="sa_open"></th>
                    <th><input type="time" class="form-control" name="sa_close"></th>
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

<script type="text/javascript">
  //   $('.menuaccess .switchery').change(function(event){
  //       $this = $(this);
  //       var id = $this.val();
  //       var name = $this.attr('name');
  //       if (event.currentTarget.checked) {
  //           var type = 'set';  
  //      }
  //      else{
  //       var type = 'remove';
  //      }

  //      $.post('<?=$m_access_url?><?=$role_id?>',{m_id:id,type:type,name:name})
  //       .done(function(data){
  //           console.log(data);
  //           data = JSON.parse(data);
  //           alert_toastr(data.res,data.msg);
  //           if (data.res=='success') {
  //               if (name=='') {
  //                   if (type=="set") {
  //                       $this.parent().parent().children().children('.permissions').prop('checked',true);
  //                   }
  //                   else{
  //                       $this.parent().parent().children().children('.permissions').prop('checked',false);
  //                   }
  //               }
  //               loadtb();
  //           }
  //           if (data.res=="error") {
  //               if (type=="set") {
  //                   $this.prop('checked',false);
  //               }
  //               else{
  //                   $this.prop('checked',true);
  //               }
  //           }
  //       })
  // })

</script>