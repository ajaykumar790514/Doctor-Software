<div class="card-content collapse show">
    <div class="card-body">
    <form class="form ajaxsubmit reload-tb" action="<?=$action_url?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="appintment_id" value="<?=$row->id?>">
    <div class="row p-0">
        <div class="col-md-12 p-0">
            
        </div>
        <div class="col-md-6 p-0">
            <table class="w-100">
                <tbody>
                    <tr>
                        <th>Patient Name</th>
                        <td> : </td>
                        <td><?=$row->patient_name?></td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td> : </td>
                        <td><?=$row->age?></td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td> : </td>
                        <td><?=$row->gender?></td>
                    </tr>
                     <tr>
                        <th>Marital Status</th>
                        <td> : </td>
                        <td><?=$row->marital_status?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6 p-0">
            <table class="w-100">
                <tbody>
                    <tr>
                        <th>Mobile</th>
                        <td> : </td>
                        <td><?=$row->mobile?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td> : </td>
                        <td><?=$row->address?> - <?=$row->pincode?></td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td> : </td>
                        <td><?=$row->city?></td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td> : </td>
                        <td><?=$row->state?></td>
                    </tr>
                </tbody>
            </table>
        </div>
       
        <div class="col-md-12 p-0 mt-1">
            <!-- form -->
               
                <div class="form-body w-100">
                    <div class="col-12 p-0">
                        <div class="form-group col-md-6 pl-0 pr-0 pr-md-1">
                            <label for="parent_cat_id">Category</label>
                            <select class="form-control" name="parent_cat_id" >
                            <?php 
                            echo optionStatus('0','-- Select --',1);
                            foreach ($categories as $crow) { 
                                echo optionStatus($crow->id,$crow->name,$crow->active);
                                
                            } ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6 pr-0 pl-0 pl-md-1">
                            <label for="sub_cat_id">Sub Category</label>
                            <select class="form-control" name="sub_cat_id" >
                            <?php 
                            echo optionStatus('0','-- Select --',1);
                            foreach ($sub_categories as $scrow) { 
                                echo optionStatus($scrow->id,$scrow->name,$scrow->active);
                                
                            } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="product_id">Medicine</label>
                        <select class="form-control" name="product_id" >
                        <?php 
                        echo optionStatus('','-- Select --',1);
                        foreach ($products as $prow) { 
                            $selected = '';
                            if (@$row->product_id == $prow->id) {
                                $selected = 'selected';
                            }
                            echo optionStatus($prow->id,$prow->name,$prow->active,$selected);
                            
                        } ?>
                        </select>
                        <input type="hidden" name="clinic_id" value="<?=$row->clinic_id?>">

                    </div>
                    <div class="form-group text-center w-100" style="position:relative;float:left;height: 40px;">
                        <span class="current-qty d-none">Current Total Quantity - <span></span></span>
                        <button type="button" class="btn btn-primary btn-sm d-flex align-items-center add-medicine" style="position: absolute;right: 0;">
                            <i class="la la-plus-circle"></i>&nbsp;Add Medicine
                        </button>
                    </div>

                   <style type="text/css">
                        .medicines-tb{
                            width: 100%;
                        }
                        .medicines-tb tbody>tr>td{
                            vertical-align: middle;
                        }
                        .medicines-tb thead>tr>th:nth-child(1){
                            width: 40%;
                            min-width: 250px;
                        }
                        .medicines-tb thead>tr>th:nth-child(2){
                            width: 20%;
                            min-width: 100px;
                        }
                        .medicines-tb thead>tr>th:nth-child(3){
                            width: 40%;
                            min-width: 250px;
                        }
                         .medicines-tb .remove-medicine{
                            color: var(--danger);
                        }
                   </style>
                   <script type="text/javascript">
                        $('.add-medicine').on('click',function() {
                            let product    = $(`[name="product_id"]`);
                            let product_id = $(`[name="product_id"]`).val();
                            if (product_id) {
                                let med_name = product.find(`option[value="${product_id}"]`).text();
                                let c_qty = parseInt($('.current-qty>span').text());
                                if (c_qty==0) {
                                    alert_toastr("error","Selected Medicine is Out of Stock!");
                                    return false;
                                }
                                if ($(`#tr_${product_id}`).length>0) {
                                    var q_input = $(`#tr_${product_id}`).find('[name="med_qty[]"]');
                                    q_input.val(parseInt(q_input.val())+1);
                                }
                                else{
                                    let html = `<tr id="tr_${product_id}">
                                                <td>
                                                    <input type="hidden" name="med_id[]" value="${product_id}">
                                                    ${med_name}
                                                    <a href="javascript:void(0)" class="remove-medicine">
                                                    <i class="la la-trash"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <input type="number" name="med_qty[]" class="form-control" value="1" min="0" max="${c_qty}">
                                                </td>
                                                <td>
                                                    <input type="text" name="med_remark[]" class="form-control" value="">
                                                </td>
                                            </tr>`;
                                    $('.medicines-tb').find('tbody').append(html);
                                }
                            }
                            else{
                                alert_toastr("error","No Medicine Selected!");
                            }
                        })

                        $('body').on('click','.remove-medicine',function() {
                            let _this = $(this);
                            Swal.fire({
                              toast:true,
                              type: 'warning',
                              title: 'You want to remove it ?',
                              timer:3000,
                              showConfirmButton: true,
                              showCancelButton: true,
                              confirmButtonText: `Yes`,
                              cancelButtonText: `No`,
                            }).then((result) => {
                                if(result.value==true){
                                    _this.parents('tr').find('[name="med_qty[]"]').val(0);
                                }
                            }).catch(swal.noop);
                        })
                   </script>

                    <div class="form-group">
                        <label for="">Medicines</label>
                        <div class="table-responsive">
                            <table class="medicines-tb table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:45%;min-width: ;">Medicine</th>
                                        <th style="width:10%">Quantity</th>
                                        <th style="width:45%">Remark</th>
                                    </tr>
                                </thead>

                                 <tbody>
                                    <?php if(@$medicines) { foreach ($medicines as $key => $value) { ?>
                                    <tr id="tr_<?=$value->medicine_id?>">
                                        <td>
                                            <input type="hidden" name="med_id[]" value="<?=$value->medicine_id?>">
                                            <?=$value->medicine_name?>
                                            <a href="javascript:void(0)" class="remove-medicine">
                                            <i class="la la-trash"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <input type="number" name="med_qty[]" class="form-control" value="<?=$value->qty?>" min="0" max="<?=$value->qty + $value->stock?>" >
                                        </td>
                                        <td>
                                            <input type="text" name="med_remark[]" class="form-control" value="<?=$value->remark?>" value="">
                                        </td>
                                    </tr>
                                    <?php } } ?>
                                </tbody>

                            </table>
                        </div>
                        <label class="error text-danger"></label>
                    </div> 

                    <div class="col-12 p-0">
                        <div class="form-group col-md-6 pl-0 pr-0 pr-md-1">
                            <label>Doctor Remark</label>
                            <textarea class="form-control" name="doc_remark"><?=$row->doc_remark?></textarea>
                        </div>

                        <div class="form-group col-md-6 pr-0 pl-0 pl-md-1">
                            <label >Clinic Remark</label>
                            <textarea class="form-control" name="clinic_remark"><?=$row->clinic_remark?></textarea>
                        </div>
                    </div> 

                    <div class="col-12 p-0">
                        <div class="form-group col-md-6 pl-0 pr-0 pr-md-1">
                            <label>Next Meeting date</label>
                            <input type="date" class="form-control" name="next_meeting_date" value="<?=$row->next_meeting_date?>">
                        </div>

                        <div class="form-group col-md-6 pr-0 pl-0 pl-md-1">
                            <label>Amount</label>
                            <input type="number" class="form-control" name="amount" value="<?=$row->amount?>">
                        </div>
                    </div> 

                     <div class="col-12 p-0">
                        <div class="form-group col-md-12 pl-0 pr-0 pr-md-1">
                            <label>Meeting Link</label>
                            <input type="text" class="form-control" name="meeting_link" value="<?=$row->meeting_link?>">
                            <label class="error text-danger"></label>
                        </div>
                    </div> 

                            

                    
                    
                  

                </div>

                <div class="form-actions text-right pb-0">
                    <button type="reset" data-dismiss="modal" class="btn btn-danger mr-1">
                        <i class="ft-x"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary mr-1"  >
                        <i class="ft-check"></i> Save
                    </button>
                </div>
            
            <!-- End: form -->
        </div>
    </div> 
    </form>                              

    

                                </div>
                            </div>

