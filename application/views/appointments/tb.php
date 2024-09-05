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
                   <th class="sr_no">Sr. no.</th>
                   <?php if ($user->user_role!=8) { ?>
                   <th>Clinic</th>
                   <?php } ?>
                   <th>App. Type</th>
                   <th>App. Date</th>
                   <th class="text-nowrap">App. Time</th>
                   <th>Patient Name</th>
                   <th>Mobile</th>
                   <th>State / City</th>
                   <th>Status</th>
                   <?php if ($user->user_role!=8) { ?>
                        <th style="width: 180px;">Action</th>
                   <?php } ?>
                       
                   
               </tr>
           </thead>
           <tbody class="text-nowrap">
               <?php $i=0;
               foreach ($rows as $row) { ?>
               <tr >
                    <td class="sr_no"><?=++$i?></td>
                    <?php if ($user->user_role!=8) { ?>
                    <td><?=$row->clinic_name?> </td>
                    <?php } ?>
                    
                    <td><?=$row->appointment_type?>
                    <?php 
                  if($row->appointment_type=='Treatment'){?>
                 <a class="text-danger" target="_blank" href="<?=base_url('view-treatment-details/'.$row->treatment_id);?>"> <i class="la la-info"></i></a>
                     
                     <?php }?>
                    </td>
                    <td><?=_date($row->appointment_date)?> </td>
                    <td>
                        <?=_time($row->appointment_start_time)?> - 
                        <?=_time($row->appointment_end_time)?>
                    </td>
                    <td><?=$row->patient_name?> </td>
                    <td><?=$row->mobile?></td>
                    <td><?=$row->state?> / <?=$row->city?></td>
                    <td><?=$row->appointment_status?></td>

                    <?php if ($user->user_role!=8) { ?>
                    <td>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Prescription - <?=$row->patient_name?>" data-url="<?=$pre_url?><?=$row->id?>" title="Prescription" class="mr-1">
                           <i class="la la-commenting-o"></i>
                        </a>

                        <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Transactions - <?=$row->patient_name?>" data-url="<?=$tran_url?><?=$row->id?>" title="Transactions" class="mr-1">
                           <i class="la la-inr"></i>
                        </a>

                        <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Attatchment File - <?=$row->patient_name?>" data-url="<?=$attatch_url?><?=$row->id?>" title="Attatchment File" class="mr-1">
                           <i class="la la-eye"></i>
                        </a>
                       <?php $count1= $this->model->Counter('appointments', array('id'=> $row->id,'status'=>'2')) ;if($count1 !=1){?>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Cancel Appointment  - <?=$row->patient_name?>" data-url="<?=$change_status_url?><?=$row->id?>" title="Cancel Appointment" class="mr-1 btn btn-sm btn-primary">
                        Cancel
                        </a>
                        
                         <?php if($row->reschedule_count < 2 ){?>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Reschedule Appointment  - <?=$row->patient_name?>" data-url="<?=$reschedule_app?><?=$row->id?>" title="Reschedule Appointment" class="mr-1 mt-1 btn btn-sm btn-primary">
                        Reschedule 
                        </a>
                        <?php }else{?>
                            <a href="javascript:void(0)" onclick="reschedule()" title="Reschedule Appointment" class="mr-1 mt-1 btn btn-sm btn-primary">
                        Reschedule 
                        </a>
                        <?php } }?>
                       <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Appointment - <?=$row->patient_name?>" data-url="<?=$update_url?><?=$row->id?>" title="Update">
                           <i class="la la-pencil-square"></i>
                       </a> -->

                     <!--   <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$row->id?>" title="Delete" >
                           <i class="la la-trash"></i>
                       </a> -->
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

<script>
    function reschedule()
    {
        alert_toastr('error','appointment reschedule limit exceeded');
    }
</script>
