<div class="card-content collapse show">
    <div class="card-body">
                                    

    <!-- form -->
    <form class="form ajaxsubmit reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">
        <div class="col-6 form-group" >
            <label for="">Select Clinic</label>
            <select name="clinic_id" id="clinic_id" class="form-control clinic_id" required>
                <option value="">--Select--</option>
                <?php foreach($clinics as $clinic):?>
                <option value="<?=$clinic->id;?>"><?=$clinic->name;?> ( <?=$clinic->code;?> )</option>
                <?php endforeach;?>
            </select>
           </div>
           <div class="col-6 form-group">
    <label for="">Attach File</label>
    <input type="file" name="file[]" id="" class="form-control" multiple>
</div>

       <!-- <input type="hidden" name="clinic_id" value="<?//=@$user->id;?>"> -->
       <p id="patients_id"></p>
            <div class="form-group mb-2">
            <div class="search-style-2  col-12 mb-2">
                                <input type="text" placeholder="Search for patients - name/code/mobile ..." id="search-box" class="form-control col-12" />
                              <div id="result" class="search-result-box shadow-sm border-0 w-100" >
		            	     </div>
                            </div>
                
            </div>
            <br>  <br>
            <h4 class="ml-2" style="background-color:grey;color:#fff;margin-top: 56px;height :56px;width:95%;display:none" id="patientsname"></h4>
           <div class="col-6 form-group" >
            <label for="">Select Date</label>
            <input type="date" class="form-control appointment_date" id="dateInput" min="<?= date('Y-m-d') ?>" oninput="validateDate(this)" name="appointment_date">
           </div>
           <div class="col-6 form-group" >
            <label for="">Select Appointment Type</label>
            <select name="appointment_type" id="appointment_type" class="form-control appointment_type" required>
                <option value="">--Select Appointment Type--</option>
                <option value="1">Online</option>
                <option value="2">Face To Face</option>
                <option value="3">Medicine Only</option>
            </select>
           </div>
           <div class="col-6 form-group" >
            <label for="">Select Start Time</label>
            <input type="time" id="timeInput"   oninput="validateDateTime(this)" class="form-control" name="appointment_start_time">
           </div>
           <div class="col-6 form-group" >
            <label for="">Select End Time</label>
            <input type="time" class="form-control" id="appointment_end_time" name="appointment_end_time" readonly>
            <a href="<?=base_url();?>view-all-time-slot" target="_blank" class="btn btn-sm btn-primary float-right mt-1 timeslot" id="timeslot" style="display: none;">view booked slot</a>
           </div>
           <div class="col-12 form-group" >
            <label for="">Enter Remark</label>
            <textarea class="form-control" name="clinic_remark"></textarea>
           </div>
        </div>
        <div class="row pt-1 pb-1">
           <div class="col-md-3 payment_mode_">
            <div class="form-group">
                <label for="discount_amount">Payment Mode <sup>*</sup></label>
                <select autocomplete="random-value" name="payment_mode" id="payment_mode" class="form-control payment_mode" >
                    <option value="">-- Select --</option>
                    <option value="1">Cash</option>
                    <option value="2">Online</option>
                    <option value="3">Partial Payment</option>
                </select>
            </div>

        </div>
       <input type="hidden" id="app_type" class="app_type">
       <div class="col-md-3 online_amount d-none">
            <div class="form-group">
                <label for="online_amount">Enter Online Amount</label>
                <input autocomplete="random-value" type="number" class="form-control" id="online_amount" placeholder="Enter online amount" name="online_amount" >
            </div>
        </div>
        <div class="col-md-3 cash_amount d-none">
            <div class="form-group">
                <label for="cash_amount">Enter Cash Amount</label>
                <input autocomplete="random-value" type="number" class="form-control" id="cash_amount" placeholder="Enter cash amount" name="cash_amount" >
            </div>
        </div>
        <div class="col-md-3 reference_id d-none">
            <div class="form-group">
                <label for="reference_id">Enter Reference Number</label>
                <input autocomplete="random-value" type="text" class="form-control" id="reference_id" placeholder="Reference Number" name="reference_id" >
            </div>
        </div>
        <div class="col-md-5 float-right" style="float: right;">
        <input type="hidden" class="fees" name="fees" id="fees">
          <h4 id="rupee" class="mt-3"></h4>
        </div>
        </div>
        <div class="form-actions text-right">
            <button type="reset" data-dismiss="modal" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Cancel
            </button>
            <button type="submit" id="btn-submit" class="btn btn-primary mr-1"  >
                <i class="ft-check"></i> Save
            </button>
        </div>
    </form>
    <!-- End: form -->

                                </div>
                            </div>
<?php if(@$row->product_id): ?>
<script type="text/javascript">
    setTimeout(function() {
        $('select[name=product_id]').change();
    }, 500);
    
</script>
<?php endif; ?>
<script>


$(document).ready(function(){
		$("#search-box").keyup(function(){
            var clinic = $('#clinic_id').val();
            var searchBoxValue = $('#search-box').val();

            if (clinic === '' || clinic === undefined || searchBoxValue === '') {
                alert_toastr('error', 'Please select a clinic and enter a search term.');
                $("#result").fadeOut();
                $( "#search-box" ).val('');
                return;
            }

	        if($( "#search-box" ).val() == '')
	        {
	            $("#result").fadeOut();
	            return
	        }
			$.ajax({
				url: '<?=base_url()?>Appointments/autocompleteData',
				method: 'POST',
				datatype: 'json',
				data: {clinic:clinic,search:$( "#search-box" ).val()},
				success: function (data) {
				var ele = '';
                var patients_id='';
				$.each(JSON.parse(data), function(index,value){
				    ele = ele + `<a class="dropdown-item" id="dropdown" style="background-color:grey;color:#fff" onclick="return fetch_patient('${value.name}');">${value.name}</a>`;
                    patients_id=patients_id+`<input type="hidden" name="patient_id" id="patient_id" value="${value.id}">`;
				});
				$("#result").fadeIn();
				$('#result').html(ele);
                $('#patients_id').html(patients_id);
				$("#main-body").click(function(){
				    $("#result").fadeOut();
				    return
				 });
				}
			});
		});
    });
    function fetch_patient(name)
   {
    $('#patientsname').show();
   $('#patientsname').text(name);  
   $('.dropdown-item').hide();
   var inputElement = document.getElementById('search-box');

// Reset the value to an empty string
if (inputElement) {
  inputElement.value = '';
}
   }



    function validateDate(input) {
       
      var currentDate = new Date();
      var selectedDate = new Date(input.value);

      // Set the minimum allowed date to today
      var minDate = currentDate.toISOString().split('T')[0];
      input.setAttribute('min', minDate);
      $("#timeslot").css('display','block');
      // Check if the selected date is in the past
      if (selectedDate < currentDate) {
        // Reset the input value to today's date
        input.value = minDate;
       $("#timeslot").css('display','block');
      }
    }
    document.getElementById('timeInput').addEventListener('change', function() {
    
    var selectedDate = this.value;
    var dateInput = $("#dateInput").val();
    var appointment_type = $("#app_type").val();
    var treatment_id = $(".treatment_id").val();
    if(dateInput !=''){
    if(appointment_type !=''){
    if (selectedDate) {
        $.post('<?=base_url()?>appointments/get_app_time/', { time: selectedDate,id:treatment_id })
            .done(function(data) {
                // Assuming the server returns a numeric value for addtime
                var addtime = parseInt(data, 10);

                // Ensure addtime is a valid number
                if (!isNaN(addtime)) {
                    var originalTime = selectedDate;
                    var newTime = addMinutesToTime(originalTime, addtime);
                    $('#appointment_end_time').val(newTime);
                    $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('appointments/validate_times'); ?>",
                    data: { start_time: originalTime, end_time: newTime },
                    success: function(response){
                        if(response=='1')
                        {
                            var appointment_end_time = document.getElementById('appointment_end_time');
                            appointment_end_time.value = '';
                            var timeInput2 = document.getElementById('timeInput');
                            timeInput2.value = '';
                            alert_toastr("error", "Sorry this time range slot not available");  
                        }
                    }
                });
                } else {
                    alert_toastr("error", "Invalid data received from the server");
                }
            })
            .fail(function() {
                alert_toastr("error", "Error during AJAX request");
            });
       }
      }else
      {
        var timeInput = document.getElementById('timeInput');
        timeInput.value = '';
        alert_toastr("error", "Please select appoinement type than select start time.");
      }
       
     }else
     {
        var timeInput = document.getElementById('timeInput');
        timeInput.value = '';
        alert_toastr("error", "Please select date than select start time.");
     }
});
    function addMinutesToTime(timeString, minutesToAdd) {
    // Parse the input time string to get hours and minutes
    var parts = timeString.split(':');
    var hours = parseInt(parts[0], 10);
    var minutes = parseInt(parts[1], 10);

    // Create a new Date object with the current date and specified time
    var dateObj = new Date();
    dateObj.setHours(hours);
    dateObj.setMinutes(minutes);

    // Add the specified minutes
    dateObj.setMinutes(dateObj.getMinutes() + minutesToAdd);

    // Format the result
    var resultHours = dateObj.getHours();
    var resultMinutes = dateObj.getMinutes();

    // Ensure leading zeros if needed
    resultHours = (resultHours < 10 ? '0' : '') + resultHours;
    resultMinutes = (resultMinutes < 10 ? '0' : '') + resultMinutes;

    // Return the formatted result
    return resultHours + ':' + resultMinutes;
}

// Example usage


  </script>
