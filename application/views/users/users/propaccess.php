<?php
echo "<pre>";
// print_r($propmaster);
echo "</pre>";
?>

<div class="row">
	<form class="form dynamic-tb-search col-md-12 p-0" action="<?=$tb_filter_url?>" method="POST" enctype="multipart/form-data" tagret-tb="#propaccess">
		<div class="col-md-3 float-left mb-1">
			<div class="form-group">
				<label>Country</label>
				<select name="country" class="form-control sumbit-change" tagret-form=".dynamic-tb-search" id="country" >
					<?=$countries?>
				</select>
			</div>
		</div>
		<div class="col-md-3 float-left mb-1">
			<div class="form-group">
				<label>State</label>
				<select name="state" class="form-control sumbit-change" tagret-form=".dynamic-tb-search" id="state" >
					<option value=""> -- Select -- </option>
				</select>
			</div>
		</div>
		<div class="col-md-3 float-left mb-1">
			<div class="form-group">
				<label>City</label>
				<select name="city" class="form-control sumbit-change" tagret-form=".dynamic-tb-search" id="city" >
					<option value=""> -- Select -- </option>
				</select>
			</div>
		</div>
		<div class="col-md-3 float-left mb-1">
			<div class="form-group">
				<label>Search In Table</label>
				<input name="search" class="form-control sumbit-input" tagret-form=".dynamic-tb-search" type="text"  placeholder="Property Name" >
				
				<!-- <input class="form-control static-tb-search mb-1 float-right" type="text" placeholder="Search Property...." tbtarget="#propaccess"> -->
			</div>
		</div>
	</form>
	<div class="col-md-12 table-responsive">
		
		
		
		<table class="table table-striped table-bordered base-styl propaccess">
			<thead>
				<tr>
					<th>Select</th>
					<th>Name ( Code )</th>
					<th>City, State, Country</th>
					<th>Address</th>

				</tr>
			</thead>
			<tbody id="propaccess">
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
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$('.propaccess #apropnaster').change(function(event){
		$this = $(this);
		var id = $this.val();
		if (event.currentTarget.checked) {
			var type = 'set';  
	   }
	   else{
	   	var type = 'remove';
	   }
	   $.post('<?=base_url()?>host_m/host/propaccess/<?=$host_id?>',{p_id:id,type:type})
		.done(function(data){
			// console.log(data);
			data = JSON.parse(data);
			alert_toastr(data.res,data.msg);
			if (data.res=='success') {
				loadtb();
			}
		})
  })

	$('#country').change(function() {
        var id = $(this).val();
        $('#state').load('<?=base_url()?>getStates/'+id);
    })

    $('#state').change(function() {
        var id = $(this).val();
        $('#city').load('<?=base_url()?>getCities/'+id);
    })
</script>