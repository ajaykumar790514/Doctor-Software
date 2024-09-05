<div class="card-body card-dashboard">
   <!-- <div class="row"> -->
    <div class="table-responsive pt-1">
        <table class="table table-bordered base-style" id="mytable">
            <thead>
                <tr>
                   <th>Sr. no.</th>
                   <th>URL</th>
                   <th>Template ID</th>
                   <th>Template Name</th>
                   <th>Sender ID</th>
                   <th>Auth Key</th>
                   <th>Route ID</th>
                   <th class="text-center">Status</th>
                   <th style="width: 180px;">Action</th>
                </tr>
            </thead>
            <tbody>
               <?php $i=0;
               foreach ($rows as $row) { ?>
                <tr>
                    <td class="sr_no"><?=++$i?></td>
                    <td> <?=$row->url?></td>
                    <td> <?=$row->dlt_te_id?></td>
                    <td><?=$row->template?></td>
                    <td><?=$row->senderId?></td>
                    <td><?=$row->authKey?></td>
                    <td><?=$row->routeId?></td>               
                    <td class="text-center">
                       <span class="changeStatus" data-toggle="change-status" value="<?=($row->active==1) ? 0 : 1?>" data="<?=$row->id?>,sms_master,id,active" ><i class="<?=($row->active==1) ? 'la la-check-circle' : 'icon-close'?>" title="Click for chenage status"></i></span>
                    </td>
                  
                    <td>
                       <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Patient - <?=$row->template?> (<?=$row->template?>)" data-url="<?=$update_url?><?=$row->id?>" title="Update">
                           <i class="la la-pencil-square"></i>
                       </a>

                       <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$row->id?>" title="Delete" >
                           <i class="la la-trash"></i>
                       </a>
                    </td>
                </tr> 

                   


               <?php }  ?>
               
               
           </tbody>
           
       </table>

   </div>
   <div class="row">
        <div class="col-md-6 text-left">
            <span>Showing <?= (@$rows) ? $page+1 : 0 ?> to <?=$i?> of <?=$total_rows?> entries</span>
        </div>
        <div class="col-md-6 text-right">
            <?=$links?>
        </div>
    </div>

 
<!-- </div> -->
