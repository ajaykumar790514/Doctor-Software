<div class="row">
	<div class="col-12 text-center">
		<?php if (@$row->photo) { ?>
            <img src="<?=img_base_url()?><?=$row->photo?>" class="img-thumbnail" style="max-height:280px;">
        <?php } ?>
	</div>
	<div class="col-12">
		<table class="table table-bordered table-striped table-hover">
			<tbody>
				<tr>
					<th>Name</th>
					<td colspan="3"><?=$row->name?></td>
				</tr>

				<tr>
					<th>Actual Price</th>
					<td> ₹ <?=$row->actual_price?></td>
					<th>Discounted Price</th>
					<td> ₹ <?=$row->discounted_price?></td>
				</tr>

				<tr>
					<th>Duration</th>
					<td><?=$row->duration?> Days</td>
					<th>Space</th>
					<td><?=$row->space?> Mb</td>
				</tr>
				<tr>
					<th>Diary Limitation</th>
					<td><?=$row->diary_limitation?></td>
					<th>Sequence</th>
					<td><?=$row->sequence?></td>
				</tr>

				<!-- <tr>
					<th>Plan Detail Line 1</th>
					<td colspan="4"><?=$row->plan_detail_line_1?></td>
				</tr>

				<tr>
					<th>Plan Detail Line 2</th>
					<td colspan="4"><?=$row->plan_detail_line_1?></td>
				</tr> -->

				<!-- <tr>
					<th>Color</th>
					<td colspan="4">
						<?php if (@$row->photo) { ?>
				           <input type="color" class="form-control" value="<?=$row->color?>">
				        <?php } ?>
						
					</td>
				</tr> -->

				<tr>
					<th>Folders</th>
					<td><?=(@$row->is_folders==1) ? 'Yes' : 'No'?></td>
					<th>Multiple pins</th>
					<td><?=(@$row->is_multiple_pins==1) ? 'Yes' : 'No'?></td>
				</tr>

				<tr>
					<th>Encryption</th>
					<td><?=(@$row->is_encryption==1) ? 'Yes' : 'No'?></td>
					<th>Phone verification on death</th>
					<td><?=(@$row->is_phone_verification_death==1) ? 'Yes' : 'No'?></td>
				</tr>

				<tr>
					<th>File upload</th>
					<td><?=(@$row->is_file_upload==1) ? 'Yes' : 'No'?></td>
					<th>Ads</th>
					<td><?=(@$row->is_ads==1) ? 'Yes' : 'No'?></td>
				</tr>

				<tr>
					<th>Login reminder on phone</th>
					<td><?=(@$row->is_login_reminders_phone==1) ? 'Yes' : 'No'?></td>
					<th>Login reminder on email</th>
					<td><?=(@$row->is_login_reminders_email==1) ? 'Yes' : 'No'?></td>
				</tr>

				<tr>
					<th>Phone Verification of Diary Delivery</th>
					<td><?=(@$row->diary_delivery_verification_phone==1) ? 'Yes' : 'No'?></td>
					<th>Email Verification of Diary Delivery</th>
					<td><?=(@$row->diary_delivery_verification_email==1) ? 'Yes' : 'No'?></td>
				</tr>

				<tr>
					<th>Phone & Chat Support</th>
					<td><?=(@$row->is_phone_chat_support==1) ? 'Yes' : 'No'?></td>
					<th>No of nominees</th>
					<td><?=$row->no_of_nominees?></td>
				</tr>

				<tr>
					<th>Delete data after handover</th>
					<td><?=$row->delete_data_handover_days?> Days</td>
					<th>Email Support (hours)</th>
					<td><?=$row->email_support_hours?> hours</td>
				</tr>



				<tr>
					<th>Created At</th>
					<td colspan="3"><?=date_time($row->created_at)?></td>
				</tr>

				<tr>
					
					<th>Updated At</th>
					<td colspan="3"><?=date_time($row->updated_at)?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>


