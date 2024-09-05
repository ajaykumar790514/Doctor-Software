<?php 
	$space = $row->space;
	$available_space = $row->available_space;
	// echo $used_space = $space - $available_space;
	$available_space = ($available_space * 100) / $space;
	$used_per = 100 - $available_space;
	// echo prx($row);
?>
<div class="row justify-content-center">
	<div class="col-md-10">
		<h2><?=$row->name?></h2>
		
		<table class="table table-bordered table-striped ">
			<tr>
				<td> Valid Form </td>
				<td int> <?=date('F d, Y H:i A',strtotime($row->start_date))?> </td>
			</tr>
			<tr>
				<td> Valid To </td>
				<td int> <?=date('F d, Y H:i A',strtotime($row->end_date))?> </td>
			</tr>
			<tr>
				<td> Price </td>
				<td int> ₹ <?=$row->actual_price?> </td>
			</tr>
			<tr>
				<td> Discounted Price </td>
				<td int>₹ <?=$row->discounted_price?> </td>
			</tr>
			<tr>
				<td> Total Space  </td>
				<td int> <?=_nf($row->space)?> MB </td>
			</tr>
			<tr>
				<td> Occupied Space  </td>
				<td int class="text-danger"> <?=_nf($row->space - $row->available_space)?> MB </td>
			</tr>

			<tr>
				<td> Available Space </td>
				<td int style="color: green;"> <?=_nf($row->available_space)?> MB </td>
			</tr>

			<!-- <tr>
				<td> No of files  </td>
				<td int > <?=$row->available_no_of_files?></td>
			</tr> -->

		</table>
	</div>
	
</div>


