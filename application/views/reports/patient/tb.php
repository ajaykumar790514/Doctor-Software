<div class="card-body card-dashboard">
   <!-- <div class="row"> -->
    
   <div class="table-responsive pt-1">
       <table class="table table-bordered base-style table-sm" id="mytable">
           <thead>
               <tr>
                   <th class="sr_no">Sr. no.</th>
                   <th>Clinic</th>
                   <th>Patient Name</th>
                   <th>Mobile</th>
                   <th>Gender</th>
                   <th>Age</th>
                   <th>State</th>
                   <th>City</th>
                   <th>Pincode</th>
                   <th>Address</th>
                   <th>Marital Status</th>
               </tr>
           </thead>
           <tbody class="text-nowrap">
               <?php $i=$page;
               foreach ($rows as $row) { ?>
               <tr >
                    <td class="sr_no"><?=++$i?></td>
                    <td><?=$row->clinic_name;?> ( <?=$row->clinic_code;?> )</td>
                    <td><?=$row->name;?> ( <?=$row->code;?> ) </td>
                    <td><?=$row->mobile;?></td>
                    <td><?=$row->gender;?></td>
                    <td><?=$row->age;?></td>
                    <td><?=$row->state_name;?></td>
                    <td><?=$row->city_name;?></td>
                    <td><?=$row->pincode;?></td>
                    <td><?=$row->address;?></td>
                    <td><?php if($row->marital_status==1){ echo "Married"; }elseif($row->marital_status==2){echo "Unmarried";};?></td>
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
