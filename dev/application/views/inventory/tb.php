<div class="card-body card-dashboard">
   <div class="row">
        <div class="col-sm-12 col-md-6">
            <!-- <div class="dataTables_length" id="DataTables_Table_0_length">
                <label>
                    Show 
                    <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-control form-control-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select> 
                    entries
                </label>
            </div> -->
        </div>
        <div class="col-sm-12 col-md-6">
           <!--  <div id="DataTables_Table_0_filter" class="dataTables_filter">
                <label>
                    <input type="search" class="form-control form-control-sm static-tb-search" tbtarget="#mytable" placeholder="Search" aria-controls="DataTables_Table_0" >
                </label>
            </div> -->
        </div>
    </div>
   <!-- <div class="row"> -->
   <div class="table-responsive pt-1">
       <table class="table table-bordered base-style" id="mytable">
           <thead>
               <tr>
                   <th>Sr. no.</th>
                   <?php if ($user->user_role!=8) { ?>
                   <th>Clinic</th>
                   <?php } ?>
                   <th>Name</th>
                   <th>Category</th>
                   <th>Sub Category</th>
                   <th class="text-right">Quantity</th>
                   <th class="text-center">Status</th>
                   <?php if ($user->user_role!=8) { ?>
                        <th style="width: 180px;">Action</th>
                   <?php } ?>
                       
                   
               </tr>
           </thead>
           <tbody>
               <?php $i=0;
               foreach ($rows as $row) { ?>
               <tr >
                    <td class="sr_no"><?=++$i?></td>
                    <?php if ($user->user_role!=8) { ?>
                    <td><?=$row->clinic?> </td>
                    <?php } ?>
                    
                    <td><?=$row->name?> </td>
                    <td><?=$row->category?></td>
                    <td><?=$row->sub_category?></td>
                    <td class="text-right">
                       <?=$row->qty?>
                    </td>
                   
                   <td class="text-center">
                       <span class="changeStatus" data-toggle="change-status" value="<?=($row->status==1) ? 0 : 1?>" data="<?=$row->id?>,shops_inventory,id,status" ><i class="<?=($row->status==1) ? 'la la-check-circle' : 'icon-close'?>" title="Click for chenage status"></i></span>
                   </td>
                    <?php if ($user->user_role!=8) { ?>
                    <td>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Inventory Transfer - <?=$row->name?>" data-url="<?=$transfer_url?><?=$row->id?>" title="Inventory Transfer">
                           <i class="ft-share-2"></i>
                        </a>
                       <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Inventory - <?=$row->name?>" data-url="<?=$update_url?><?=$row->id?>" title="Update">
                           <i class="la la-pencil-square"></i>
                       </a>

                       <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$row->id?>" title="Delete" >
                           <i class="la la-trash"></i>
                       </a>
                    </td>
                    <?php } ?>
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
