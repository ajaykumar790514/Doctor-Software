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
            <div id="DataTables_Table_0_filter" class="dataTables_filter">
                <label>
                    <input type="search" class="form-control form-control-sm static-tb-search" tbtarget="#mytable" placeholder="Search" aria-controls="DataTables_Table_0" >
                </label>
            </div>
        </div>
    </div>
   <!-- <div class="row"> -->
   <div class="table-responsive pt-1">
       <table class="table table-bordered base-style" id="mytable">
           <thead>
               <tr>
                   <th>Sr. no.</th>
                   <th>Branch Name</th>
                   <th>State</th>
                   <th>City</th>
                   <th class="text-center">Timing</th>
                   <th class="text-center">Status</th>
                   <th style="width: 180px;">Action</th>
               </tr>
           </thead>
           <tbody>
               <?php $i=0;
               foreach ($rows as $row) { ?>
               <tr class="<?=($row->user_role==7) ? 'bg-light':''?>" >
                    <td class="sr_no"><?=++$i?></td>
                    <td>
                        <?=$row->name?> (<?=$row->code?>) 
                        <?=($row->user_role==7) ? '<small><strong>Main Branch</strong></small>':''?>
                    </td>
                    <td><?=$row->state_name?></td>
                    <td><?=$row->city_name?></td>
                    <td class="text-center">
                       <span href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="<?=$row->name?> (<?=$row->code?>)  - timing" data-url="<?=$timing_url?><?=$row->id?>" title="Timing" ><i class="la la-hourglass-2"></i></span>
                    </td>
                   
                   <td class="text-center">
                       <span class="changeStatus" data-toggle="change-status" value="<?=($row->active==1) ? 0 : 1?>" data="<?=$row->id?>,clinics,id,active" ><i class="<?=($row->active==1) ? 'la la-check-circle' : 'icon-close'?>" title="Click for chenage status"></i></span>
                   </td>
                  
                   <td>
                       <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Clinic - <?=$row->name?>" data-url="<?=$update_url?><?=$row->id?>" title="Update">
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

 
<!-- </div> -->
