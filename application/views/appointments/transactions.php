<div class="table-responsive pt-1">
       <table class="table table-bordered base-style" id="mytable">
           <thead>
               <tr>
                   <th class="sr_no">Sr. no.</th>
                   <th>Head</th>
                   <th>Date</th>
                   <th>Ref. No</th>
                   <th>Status</th>
                   <th class="text-right">Amount</th>
                   <th>Screenshot</th>
               </tr>
           </thead>
           <tbody class="text-nowrap">
               <?php
                if (@$rows):  
	                $i = $total_amount = 0; 
	                foreach ($rows as $row) :
	               	$total_amount += $row->amount;  ?>
	               	<tr>
	                    <td class="sr_no"><?=++$i?></td>
	                    <td><?=$row->transaction_head?> </td>
	                    <td><?=_date($row->date)?> </td>
	                    <td><?=$row->payment_ref_no?> </td>
	                    <td><?=$row->payment_status?> </td>
	                    <td class="text-right"><?=$row->amount?> </td>
	                    <td class="text-center">
	                    	<?php if (@$row->screenshot) { ?>
	                    		<img src="<?=img_base_url()?><?=$row->screenshot?>" class="img-sm zoom-img">
	                    	<?php } ?>
	                    	
	                    </td>
	                </tr> 
	            	<?php endforeach; ?>
	            	<tr>
	            		<!-- <td colspan="4"></td> -->
	            		<th colspan="5">Total</th>
	            		<th class="text-right"><?=$total_amount?></th>
	                    <th></th>
	                </tr>
	            <?php else: ?>
	            	<tr>
	                    <td colspan="7" class="text-center text-danger">Data Not Found!</td>
	                    
	                </tr>
	            <?php endif;  ?>
               
               
           </tbody>
           
       </table>

   </div>