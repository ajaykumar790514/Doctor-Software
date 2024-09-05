<div class="row justify-content-center">
	<div class="col-md-10">
		<table class="table table-bordered table-striped ">
			<tr>
				<td> Name </td>
				<td> <?=$row->name?> </td>
			</tr>

			<tr>
				<td> Gender </td>
				<td> <?=$row->gender?> </td>
			</tr>

			<tr>
				<td> Marital Status </td>
				<td> <?=$row->marital_status?> </td>
			</tr>

			<tr>
				<td> Date Of Birth </td>
				<td> <?=_date($row->date_of_birth)?> </td>
			</tr>

			<tr>
				<td> Address </td>
				<td> <?=$row->address?> </td>
			</tr>

			<tr>
				<td> Pincode </td>
				<td> <?=$row->pincode?> </td>
			</tr>
			

			

		</table>
	</div>
	
</div>


