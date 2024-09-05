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
			    $data['rows']    		= $this->model->appointments($user,$config["per_page"],$page);
			    // echo $this->db->last_query();
			    // echo _prx($data['rows']);
			    load_view($data['contant'],$data);

				// $data['contant'] 	= $view_dir.'tb';
				// $data['update_url']	= base_url('medicines/create/');
				// $data['delete_url']	= base_url('medicines/delete/');
				// $data['rows']		= $this->model->products();
				// $this->pr($data['rows']);
				// load_view($data['contant'],$data);
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



	







}