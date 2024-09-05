<div class="card-body card-dashboard">
   <p class="card-text">............</p>
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
<!--             <div id="DataTables_Table_0_filter" class="dataTables_filter">
                <label>
                    <input type="search" class="form-control form-control-sm static-tb-search" tbtarget="#mytable" id="tb-search-remove" placeholder="Search" aria-controls="DataTables_Table_0" >
                </label>
            </div> -->
        </div>
    </div>
   <!-- <div class="row"> -->
   <div class="table-responsive pt-1">
       <table class="table table-striped table-bordered base-style" id="mytable">
           <thead>
               <tr>
                   <th>Sr. no.</th>
                   <th>Photo</th>
                   <th>Name</th>
                   <th>Mobile</th>
                   <th>Email</th>
                   <th>Plan Name</th>
                   <!-- <th>State</th>
                   <th>City</th> -->
                   <th class="text-center">Status</th>
                   <th style="width: 180px;">Action</th>
               </tr>
           </thead>
           <tbody>
               <?php $i=$page;
               foreach ($rows as $row) {
                $_days_diff =  _days_diff(date('Y-m-d'),$row->end_date) ?>
               <tr  class="<?=($_days_diff > 0) ? '':'table-danger' ?>">
                   <td><?=++$i?></td>
                   <td><img src="<?=img_base_url()?><?=$row->name?>" class="img-sm"></td>
                   <td><?=$row->name?></td>
                   <td><?=$row->mobile?></td>
                   <td><?=$row->email?></td>
                   <td class="white-space-nowrap">
                        <?=$row->plan_name?>
                        (<?=($_days_diff > 0) ? $_days_diff.' days remaining':'Expired' ?> )
                   </td>
                   <!-- <td><?=$row->state_name?></td>
                   <td><?=$row->city_name?></td> -->
                   
                   <td class="text-center">
                       
                        <span class="changeStatus" data-toggle="change-status" value="<?=($row->status==1) ? 0 : 1?>" data="<?=$row->user_id?>,users,id,status" ><i class="<?=($row->status==1) ? 'la la-check-circle' : 'icon-close'?>" title="Click for chenage status"></i></span>
                        
                   </td>
                  
                   <td>
                      
                       <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Plan Details - <?=$row->name?>" data-url="<?=$plan_details_url?><?=$row->user_id?>" title="Update">
                           Plan Details
                       </a>

                       <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="App User Details (<?=$row->name?>)" data-url="<?=$details_url?><?=$row->user_id?>" title="Update">
                           <i class="la la-info"></i>
                       </a>
                       
                   </td>
               </tr> 
               <?php
               }
               ?>
               
               
           </tbody>
           
       </table>

   </div>
   <div class="row">
        <div class="col-md-6 text-left">
            <span>Showing <?=$page+1?> to <?=$i?> of <?=$total_rows?> entries</span>
        </div>
        <div class="col-md-6 text-right">
            <?=$links?>
        </div>
    </div>

 
<!-- </div> -->

