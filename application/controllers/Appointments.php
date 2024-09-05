<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Main.php');
class Appointments extends Main {

	
	public function index($action=null,$id=null)
	{
		$data['user'] = $user 			= $this->checkLogin();
		$view_dir = 'appointments/';
		switch ($action) {
			case null:
				$data['title'] 			= 'Appointments';
				$data['contant'] 		= $view_dir.'index';
				$data['tb_url']	  		= current_url().'/tb';
				$data['clinics']	  	= $this->app_lib->clinics();
				$data['states']	  		= $this->app_lib->states(101);
				$data['cities']			= [];
				$data['new_url']	=  current_url().'/create_appointment';
				$data['patients']       = $this->model->getData('patients',['is_deleted'=>'NOT_DELETED']);
				$data['a_status']		= $this->app_lib->appointment_status();
				$this->template($data);
				break;

			case 'tb':
				$this->load->library('pagination');

				$data['contant'] 		= $view_dir.'tb';
				$config 				= array();
				$config["base_url"] 	= base_url()."appointments/tb";
				$config["total_rows"]  	= count($this->model->appointments($user));
				$data['total_rows']    	= $config["total_rows"];
				$config["per_page"]    	= 10;
				$config["uri_segment"] 	= 3;
				$config['attributes']  	= array('class' => 'pag-link ');
				$this->pagination->initialize($config);
				$data['links']   		= $this->pagination->create_links();
			    $data['page']    		= $page = ($id!=null) ? $id : 0;
			    $data['search']	 		= $this->input->post('search');
			    $data['update_url']		= base_url('appointments/create/');
			    $data['delete_url']		= base_url('appointments/delete/');
			    $data['pre_url']		= base_url('appointments/prescription/');
			    $data['tran_url']		= base_url('appointments/transactions/');
				$data['attatch_url']		= base_url('appointments/attatch_url/');
				$data['reschedule_app']		= base_url('appointments/reschedule_app/');
				$data['change_status_url']		= base_url('appointments/change_status_url/');
			    $data['rows']    		= $this->model->appointments($user,$config["per_page"],$page);
			    load_view($data['contant'],$data);
				break;

			case 'create':
				$data['title'] 		  	= 'New Inventory';
				$data['contant']      	= $view_dir.'create';
				$data['action_url']	  	= base_url('appointments/save');
				$data['categories']	  	= $this->app_lib->categories(0);
				$data['sub_categories']	= $this->app_lib->categories(NULL);
				$data['products']		= $this->app_lib->products();
				$data['unit_master']	= $this->app_lib->unit_master();
				if ($id!=null) {
					$data['row'] 		= $this->model->shops_inventory_row($id);
					$data['sub_categories']	= $this->app_lib->categories($data['row']->parent_cat_id);
					$data['action_url']	  	= base_url('appointments/update/'.$id);					
				}

				// echo _prx($data['sub_categories']);
				// echo _prx($data['row']);
				// die();

				// $this->pr($data);
				// $data['rows']   = $this->model->categories(0);
				load_view($data['contant'],$data);
				break;
               case 'attatch_url':
				$data['title'] 		  	= 'View Attatchment File';
				$data['attach']         = $this->model->getData('appointment_attachments',['appointment_id'=>$id]);
				$data['contant']      	= $view_dir.'attatchment_file';
				load_view($data['contant'],$data);
				break;
			case 'save':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					$main_clinic = $this->app_lib->main_clinic();
					if (!@$main_clinic) {
						$return['msg'] = 'Main Branch Not Assigned!';
						echo json_encode($return); die();
					}

					$_POST['shop_id'] 			= $main_clinic->id;
					$check_cond['product_id'] 	= $_POST['product_id'];
					$check_cond['shop_id'] 		= $_POST['shop_id'];
					$qty 						= $_POST['qty'];

					unset($_POST['parent_cat_id']);
					unset($_POST['sub_cat_id']);

					if ($inventory = $this->model->getRow('shops_inventory',$check_cond)) {
						$_POST['qty'] += $inventory->qty;
						if($this->model->Update('shops_inventory',$_POST,$check_cond)){
							$saved = 1;
						}
						$shops_inventory_id = $inventory->id;

					}else{
						if($insert_id = $this->model->Save('shops_inventory',$_POST)){
							$saved = 1;
							$shops_inventory_id = $insert_id;
						}
					}
					if ($saved == 1 ) {
						$log_data['product_id'] 		= $_POST['product_id'];
						$log_data['qty'] 				= $qty;
						$log_data['shop_id'] 			= $main_clinic->id;
						$log_data['action'] 			= 'LATEST_UPDATE';
						$log_data['shops_inventory_id'] = $shops_inventory_id; 
						$this->model->Save('shop_inventory_logs',$log_data);

						$return['res'] = 'success';
						$return['msg'] = 'Saved.';
					}
				}

				echo json_encode($return);
				break;

			case 'update':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;

				if ($this->input->server('REQUEST_METHOD')=='POST') {
					$main_clinic = $this->app_lib->main_clinic();
					if (!@$main_clinic) {
						$return['msg'] = 'Main Branch Not Assigned!';
						echo json_encode($return); die();
					}
					$row 						= $this->model->shops_inventory_row($id);
					$qty 						= $_POST['qty'];

					if($this->model->Update('shops_inventory',['qty'=>$qty],['id'=>$id])){
						$saved = 1;
					}


					if ($saved == 1 ) {
						$log_data['product_id'] 		= $row->product_id;
						$log_data['qty'] 				= $qty;
						$log_data['shop_id'] 			= $row->shop_id;
						$log_data['action'] 			= 'UPDATE';
						$log_data['shops_inventory_id'] = $id; 
						$this->model->Save('shop_inventory_logs',$log_data);
						if ($row->shop_id!=1) {
							$update_cond['product_id'] 	= $row->product_id;
							$update_cond['shop_id'] 	= 1;

							$inventory 	= $this->model->getRow('shops_inventory',$update_cond);
							$u['qty'] 	= $inventory->qty + ($row->qty - $qty);

							$this->model->Update('shops_inventory',$u,$update_cond);
						}						

						$return['res'] = 'success';
						$return['msg'] = 'Saved.';
					}
				}

				echo json_encode($return);
				break;

			case 'prescription':
				// echo $id;
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				$row 		= $this->model->appointment($id);
				
				// echo _prx($row); die();
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					// $this->form_validation->set_rules('meeting_link', 'Meeting Link', 'required');
					$this->form_validation->set_rules('meeting_link', 'Meeting Link', 'valid_url');
					if ($this->form_validation->run() !== FALSE)
	                {
						$post = $this->input->post();
						if(@$post['med_qty']) : 
							foreach ($post['med_id'] as $key => $value) {
								if (@$post['med_qty'][$key]) {
									$prescription[$key]['appintment_id'] 	= $post['appintment_id'];
									$prescription[$key]['medicine_id'] 		= $post['med_id'][$key];
									$prescription[$key]['qty'] 				= $post['med_qty'][$key];
									$prescription[$key]['remark'] 			= $post['med_remark'][$key];
								}

								// $check['appintment_id'] = $post['appintment_id'];
								// $check['medicine_id'] 	= $post['med_id'][$key];
								// $old_pre = $this->model->getRow('prescription',$check);

								// $inventory_array[$key]['product_id'] 	= $post['med_id'][$key];
								// $inventory_array[$key]['shop_id'] 		= $row->clinic_id;
								// $qty = (@$old_pre) ? $post['med_qty'][$key] - $old_pre->qty : $post['med_qty'][$key];

								// $inventory_check['shop_id'] 	= $row->clinic_id;
								// $inventory_check['product_id'] 	= $post['med_id'][$key];
								// $inventory = $this->model->getRow('shops_inventory',$inventory_check);

								// $inventory_array[$key]['qty'] = $inventory->qty - $qty;
							}
						endif;

						$status = 4;

						if (!@$post['med_qty'] && @$post['meeting_link']) {
							$status = 5;
						}

						$update_array['doc_remark'] 		= $post['doc_remark'];
						$update_array['clinic_remark'] 		= $post['clinic_remark'];
						$update_array['next_meeting_date'] 	= $post['next_meeting_date'];
						$update_array['meeting_link'] 		= $post['meeting_link'];
						$update_array['amount'] 			= $post['amount'];
						$update_array['status'] 			= $status;

						$this->db->trans_begin();

						$this->db->where('appintment_id',$post['appintment_id']);
						$this->db->delete('prescription');
						if (@$prescription) {
							$this->db->insert_batch('prescription',$prescription);
						}
							
						$this->db->where('id',$post['appintment_id']);
						$this->db->update('appointments',$update_array);
						// if(@$inventory_array) : 
						// 	foreach ($inventory_array as $key => $value) {
						// 		$i_check['shop_id'] 		= $value['shop_id'];
						// 		$i_check['product_id'] 		= $value['product_id'];
						// 		$inventory_update['qty']	= $value['qty'];
						// 		$this->db->where($i_check);
						// 		$this->db->update('shops_inventory',$inventory_update);
						// 	}
						// endif;


						if ($this->db->trans_status() === FALSE)
						{
						    $this->db->trans_rollback();
						}
						else
						{
						    $this->db->trans_commit();
						    $saved = 1;
						}
						
						if ($saved == 1 ) {
							$return['res'] = 'success';
							$return['msg'] = 'Saved.';
						}
					}
	                else
	                {
	                    $return['errors'] = $this->form_validation->error_array();
	                }
					// echo json_encode($row);
					echo json_encode($return);
				}
				else{
					$data['categories']	  	= $this->app_lib->categories(0);
					$data['sub_categories']	= $this->app_lib->categories(NULL);
					$data['products']		= $this->app_lib->products();
					$data['contant']      	= $view_dir.'prescription';
					$data['row']      		= $row;
					$data['medicines']  	= $this->model->appointment_medicines($id);
					// echo _prx($row); die();
					$data['action_url']	  	= base_url('appointments/prescription/'.$id);
					$data['report_url']		= base_url('reports/prescription?client_code=');
					$data['fetch_medicine_url']		= base_url("appointments/fetch_medicine/$id?patient_id=");
					load_view($data['contant'],$data);
					// echo _prx($clinics);
				}
				break;

			case 'transactions':
				$data['rows']  		= $this->model->appointment_transactions($id);
				$data['contant']    = $view_dir.'transactions';
				load_view($data['contant'],$data);


				// echo _prx($data['rows']); die();
				// echo $id;
				break;

			case 'fetch_medicine':
				$appointment_id = $id;
				$patient_id 	= $_GET['patient_id'];

				$this->db->select('id');
				$this->db->from('appointments');
				$this->db->where('id !=',$appointment_id);
				$this->db->where('patient_id',$patient_id);
				$this->db->order_by('appointment_date','DESC');
				$appointment = $this->db->get()->row();
				if (@$appointment) {
					$last_app_id = $appointment->id;
					$medicines = $this->model->appointment_medicines($last_app_id);
				}
				if(@$medicines) { 
					foreach ($medicines as $key => $value) { ?>
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
	                <?php } 
	            }
	            
				break;
				case 'create_appointment':
					$validate = checkClinicOpen($user->id);	
					if($validate){
					echo "<h3 class='text-danger text-center'>Clinic Not Open Today</h3>";
					die();
					}
					$data['title'] 		  	= 'New Inventory';
					$data['contant']      	= $view_dir.'create_appointment';
					$data['action_url']	  	= base_url('appointments/save_appointment');
					$data['categories']	  	= $this->app_lib->categories(0);
					$data['sub_categories']	= $this->app_lib->categories(NULL);
					$data['products']		= $this->app_lib->products();
					$data['unit_master']	= $this->app_lib->unit_master();
					$data['patients']       = $this->model->getData('patients',['is_deleted'=>'NOT_DELETED']);
					$data['clinics']       = $this->model->getData('clinics',['is_deleted'=>'NOT_DELETED']);
					$data['payment_mode']       = $this->model->getData('payment_mode_master',['is_deleted'=>'NOT_DELETED']);
					if ($id!=null) {
						$data['row'] 		= $this->model->shops_inventory_row($id);
						$data['sub_categories']	= $this->app_lib->categories($data['row']->parent_cat_id);
						$data['action_url']	  	= base_url('appointments/update_appointment/'.$id);	
						$data['patients']       = $this->model->getData('patients',['is_deleted'=>'NOT_DELETED']);				
					}
					load_view($data['contant'],$data);
					break;
					case 'get_app_fee':
						if($_POST['type']==1){		
						$rs = $this->model->getRow('general_master',['id'=>'1']);		
						echo $rs->appointment_fee;
						}else
						if($_POST['type']==2){		
						 $rs = $this->model->getRow('general_master',['id'=>'1']);		
						echo $rs->face_to_face_appointment_fee;
						}else{
							echo 0;
						}
					   break;
					   case 'get_treatment_fee':
						if(isset($_POST['id'])){		
						 $rs = $this->model->getRow('treatment_master',['id'=>$_POST['id']]);		
						echo @$rs->appointment_advance;
						}else{
							echo 0;
						}
					   break;
					   
					   case 'get_app_time':
						if(!empty($_POST['id']))
						{
							$rs = $this->model->getRow('treatment_master',['id'=>$_POST['id']]);		
							echo $rs->duration;
						}else{
						if($_POST['time']){		
						 $rs = $this->model->getRow('general_master',['id'=>'1']);		
						echo $rs->meeting_slot_duration;
						}else{
							echo '00:00';
						}
					   }
					   break;
							   
					   case 'attatch_url':
						$data['title'] 		  	= 'View Attatchment File';
						$data['attach']         = $this->model->getData('appointment_attachments',['appointment_id'=>$id]);
						$data['contant']      	= $view_dir.'attatchment_file';
						load_view($data['contant'],$data);
						break;
						case 'save_appointment':
							$validate = checkClinicOpen($user->id);	
							if($validate){
								$return['res'] = 'error';
								$return['msg'] = 'Clinic Not Open Today';
								echo json_encode($return);
							die();
							}	
						$return['res'] = 'error';
						$return['msg'] = 'Not Saved!';
						$saved = 0;
						if ($this->input->server('REQUEST_METHOD')=='POST') {
							if ($id!=null) {
								$timevalidate = checkTimeClinic($this->input->post('clinic_id'),$this->input->post('appointment_start_time'),$this->input->post('appointment_end_time'));
								if($timevalidate==1){
									 // Get the selected date and time from the form
									 $selectedDate = $this->input->post('appointment_date');
									 $selectedTime = $this->input->post('appointment_start_time');
							 
									 $currentDate = date('Y-m-d');
									 $currentTime = date('H:i:s');
									 if ($selectedDate == $currentDate && $selectedTime < $currentTime) {
										 // If selected date is current date and time is in the past
										 $return['res'] = 'error';
										 $return['msg'] = 'Cannot select any past time please select future time.';
										 echo json_encode($return);die();
									 } 
								    $data = array(
									'appointment_type'=>$this->input->post('appointment_type'),
									'patient_id'=>$this->input->post('patient_id'),
									'clinic_id'=>$this->input->post('clinic_id'),
									'appointment_date'=>$this->input->post('appointment_date'),
									'appointment_start_time'=>$this->input->post('appointment_start_time'),
									'appointment_end_time'=>$this->input->post('appointment_end_time'),
									'clinic_remark'=>$this->input->post('clinic_remark'),
									'amount'=>$this->input->post('fees'),
									'status'=>'1',
									);
								if($this->model->Update('appointments',$data,['id'=>$id])){
									$saved = 1;
								}
							}else{
								$return['res'] = 'error';
								$return['msg'] = 'Please enter correct clinic timing.';
							  }
							}
							else{
								 $timevalidate = checkTimeClinic($this->input->post('clinic_id'),$this->input->post('appointment_start_time'),$this->input->post('appointment_end_time'));
								 if($timevalidate==1){
									   // Get the selected date and time from the form
									   $selectedDate = $this->input->post('appointment_date');
									   $selectedTime = $this->input->post('appointment_start_time');
									   $selectedTimeEnd = $this->input->post('appointment_end_time');
							   
									   $currentDate = date('Y-m-d');
									   $currentTime = date('H:i:s');
									   if ($selectedDate == $currentDate && $selectedTime < $currentTime) {
										   // If selected date is current date and time is in the past
										   $return['res'] = 'error';
										   $return['msg'] = 'Cannot select any past time please select future time.';
										   echo json_encode($return);die();
									   } 
								if (is_time_slot_available($this->input->post('clinic_id'),$selectedTime, $selectedTimeEnd, $selectedDate)) {
									} else {
									$return['res'] = 'error';
									$return['msg'] = 'Time slot is not available, it clashes with existing appointments.';
									echo json_encode($return);die();
											}
								$app_type  =  $this->input->post('appointment_type');
								if($app_type==1 || $app_type==2){
								 if($this->input->post('payment_mode')=='3'){
                                    if(($this->input->post('online_amount')+$this->input->post('cash_amount')) != $this->input->post('fees'))
									{
										$return['res'] = 'error';
										$return['msg'] = 'Cash amount or Online amount not equal to appointment fees.';
										echo json_encode($return);die();
									}
								 }
								}
								$data = array(
								'appointment_type'=>$this->input->post('appointment_type'),
								'patient_id'=>$this->input->post('patient_id'),
								'clinic_id'=>$this->input->post('clinic_id'),
								'appointment_date'=>$this->input->post('appointment_date'),
								'appointment_start_time'=>$this->input->post('appointment_start_time'),
								'appointment_end_time'=>$this->input->post('appointment_end_time'),
								'clinic_remark'=>$this->input->post('clinic_remark'),
								'amount'=>$this->input->post('fees'),
								'status'=>'1',
								);
								if($p_id = $this->model->Save('appointments',$data)){
									$saved = 1;
									if($app_type==1 || $app_type==2){
								    if($this->input->post('payment_mode')=='3'){
									$onlineMode = $this->model->getRow('payment_mode_master',['active'=>'1','name'=>'Online']);	
									$CashMode = $this->model->getRow('payment_mode_master',['active'=>'1','name'=>'Cash']);			
									$transaction1['transaction_head'] = '1';
									$transaction1['appointment_id'] = $p_id;
									$transaction1['payment_mode'] =$onlineMode->id;
									$transaction1['payment_status'] = '1';
									$transaction1['payment_ref_no'] = $this->input->post('reference_id') ?? '';
									$transaction1['amount'] = $this->input->post('online_amount');
									$transaction1['date'] = date('Y-m-d');
									$this->model->Save('transactions',$transaction1);
									$transaction2['transaction_head'] = '1';
									$transaction2['appointment_id'] = $p_id;
									$transaction2['payment_mode'] = $CashMode->id;
									$transaction2['payment_status'] = '1';
									$transaction2['payment_ref_no'] = $this->input->post('reference_id') ?? '';
									$transaction2['amount'] = $this->input->post('cash_amount');
									$transaction2['date'] = date('Y-m-d');
									$this->model->Save('transactions',$transaction2);
									}elseif($this->input->post('payment_mode')=='2'){
									$transaction['transaction_head'] = '1';
									$transaction['appointment_id'] = $p_id;
									$transaction['payment_mode'] = $this->input->post('payment_mode');
									$transaction['payment_status'] = '1';
									$transaction['payment_ref_no'] = $this->input->post('reference_id') ?? '';
									$transaction['amount'] = $this->input->post('fees');
									$transaction['date'] = date('Y-m-d');
									$this->model->Save('transactions',$transaction);
									}else{
									$transaction['transaction_head'] = '1';
									$transaction['appointment_id'] = $p_id;
									$transaction['payment_mode'] = $this->input->post('payment_mode');
									$transaction['payment_status'] = '1';
									$transaction['payment_ref_no'] = $this->input->post('reference_id') ?? '';
									$transaction['amount'] = $this->input->post('fees');
									$transaction['date'] = date('Y-m-d');
									$this->model->Save('transactions',$transaction);
									}
								  }elseif($app_type==3){
									$transaction['transaction_head'] = '1';
									$transaction['appointment_id'] = $p_id;
									$transaction['payment_mode'] = '5';
									$transaction['payment_status'] = '1';
									$transaction['payment_ref_no'] = $this->input->post('reference_id') ?? '';
									$transaction['amount'] = '0';
									$transaction['date'] = date('Y-m-d');
									$this->model->Save('transactions',$transaction);
								  }
									$imageCount = count($_FILES['file']['name']);
									if (!empty($imageCount)) {
										for ($i = 0; $i < $imageCount; $i++) {
											$config['file_name'] = date('Ymd') . rand(1000, 1000000);
											$config['upload_path'] = UPLOAD_PATH.'attatchment/';
											$config['allowed_types'] = 'jpg|jpeg|png|gif|webp|svg|pdf';
											$this->load->library('upload', $config);
											$this->upload->initialize($config);
											$_FILES['files']['name'] = $_FILES['file']['name'][$i];
											$_FILES['files']['type'] = $_FILES['file']['type'][$i];
											$_FILES['files']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
											$_FILES['files']['size'] = $_FILES['file']['size'][$i];
											$_FILES['files']['error'] = $_FILES['file']['error'][$i];
				
											if ($this->upload->do_upload('files')) {
												$imageData = $this->upload->data();
											   if($_FILES['files']['type']=='image/webp')
													{
													   echo UPLOAD_PATH.'attatchment/'.$imageData['file_name'];
															$img =  imagecreatefromwebp(UPLOAD_PATH.'attatchment/'. $imageData['file_name']);
															imagepalettetotruecolor($img);
															imagealphablending($img, true);
															imagesavealpha($img, true);
															imagedestroy($img);
													}
													else
													{
														$config2 = array(
															'image_library' => 'gd2', //get original image
															'source_image' =>   UPLOAD_PATH.'attatchment/'. $imageData['file_name'],
															'width' => 640,
															'height' => 360,
														);
														$this->load->library('image_lib');
														$this->image_lib->initialize($config2);
														$this->image_lib->resize();
														$this->image_lib->clear();
													}
												$images[] = "attatchment/" . $imageData['file_name'];
												
											}
										}
									}
									if (!empty($images)) {      
										foreach ($images as $file) {
											$file_data = array(
												'file' => $file,
												'appointment_id' => $p_id
											);
											$this->db->insert('appointment_attachments', $file_data);
										}                        
									}
									
								}
							  }else{
								$return['res'] = 'error';
								$return['msg'] = 'Please enter correct clinic timing because clinic timing exceeded.';
							  }
							}
		
							if ($saved == 1 ) {
								$return['res'] = 'success';
								$return['msg'] = 'Saved.';
							}
						}
		
						echo json_encode($return);
			 break;
			 case 'change_status_url':
				$data['title'] 		  	= 'Change Status';
				$data['action_url']	  	= base_url('appointments/change_status_save/'.$id);
				$data['contant']      	= $view_dir.'cancel_app';
				load_view($data['contant'],$data);
				break;	
				case 'change_status_save':
					$return['res'] = 'error';
					$return['msg'] = 'Not Saved!';
					$saved = 0;
					if ($this->input->server('REQUEST_METHOD')=='POST') {
						if ($id!=null) {
							$data = array(
								'status'=>'2',
								'cancel_remark'=>$this->input->post('remark'),
								);
							if($this->model->Update('appointments',$data,['id'=>$id])){
								$saved = 1;
							}
						}
						if ($saved == 1 ) {
							$return['res'] = 'success';
							$return['msg'] = 'Appointment cancellation successfull.';
						}
					}
	
					echo json_encode($return);
			break;
			case 'reschedule_app':
			$validate = checkClinicOpen($user->id);	
			if($validate){
			echo "<h3 class='text-danger text-center'>Clinic Not Open Today</h3>";
			die();
			}
			$data['title'] 		  	= 'New Inventory';
			$data['contant']      	= $view_dir.'reschedule';
			$data['payment_mode']       = $this->model->getData('payment_mode_master',['is_deleted'=>'NOT_DELETED']);
			$data['clinics']       = $this->model->getData('clinics',['is_deleted'=>'NOT_DELETED']);
			$data['row'] 		= $this->model->getRow('appointments',['id'=>$id]);
			$data['action_url']	  	= base_url('appointments/reschedule/'.$id);	
			$data['patients']       = $this->model->getRow('patients',['is_deleted'=>'NOT_DELETED',
			'id'=>$data['row']->patient_id]);	
			$data['tran']       = $this->model->getRow('transactions',['is_deleted'=>'NOT_DELETED',
			'appointment_id'=>$data['row']->id]);
			$data['general_master']   = $this->model->getRow('general_master',['clinic_id'=>$user->id]);
			load_view($data['contant'],$data);
			break;		
			case 'reschedule':
				$validate = checkClinicOpen($user->id);	
				if($validate){
					$return['res'] = 'error';
					$return['msg'] = 'Clinic Not Open Today';
					echo json_encode($return);
				die();
				}	
			$return['res'] = 'error';
			$return['msg'] = 'Not Saved!';
			$saved = 0;
			if ($this->input->server('REQUEST_METHOD')=='POST') {
				if ($id!=null) {
					$timevalidate = checkTimeClinic($this->input->post('clinic_id'),$this->input->post('appointment_start_time'),$this->input->post('appointment_end_time'));
					if($timevalidate==1){
						$rs = $this->model->getRow('appointments',['id'=>$id]);
						$reschedule_count = $rs->reschedule_count+1;
                          
						   // Get the selected date and time from the form
						   $selectedDate = $this->input->post('appointment_date');
						   $selectedTime = $this->input->post('appointment_start_time');
						   $selectedTimeEnd = $this->input->post('appointment_end_time');
				   
						   $currentDate = date('Y-m-d');
						   $currentTime = date('H:i:s');
						   if ($selectedDate == $currentDate && $selectedTime < $currentTime) {
							   // If selected date is current date and time is in the past
							   $return['res'] = 'error';
							   $return['msg'] = 'Cannot select any past time please select future time.';
							   echo json_encode($return);die();
						   } 
						if (is_time_slot_available($this->input->post('clinic_id'),$selectedTime, $selectedTimeEnd, $selectedDate)) {
						} else {
							$return['res'] = 'error';
							$return['msg'] = 'Time slot is not available, it clashes with existing appointments.';
							echo json_encode($return);die();
						}

					$data = array(
						'appointment_type'=>$this->input->post('appointment_type'),
						'patient_id'=>$this->input->post('patient_id'),
						'clinic_id'=>$this->input->post('clinic_id'),
						'appointment_date'=>$this->input->post('appointment_date'),
						'appointment_start_time'=>$this->input->post('appointment_start_time'),
						'appointment_end_time'=>$this->input->post('appointment_end_time'),
						'clinic_remark'=>$this->input->post('clinic_remark'),
						'amount'=>$this->input->post('fees'),
						'status'=>'1',
						'reschedule_count'=>$reschedule_count,
						);
					if($this->model->Update('appointments',$data,['id'=>$id])){
						$saved = 1;
						$imageCount = count($_FILES['file']['name']);
						if (!empty($imageCount)) {
							for ($i = 0; $i < $imageCount; $i++) {
								$config['file_name'] = date('Ymd') . rand(1000, 1000000);
								$config['upload_path'] = UPLOAD_PATH.'attatchment/';
								$config['allowed_types'] = 'jpg|jpeg|png|gif|webp|svg|pdf';
								$this->load->library('upload', $config);
								$this->upload->initialize($config);
								$_FILES['files']['name'] = $_FILES['file']['name'][$i];
								$_FILES['files']['type'] = $_FILES['file']['type'][$i];
								$_FILES['files']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
								$_FILES['files']['size'] = $_FILES['file']['size'][$i];
								$_FILES['files']['error'] = $_FILES['file']['error'][$i];
	
								if ($this->upload->do_upload('files')) {
									$imageData = $this->upload->data();
								   if($_FILES['files']['type']=='image/webp')
										{
										   echo UPLOAD_PATH.'attatchment/'.$imageData['file_name'];
												$img =  imagecreatefromwebp(UPLOAD_PATH.'attatchment/'. $imageData['file_name']);
												imagepalettetotruecolor($img);
												imagealphablending($img, true);
												imagesavealpha($img, true);
												imagedestroy($img);
										}
										else
										{
											$config2 = array(
												'image_library' => 'gd2', //get original image
												'source_image' =>   UPLOAD_PATH.'attatchment/'. $imageData['file_name'],
												'width' => 640,
												'height' => 360,
											);
											$this->load->library('image_lib');
											$this->image_lib->initialize($config2);
											$this->image_lib->resize();
											$this->image_lib->clear();
										}
									$images[] = "attatchment/" . $imageData['file_name'];
									
								}
							}
						}
						if (!empty($images)) {  
							$this->db->where('appointment_id', $id);
                            $this->db->delete('appointment_attachments');    
							foreach ($images as $file) {
								$file_data = array(
									'file' => $file,
									'appointment_id' => $id
								);
								
								$this->db->insert('appointment_attachments', $file_data);
							}                        
						}
					}
				}else{
					$return['res'] = 'error';
					$return['msg'] = 'Please enter correct clinic timing.';
				  }
				}
				

				if ($saved == 1 ) {
					$return['res'] = 'success';
					$return['msg'] = 'Reschedule Successfully.';
				}
			}

			echo json_encode($return);
			break;
			case 'delete':
				$return['res'] = 'error';
				$return['msg'] = 'Not Deleted!';
				if ($id!=null) {
					if($this->model->_delete('shops_inventory',['id'=>$id])){
						$this->model->_delete('shop_inventory_logs',['shops_inventory_id'=>$id]);
						$saved = 1;
						$return['res'] = 'success';
						$return['msg'] = 'Successfully deleted.';
					}
				}
				echo json_encode($return);
				break;

			
			default:
				// code...
				break;
		}
		

		// $this->pr($data);
		// $this->template($data);
	}
	public function timeslot($action=null,$id=null)
	{
		$data['user'] = $user 			= $this->checkLogin();
		$view_dir = 'appointments/';
		switch ($action) {
			case null:
				$data['title'] 			= 'View All Slot Time';
				$data['currentdate']    = date('Y-m-d');
				$data['contant'] 		= 'appointments/viewslot';
				$data['app']       = $this->model->getData('appointments',['is_deleted'=>'NOT_DELETED','appointment_date'=>date('Y-m-d')]);
				$this->template($data);
				break;
			}
		}
		
		public function view_treatment()
		{
			
			$data['treatment']       = $this->model->getData('treatment_master',['is_deleted'=>'NOT_DELETED','active'=>'1']); 
		$this->load->view('appointments/treatment',$data);
		}
		public function viewTreatMent($action=null,$id=null)
		{
	
			$data['user'] = $user 			= $this->checkLogin();
			$view_dir = 'master/';
			switch ($action) {
				case 'details':
					$data['title'] 			= 'Treatment Details';
					$data['currentdate']    = date('Y-m-d');
					$data['contant'] 		= 'masters/treatment/details';
					$data['treatment']       = $this->model->getTreatmentDetail($id);
					$this->template($data);
					break;
				}
			}
	public function autocompleteData()
    {
        $data['user'] = $user 			= $this->checkLogin();
        $users = $user->id;  
        $search = $this->input->post('search');
		$clinic = $this->input->post('clinic');
        $returnData = array();
        $patients = $this->model->filter_data($clinic,$search);
        foreach($patients as $pro)
        {
            $data['id'] = $pro['id'];
            $data['name'] = $pro['name'].'  '.$pro['code'].' ( '.$pro['mobile'].' ) ';
            $data['page'] =  base_url('appointments/tb');
            array_push($returnData,$data);
        }
        echo json_encode($returnData);
    }

	public function treatment_remote($type,$id=null,$column='title')
    {
        //echo $_GET['gst'];die();
        if ($type=='title') {
            $tb = 'treatment_master';
        }
        else{

        }
        $this->db->where($column,$_GET[$column]);
        if($id!=NULL){
            $this->db->where('id != ',$id);
        }
        $count=$this->db->count_all_results($tb);
        if($count>0)
        {
            echo "false";
        }
        else
        {
            echo "true";
        }        
    }

	public function treatment($action=null,$id=null,$id2=null,$id3=null)
	{
		$data['user'] 		= $user =$this->checkLogin();
		$view_dir = 'masters/treatment/';
		switch ($action) {
			case null:
				$data['title'] 		= 'Treatment Master';
				$data['contant'] 	= $view_dir.'index';
				$data['tb_url']	  	=  current_url().'/tb';
				$data['new_url']	=  current_url().'/create';
				$data['search']	 		= $this->input->post('search');
				$this->template($data);
				break;

				case 'tb':
					$user = $user->id;
					$data['search'] = '';
					$search='null';
				   
					if($id!=null)
							{
					$data['search'] = $id;
					$search = $id;
							}
							//end of section
					if (@$_POST['search']) {
					$data['search'] = $_POST['search'];
					$search=$_POST['search'];
						   
							}
					$this->load->library('pagination');
					
					$data['contant'] 		= $view_dir.'tb';
					$config = array();
					$config["base_url"] 	= base_url()."treatment/tb";
					$config["total_rows"]  	= count($this->model->treatment_master($user,$search));
					$data['total_rows']    	= $config["total_rows"];
					$config["per_page"]    	= 10;
					$config["uri_segment"] 	= 2;
					$config['attributes']  	= array('class' => 'pag-link ');
					$this->pagination->initialize($config);
					$data['links']   		= $this->pagination->create_links();
					$data['page']    		= $page = ($id!=null) ? $id : 0;
					$data['search']	 		= $this->input->post('search');
					$data['update_url']		= base_url('treatment/create/');
					$data['delete_url']		= base_url('treatment/delete/');
					$data['pimg_url']           = base_url().'treatment/treatment-image/';
					$data['rows']    		= $this->model->treatment_master($user,$search,$config["per_page"],$page);
					
					load_view($data['contant'],$data);
					break;

			case 'create':
				$data['title'] 		  = 'New Unit';
				$data['remote']     = base_url().'treatment_remote/title/';
				$data['contant']      = $view_dir.'create';
				$data['action_url']	  = base_url('treatment/save');
				$data['flag']=1;
				if ($id!=null) {
					$data['action_url']	  .=  '/'.$id;
					$data['row'] = $this->model->getRow('treatment_master',['id'=>$id]);
					// $data['remote']     = base_url().'treatment_remote/title/';
					$data['flag']=0;
				}
				
				load_view($data['contant'],$data);
				break;

			case 'save':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					$this->form_validation->set_rules('title', 'Title', 'required');
					if ($this->form_validation->run() !== FALSE)
	                {
	                    if ($id!=null) {
							    $data =array(
								'clinic_id'=>$this->input->post('clinic_id'),
								'title'=>$this->input->post('title'),
								'appointment_advance'=>$this->input->post('appointment_advance'),
								'video_url'=>$this->input->post('video_url'),
								'description'=>$this->input->post('description'),
								'duration'=>$this->input->post('duration'),
							  );
							if($this->model->Update_treatment($data,$id)){
								$saved = 1;
							}
						}
						else{
							$data =array(
                              'clinic_id'=>$this->input->post('clinic_id'),
							  'title'=>$this->input->post('title'),
							  'appointment_advance'=>$this->input->post('appointment_advance'),
							  'video_url'=>$this->input->post('video_url'),
							  'description'=>$this->input->post('description'),
							  'duration'=>$this->input->post('duration'),
							);
							if($this->model->add_teatment($data)){
								$saved = 1;
							}
						}

						if ($saved == 1 ) {
							$return['res'] = 'success';
							$return['msg'] = 'Saved.';
						}
	                }
	                else
	                {
	                    $return['errors'] = $this->form_validation->error_array();
	                }	
				}
				echo json_encode($return);
				break;
				case 'treatment-image':

					if ($this->input->server('REQUEST_METHOD')=='POST') {
						$return['res'] = 'error';
						$return['msg'] = 'Not Saved!';
						if ($this->model->treatment_img_upload($id)) {
							$return['res'] = 'success';
							$return['msg'] = 'Saved.';
						} 
						echo json_encode($return);
					}
					else{
						$data['pid'] = $id;
						$data['images']        = $this->model->treatment_img($id);
						$data['action_url']    = base_url().'treatment/treatment-image/'.$id;
						$data['form_id']       = uniqid();
						$data['contant']       = 'masters/treatment/treatment_images';
						
						load_view($data['contant'],$data);
					}
	
					break;
					case 'add_image':
						$id = $this->input->post('pid');
						$imageCount = count($_FILES['file']['name']);
						if (!empty($imageCount)) {
							for ($i = 0; $i < $imageCount; $i++) {
								$config['file_name'] = date('Ymd') . rand(1000, 1000000);
								$config['upload_path'] = UPLOAD_PATH.'treatment/';
								$config['allowed_types'] = 'jpg|jpeg|png|gif|webp|svg';
								$this->load->library('upload', $config);
								$this->upload->initialize($config);
								$_FILES['files']['name'] = $_FILES['file']['name'][$i];
								$_FILES['files']['type'] = $_FILES['file']['type'][$i];
								$_FILES['files']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
								$_FILES['files']['size'] = $_FILES['file']['size'][$i];
								$_FILES['files']['error'] = $_FILES['file']['error'][$i];
	
								if ($this->upload->do_upload('files')) {
									$imageData = $this->upload->data();
								   if($_FILES['files']['type']=='image/webp')
										{
										   echo UPLOAD_PATH.'treatment/'.$imageData['file_name'];
												$img =  imagecreatefromwebp(UPLOAD_PATH.'treatment/'. $imageData['file_name']);
												imagepalettetotruecolor($img);
												imagealphablending($img, true);
												imagesavealpha($img, true);
												imagewebp($img, UPLOAD_PATH.'treatment/treatment/'. $imageData['file_name'], 60);
												imagedestroy($img);
										}
										else
										{
											$config2 = array(
												'image_library' => 'gd2', //get original image
												'source_image' =>   UPLOAD_PATH.'treatment/'. $imageData['file_name'],
												'width' => 640,
												'height' => 360,
												'new_image' =>  UPLOAD_PATH.'treatment/thumbnail/'. $imageData['file_name'],
											);
											$this->load->library('image_lib');
											$this->image_lib->initialize($config2);
											$this->image_lib->resize();
											$this->image_lib->clear();
										}
									$images[] = "treatment/" . $imageData['file_name'];
									$images2[] = "treatment/thumbnail/" . $imageData['file_name'];
								}
							}
						}
						if (!empty($images)) {      
							foreach (array_combine($images, $images2) as $file => $file2) {
								$file_data = array(
									'img' => $file,
									'thumbnail' => $file2,
									'item_id' => $id
								);
								$this->db->insert('treatment_photo', $file_data);
							}                        
						}
					break;
					case 'delete_image': 
						if($this->model->delete_treatment_image($id2))
						{
				   
							$data['pid']           = $id;
							$data['images']        = $this->model->treatment_img($id);
							$data['action_url']    = base_url().'treatment/treatment-image/'.$id;
							$data['form_id']       = uniqid();
							$data['contant']       = 'masters/treatment/treatment_images';
						
						load_view($data['contant'],$data);
							
						}
						break;
						case 'make_cover': 
							if($this->model->remove_treatment_cover($id) && $this->model->make_treatment_cover($id2))
							{
								$data['pid']           = $id;
								$data['images']        = $this->model->treatment_img($id);
								$data['action_url']    = base_url().'treatment/treatment-image/'.$id;
								$data['form_id']       = uniqid();
								$data['contant']       = 'masters/treatment/treatment_images';
						
						load_view($data['contant'],$data);
								
							}
							break;
							case 'update_prod_seq':
								$seq = $id3;
								$data = array(
									'seq'     => $seq,
								);
								if($this->model->update_prod_seq($id2,$data))
								{
									$data['pid']           = $id;
									$data['images']        = $this->model->treatment_img($id);
									$data['action_url']    = base_url().'treatment/treatment-image/'.$id;
									$data['form_id']       = uniqid();
									$data['contant']       = 'masters/treatment/treatment_images';
						
									load_view($data['contant'],$data);
									
								}
								else
								{
									echo('Sequence Already Exists!!');
								}
								break;
			case 'delete':
				$return['res'] = 'error';
				$return['msg'] = 'Not Deleted!';
				if ($id!=null) {
					if($this->model->_delete('treatment_master',['id'=>$id])){
						$saved = 1;
						$return['res'] = 'success';
						$return['msg'] = 'Successfully deleted.';
					}
				}
				echo json_encode($return);
				break;

			
			default:
				// code...
				break;
		}
		

		// $this->pr($data);
		// $this->template($data);
	}







}