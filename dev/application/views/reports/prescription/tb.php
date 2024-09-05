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
       <table class="table table-bordered base-style table-sm" id="mytable">
           <thead>
               <tr>
                   <th class="sr_no">Sr. no.</th>
                   <th>Appointment Details</th>
                   <th>Patient Details</th>
                   <th>Prescription</th>
                   <th>Other Details</th>
               </tr>
           </thead>
           <tbody class="text-nowrap">
               <?php $i=0;
               foreach ($rows as $row) { ?>
               <tr >
                    <td class="sr_no"><?=++$i?></td>
                    <td class="p-0">
                        <table class="table table-sm no-bordered m-0">
                            <tbody>
                                <?php if ($user->user_role!=8) { ?>
                                <tr>
                                    <th>Clinic</th>
                                    <td> : </td>
                                    <td> <?=$row->clinic_name?> </td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <th>Date</th>
                                    <td> : </td>
                                    <td><?=_date($row->appointment_date)?></td>
                                </tr>
                                <tr>
                                    <th>Time</th>
                                    <td> : </td>
                                    <td>
                                        <?=_time($row->appointment_start_time).' - '._time($row->appointment_end_time)?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td> : </td>
                                    <td><?=$row->appointment_status?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="p-0">
                        <table class="table table-sm no-bordered m-0">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td> : </td>
                                    <td> <?=$row->patient_name?> </td>
                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <td> : </td>
                                    <td><?=$row->patient_code?></td>
                                </tr>
                                <tr>
                                    <th>Age</th>
                                    <td> : </td>
                                    <td><?=$row->age?></td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td> : </td>
                                    <td><?=$row->gender?></td>
                                </tr>
                                <tr>
                                    <th>Mobile No.</th>
                                    <td> : </td>
                                    <td><?=$row->mobile?></td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table class="table table-sm no-bordered m-0">
                            <tr>
                                <th>Medicine</th>    
                                <th center>Quantity</th>    
                                <th>Remark</th>    
                            </tr>
                            <?php if(@$row->prescription) : foreach ($row->prescription as $prow) : ?>
                                <tr>
                                   <td><?=$prow->medicine_name?></td> 
                                   <td center><?=$prow->qty?></td> 
                                   <td><?=$prow->remark?></td> 
                                </tr>
                            <?php endforeach; endif; ?>
                        </table>
                        
                    </td>
                     <td class="p-0">
                        <table class="table table-sm no-bordered m-0">
                            <tbody>
                                <tr>
                                    <th colspan="3">Docter Remark : </th>
                                </tr>
                                <tr>
                                    <td colspan="3"> <?=$row->doc_remark?> </td>
                                </tr>
                                <tr>
                                    <th colspan="3">Clinic Remark : </th>
                                </tr>
                                <tr>
                                    <td colspan="3"><?=$row->clinic_remark?></td>
                                </tr>
                                <tr>
                                    <th>Next Meeting Date</th>
                                    <td> : </td>
                                    <td><?=_date($row->next_meeting_date)?></td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td> : </td>
                                    <td><?=$row->amount?></td>
                                </tr>
                                
                               
                            </tbody>
                        </table>
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
