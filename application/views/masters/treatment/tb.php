<div class="card-body card-dashboard">
   <div class="table-responsive pt-1">
       <table class="table table-bordered base-style" id="mytable">
           <thead>
               <tr>
                   <th>Sr. no.</th>
                   <th>Photo</th>
                   <th>Clinic Name </th>
                   <th>Title</th>
                   <th>Duration</th>
                   <th>Advance Amount for Appointment</th>
                   <th class="text-center">Status</th>
                   <th style="width: 180px;">Action</th>
               </tr>
           </thead>
           <tbody>
               <?php $i=0;
               foreach ($rows as $row) {
                if ($row->photos != null) {
                    $result =  '<img src="' . IMGS_URL.$row->photos . '" height="100px" width="100px" >';
                } else {
                    $result = '<h1 style="height:70px;width:70px;border-radius:10px;padding-top:15px;font-size:3rem;text-align:center;text-transform:capitalize;background:#7271CF;color:#FFF">' . substr($row->title, 0, 1) . '</h1>';
                } ?>
               <tr >
                   <td class="sr_no"><?=++$i?></td>
                   <td align="center"><?=$result;?></td>
                   <td><?=$row->clinic_name?>( <?=$row->clinic_code?> )</td>
                   <td align="center"><?=$row->title;?></td>
                   <td align="center"><?=$row->duration;?> min</td>
                   <td align="center"><?=$row->appointment_advance;?></td>
                   <td class="text-center">
                       <span class="changeStatus" data-toggle="change-status" value="<?=($row->active==1) ? 0 : 1?>" data="<?=$row->id?>,treatment_master,id,active" ><i class="<?=($row->active==1) ? 'la la-check-circle' : 'icon-close'?>" title="Click for chenage status"></i></span>
                   </td>
                  
                   <td>
                       <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Treatment - <?=$row->title?>" data-url="<?=$update_url?><?=$row->id?>" title="Update Treatment">
                           <i class="la la-pencil-square"></i>
                       </a>

                       <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$row->id?>" title="Delete  Treatment" >
                           <i class="la la-trash"></i>
                       </a>
                       <br>
                       
                    <a class="btn btn-primary btn-sm mt-1" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Treatment Images ( <?=$row->title?> )" data-url="<?=$pimg_url?><?=$row->id?>" >Album</a>
                   </td>
               </tr> 

                  

               <?php } ?>
               
               
           </tbody>
           
       </table>

   </div>

 
<!-- </div> -->
