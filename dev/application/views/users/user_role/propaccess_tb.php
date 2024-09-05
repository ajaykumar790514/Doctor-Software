<?php foreach ($propmaster as $row) { ?>
	<tr class="<?=$row->checked?>">
		<td>
			<input type="checkbox" class="switchery" data-size="sm" name="" id="apropnaster" value="<?=$row->id?>" <?=$row->checked?> >
		</td>
		<td><?=$row->propname?> <br> ( <?=$row->propcode?> )</td>
		<td>
			<?=title('cities', $row->city,'id','name')?>,<br>
			<?=title('states', $row->state,'id','name')?>,<br>
			<?=title('countries', $row->country,'id','name')?>
		</td>
		<td><?=$row->address?></td>
		
	</tr>
<?php } ?>