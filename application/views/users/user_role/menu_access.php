<?php
echo "<pre>";
// print_r($menus);
echo "</pre>";
?>

<div class="row">

	<div class="col-md-12 table-responsive">

		<table class="table table-striped table-bordered base-styl menuaccess">
			<thead>
				<tr>
					<th>Select</th>
					<th>Menu</th>
					<th>Create</th>
					<th>Update</th>
					<th>Delete</th>

				</tr>
			</thead>
			<tbody id="propaccess">
			<?php foreach ($menus as $row) { ?>
				<tr>
					<td>
						<input type="checkbox" class="switchery" data-size="sm" name="" id="amenu" value="<?=$row->id?>" <?=$row->checked?> >
					</td>
					<td><?=$row->title?></td>
					<td>
						<input type="checkbox" class="switchery permissions" data-size="sm" name="add" value="<?=$row->id?>" <?=$row->c_checked?> >
					</td>
					<td>
						<input type="checkbox" class="switchery permissions" data-size="sm" name="update" value="<?=$row->id?>" <?=$row->u_checked?> >
					</td>
					<td>
						<input type="checkbox" class="switchery permissions" data-size="sm" name="delete" value="<?=$row->id?>" <?=$row->d_checked?> >
					</td>
					
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$('.menuaccess .switchery').change(function(event){
		$this = $(this);
		var id = $this.val();
		var name = $this.attr('name');
		if (event.currentTarget.checked) {
			var type = 'set';  
	   }
	   else{
	   	var type = 'remove';
	   }

	   $.post('<?=$m_access_url?><?=$role_id?>',{m_id:id,type:type,name:name})
		.done(function(data){
			console.log(data);
			data = JSON.parse(data);
			alert_toastr(data.res,data.msg);
			if (data.res=='success') {
				if (name=='') {
					if (type=="set") {
						$this.parent().parent().children().children('.permissions').prop('checked',true);
					}
					else{
						$this.parent().parent().children().children('.permissions').prop('checked',false);
					}
				}
				loadtb();
			}
			if (data.res=="error") {
				if (type=="set") {
					$this.prop('checked',false);
				}
				else{
					$this.prop('checked',true);
				}
			}
		})
  })

</script>