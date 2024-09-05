<div class="card-content collapse show">
    <div class="card-body">
                                    

    <!-- form -->
    <form class="form ajaxsubmit reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
        <div class="form-body w-100">

           
            
            <div class="form-group col-6 pl-0">
                <label for="meeting_slot_duration">Meeting Slot Duration ( Minutes )</label>
                <input type="text" class="form-control" placeholder="Meeting Slot Duration ( Minutes )" name="meeting_slot_duration" value="<?=@$row->meeting_slot_duration?>" >
                <label class="error text-danger"></label>
            </div>

            <div class="form-group col-6 pr-0">
                <label for="name">Appointment Fee</label>
                <input type="number" class="form-control" placeholder="Appointment Fee" name="appointment_fee" value="<?=@$row->appointment_fee?>" step="0.01" >
                <label class="error text-danger"></label>
            </div>

            <div class="form-group col-6 pl-0">
                <label for="name">Face to Face Appointment Fee</label>
                <input type="number" class="form-control" placeholder="Face to Face Appointment Fee" name="face_to_face_appointment_fee" value="<?=@$row->face_to_face_appointment_fee?>" step="0.01" >
                <label class="error text-danger"></label>
            </div>

           

          

        </div>

        <div class="form-actions text-right">
            <button type="reset" data-dismiss="modal" class="btn btn-danger mr-1">
                <i class="ft-x"></i> Reset
            </button>
            <button type="submit" class="btn btn-primary mr-1"  >
                <i class="ft-check"></i> Update
            </button>
        </div>
    </form>
    <!-- End: form -->

                                </div>
                            </div>

