<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Main.php');
class Masters extends Main {
	// tmp
	// add clinic_id in clinic_timings
	// ALTER TABLE `clinic_timings` ADD `clinic_id` INT NULL AFTER `id`;
	// add clinic_id in patients
	// ALTER TABLE `patients` ADD `clinic_id` INT NULL AFTER `id`;
	// tmp
	public function categories($action=null,$id=null)
	{
		$data['user'] 		= $this->checkLogin();
		$view_dir = 'masters/categories/';
		switch ($action) {
			case null:
				$data['title'] 		= 'Category';
				$data['contant'] 	= $view_dir.'index';
				$data['tb_url']	  	=  current_url().'/tb';
				$data['new_url']	=  current_url().'/create';
				$this->template($data);
				break;

			case 'tb':
				$data['contant'] 	= $view_dir.'tb';
				$data['update_url']	= base_url('category/create/');
				$data['delete_url']	= base_url('category/delete/');
				$data['rows']		= $this->model->categories();
				// $this->pr($data);
				load_view($data['contant'],$data);
				break;

			case 'create':
				$data['title'] 		  = 'New Category';
				$data['contant']      = $view_dir.'create';
				$data['action_url']	  = base_url('category/save');
				if ($id!=null) {
					$data['action_url']	  .=  '/'.$id;
					$data['row'] = $this->model->getRow('products_category',['id'=>$id]);
				}
				
				$data['rows']			= $this->app_lib->categories(0);
				// $this->pr($data);
				// $data['rows']   = $this->model->categories(0);
				load_view($data['contant'],$data);
				break;

			case 'save':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					$this->form_validation->set_rules('name', 'Name', 'required');
					if ($this->form_validation->run() !== FALSE)
	                {
	                    if ($id!=null) {
							if (@$_FILES['thumbnail']['name']) {
								if($file = upload_file('thumbnail','thumbnail')){
									$_POST['thumbnail'] = $file;
									if (@$_POST['old_image']) {
										delete_file($_POST['old_image']);
									}
								}
							}
							unset($_POST['old_image']);
							if($this->model->Update('products_category',$_POST,['id'=>$id])){
								$saved = 1;
							}
						}
						else{
							if (@$_FILES['thumbnail']['name']) {
								if($file = upload_file('thumbnail','thumbnail')){
									$_POST['thumbnail'] = $file;
								}
							}
							
							unset($_POST['old_image']);
							if($this->model->Save('products_category',$_POST)){
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
			case 'delete':
				$return['res'] = 'error';
				$return['msg'] = 'Not Deleted!';
				if ($id!=null) {
					if($this->model->_delete('products_category',['id'=>$id])){
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


	public function medicines($action=null,$id=null)
	{
		$data['user'] 		= $this->checkLogin();
		$view_dir = 'masters/medicines/';
		switch ($action) {
			case null:
				$data['title'] 			= 'Medicines';
				$data['contant'] 		= $view_dir.'index';
				$data['tb_url']	  		= current_url().'/tb';
				$data['new_url']		= current_url().'/create';
				$data['categories']	  	= $this->app_lib->categories(0);
				$data['sub_categories']	= $this->app_lib->categories(NULL);
				$this->template($data);
				break;

			case 'tb':
				$this->load->library('pagination');

				$data['contant'] 		= $view_dir.'tb';
				$config 				= array();
				$config["base_url"] 	= base_url()."medicines/tb";
				$config["total_rows"]  	= count($this->model->products());
				$data['total_rows']    	= $config["total_rows"];
				$config["per_page"]    	= 10;
				$config["uri_segment"] 	= 3;
				$config['attributes']  	= array('class' => 'pag-link ');
				$this->pagination->initialize($config);
				$data['links']   		= $this->pagination->create_links();
			    $data['page']    		= $page = ($id!=null) ? $id : 0;
			    $data['search']	 		= $this->input->post('search');
			    $data['update_url']		= base_url('medicines/create/');
			    $data['delete_url']		= base_url('medicines/delete/');
			    $data['rows']    		= $this->model->products($config["per_page"],$page);
			    load_view($data['contant'],$data);

				// $data['contant'] 	= $view_dir.'tb';
				// $data['update_url']	= base_url('medicines/create/');
				// $data['delete_url']	= base_url('medicines/delete/');
				// $data['rows']		= $this->model->products();
				// // $this->pr($data);
				// load_view($data['contant'],$data);
				break;

			case 'create':
				$data['title'] 		  	= 'New Medicine';
				$data['contant']      	= $view_dir.'create';
				$data['action_url']	  	= base_url('medicines/save');
				$data['categories']	  	= $this->app_lib->categories(0);
				$data['sub_categories']	= $this->app_lib->categories(NULL);
				$data['unit_master']	= $this->app_lib->unit_master();
				if ($id!=null) {
					$data['row'] = $this->model->getRow('products_subcategory',['id'=>$id]);
					$data['sub_categories']	= $this->app_lib->categories($data['row']->parent_cat_id);
					$data['action_url']	  .=  '/'.$id;
					
				}

				// $this->pr($data);
				// $data['rows']   = $this->model->categories(0);
				load_view($data['contant'],$data);
				break;

			case 'save':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					$this->form_validation->set_rules('parent_cat_id', 'Category', 'required');
					$this->form_validation->set_rules('sub_cat_id', 'Sub Category', 'required');
					$this->form_validation->set_rules('name', 'Name', 'required');
					if ($this->form_validation->run() !== FALSE)
	                {
	                	if ($id!=null) {
							if (@$_FILES['photo']['name']) {
								if($file = upload_file('medicines','photo')){
									$_POST['photo'] = $file;
									if (@$_POST['old_photo']) {
										delete_file($_POST['old_photo']);
									}
								}
							}
							unset($_POST['old_photo']);
							if($this->model->Update('products_subcategory',$_POST,['id'=>$id])){
								$saved = 1;
							}
						}
						else{
							if (@$_FILES['photo']['name']) {
								if($file = upload_file('medicines','photo')){
									$_POST['photo'] = $file;
								}
							}
							unset($_POST['old_photo']);
							if($this->model->Save('products_subcategory',$_POST)){
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
			case 'delete':
				$return['res'] = 'error';
				$return['msg'] = 'Not Deleted!';
				if ($id!=null) {
					if($this->model->_delete('products_subcategory',['id'=>$id])){
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

	public function clinics($action=null,$id=null)
	{
		$data['user'] 		= $this->checkLogin();
		$view_dir = 'masters/clinics/';
		switch ($action) {
			case null:
				$data['title'] 		= 'Clinics';
				$data['contant'] 	= $view_dir.'index';
				$data['tb_url']	  	=  current_url().'/tb';
				$data['new_url']	=  current_url().'/create';
				$this->template($data);
				break;

			case 'tb':
				$data['contant'] 	= $view_dir.'tb';
				$data['update_url']	= base_url('clinics/create/');
				$data['delete_url']	= base_url('clinics/delete/');
				$data['timing_url']	= base_url('clinics/timing/');
				$data['rows']		= $this->model->clinics();
				// $this->pr($data);
				load_view($data['contant'],$data);
				break;

			case 'create':
				$data['title'] 		  	= 'New Clinics';
				$data['contant']      	= $view_dir.'create';
				$data['action_url']	  	= base_url('clinics/save');
				$data['states']	  		= $this->app_lib->states(101);
				if ($id!=null) {
					$data['row'] 		= $this->model->getRow('clinics',['id'=>$id]);
					$data['cities']		= $this->app_lib->cities(@$data['row']->state);
					$data['action_url']	.=  '/'.$id;
					
				}

				// print_r($data['row']);
				// echo $id;
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
					$this->form_validation->set_rules('name', 'Branch Name', 'required');
					$this->form_validation->set_rules('code', 'Branch Code', 'required');
					$this->form_validation->set_rules('username', 'Username', 'required');
					if (!@$id) {
					$this->form_validation->set_rules('password', 'Password', 'required');
					}
					if ($this->form_validation->run() !== FALSE)
	                {
						if ($id!=null) {
							if (@$_FILES['banner']['name']) {
								if($file = upload_file('banner','banner')){
									$_POST['banner'] = $file;
									if (@$_POST['old_banner']) {
										delete_file($_POST['old_banner']);
									}
								}
							}
							unset($_POST['old_banner']);
							if (@$_POST['password']) {
								$_POST['password'] = value_encrypt($_POST['password']);
							}
							else{
								unset($_POST['password']);
							}
							if($this->model->Update('clinics',$_POST,['id'=>$id])){
								$saved = 1;
							}
						}
						else{
							if (@$_FILES['banner']['name']) {
								if($file = upload_file('banner','banner')){
									$_POST['banner'] = $file;
								}
							}
							
							unset($_POST['old_banner']);
							$_POST['password'] = value_encrypt($_POST['password']);
							if($this->model->Save('clinics',$_POST)){
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

			case 'timing':
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					$saved 			= false;
					$return['res'] 	= 'error';
					$return['msg'] 	= 'Not Saved!';
					$days 	= ['sun','mon','tue','wed','thu','fri','sat'];
					$types 	= ['open','close'];
					foreach ($days as $day) {
						$cond['clinic_id'] 	= $id;
						$cond['day'] 		= $day;

						$timing['clinic_id'] 	= $id;
						$timing['day'] 		= $day;
						foreach ($types as $type) {
							$timing[$type] = NULL;
							if (@$_POST[$day.'_'.$type]) {
								$timing[$type] = $_POST[$day.'_'.$type];
							}
						}
						// echo _prx($timing);
						

						if ($this->model->getRow('clinic_timings',$cond)) {
							if($this->model->Update('clinic_timings',$timing,$cond)){
								$saved = true;
							}
						}
						else{
							if($this->model->Save('clinic_timings',$timing)){
								$saved = true;
							}
						}
					}
					if ($saved) {
						$return['res'] = 'success';
						$return['msg'] = 'Saved.';
					}
					echo json_encode($return);
				}
				else{
					$data['contant'] 	= $view_dir.'timing';
					$data['action_url'] = base_url('clinics/timing/'.$id);
					$data['timing'] 	= $this->model->timings($id);
					// echo _prx($data['timing']);die();
					load_view($data['contant'],$data);
				}
				break;
			case 'delete':
				$return['res'] = 'error';
				$return['msg'] = 'Not Deleted!';
				if ($id!=null) {
					if($this->model->_delete('clinics',['id'=>$id])){
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

	public function patients($action=null,$id=null)
	{
		$data['user'] 	= $user		= $this->checkLogin();
		$view_dir 		= 'masters/patients/';
		switch ($action) {
			case null:
				$data['title'] 		= 'Patients';
				$data['contant'] 	= $view_dir.'index';
				$data['tb_url']	  	=  current_url().'/tb';
				$data['new_url']	=  current_url().'/create';
				$data['sms_url']	=  current_url().'/sms_create';
				$data['clinics']	  	= $this->app_lib->clinics();
				$this->template($data);
				break;

			case 'tb':
				$this->load->library('pagination');
				$data['contant'] 		= $view_dir.'tb';
				$config 				= array();
				$config["base_url"] 	= base_url()."patients/tb";
				$config["total_rows"]  	= count($this->model->patients($user));
				$data['total_rows']    	= $config["total_rows"];
				$config["per_page"]    	= 10;
				$config["uri_segment"] 	= 3;
				$config['attributes']  	= array('class' => 'pag-link');
				$this->pagination->initialize($config);
				$data['links']   		= $this->pagination->create_links();
			    $data['page']    		= $page = ($id!=null) ? $id : 0;
			    $data['search']	 		= $this->input->post('search');
			    $data['update_url']		= base_url('patients/create/');
			    $data['delete_url']		= base_url('patients/delete/');
			    $data['rows']    		= $this->model->patients($user,$config["per_page"],$page);
			    load_view($data['contant'],$data);

				// $data['contant'] 	= $view_dir.'tb';
				// $data['update_url']	= base_url('patients/create/');
				// $data['delete_url']	= base_url('patients/delete/');
				// $data['timing_url']	= base_url('patients/timing/');
				// $data['rows']		= $this->model->patients($user);
				// // $this->pr($data);
				// load_view($data['contant'],$data);
				break;

			case 'create':
				$data['title'] 		  	= 'New Patient';
				$data['contant']      	= $view_dir.'create';
				$data['action_url']	  	= base_url('patients/save');
				$data['states']	  		= $this->app_lib->states(101);
				$data['clinics']	  	= $this->app_lib->clinics();
				$data['cities']			= [];
				if ($id!=null) {
					$data['row'] 		= $this->model->getRow('patients',['id'=>$id]);
					$data['cities']		= $this->app_lib->cities(@$data['row']->state);
					$data['action_url']	.=  '/'.$id;
					
				}

				// $this->pr($data);
				// $data['rows']   = $this->model->categories(0);
				load_view($data['contant'],$data);
				break;

			case 'save':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					if ($id!=null) {
						if (@$_FILES['photo']['name']) {
							if($file = upload_file('patients','photo')){
								$_POST['photo'] = $file;
								if (@$_POST['old_photo']) {
									delete_file($_POST['old_photo']);
								}
							}
						}
						unset($_POST['old_photo']);
						if($this->model->Update('patients',$_POST,['id'=>$id])){
							$saved = 1;
						}
					}
					else{
						if (@$_FILES['photo']['name']) {
							if($file = upload_file('patients','photo')){
								$_POST['photo'] = $file;
							}
						}
						
						unset($_POST['old_photo']);
						$_POST['active'] = 1;
						if($p_id = $this->model->Save('patients',$_POST)){
							$code = $this->getPatientCode($_POST['clinic_id']);
							$update['code'] = $code;
							$this->model->Update('patients',$update,['id'=>$p_id]);
							$saved = 1;
							
							//sms code
                        $msg = "Hi ".$this->input->post('name').", Welcome to Divyabuti Ayurveda (Dr. Gupta Clinic) your registration no. is ".$code.". Thanks for join Divyabuti Ayurveda group -Dr Gupta Natural Clinic";
                        
                        //send sms
                        $conditions = array(
                            'returnType' => 'single',
                            'id'=>'6'
                        );
                        $smsData = $this->Sms_model->getSmsRows($conditions);
                        
                        $smsData['mobileNos'] = $this->input->post('mobile');
                        $smsData["message"] = $msg;
                
                        $this->Sms_model->send_sms($smsData);
						}
					}

					if ($saved == 1 ) {
						$return['res'] = 'success';
						$return['msg'] = 'Saved.';
					}
				}
				echo json_encode($return);
				break;

			case 'delete':
				$return['res'] = 'error';
				$return['msg'] = 'Not Deleted!';
				if ($id!=null) {
					if($this->model->_delete('patients',['id'=>$id])){
						$saved = 1;
						$return['res'] = 'success';
						$return['msg'] = 'Successfully deleted.';
					}
				}
				echo json_encode($return);
				break;
				
				case 'sms_create':
					$data['title'] 		  	= 'New SMS';
					$data['contant']      	= $view_dir.'sms_create';
					$data['templates']       = $this->model->getData('sms_master',['is_static'=>'1','active'=>'1']);
					$data['action_url']	  	= base_url('patients/sms_save');
					load_view($data['contant'],$data);
					break;
                 case 'sms_save':
					$saved=0;
					$return['res'] = 'error';
					$return['msg'] = 'Not Saved!';
					if ($this->input->server('REQUEST_METHOD')=='POST') { 
					$search='';
					$clinic_id='';
					$temp_id = $_POST['template'];
					$search = $_POST['search'];
					$clinic_id = $_POST['clinic'];
					$Pat=$this->model->getPatSMS($search,$clinic_id);
					$temp = $this->model->getRow('sms_master',['id'=>$temp_id]);
					$msg = $temp->template;
					foreach($Pat as $p)
					{
						 $mobile = $p->mobile;
						 $conditions = array(
                            'returnType' => 'single',
                            'conditions' => array(
                                'id'=>$temp_id
                                )
                        );
                        $smsData = $this->Sms_model->getSmsRows($conditions);
                        $smsData['mobileNos'] = $mobile;
                        $smsData["message"] = $msg;
                        $this->Sms_model->send_sms($smsData);
                        
					}
					$return['res']='success';
					$return['msg'] = 'Message Sent!';
					echo json_encode($return);
				  }
				 break;
			
			default:
				// code...
				break;
		}
		

		// $this->pr($data);
		// $this->template($data);
	}

	function getPatientCode($clinicId) {
		if($clinicId==3)
		{
			$code = $this->getConsumerCode_get();
			return $code;
			die();
		}
        $clinics = $this->model->getRow('clinics',['id'=>$clinicId]);
        $state = $this->model->getRow('states',['id'=>$clinics->state]);
        $city = $this->model->getRow('cities',['id'=>$clinics->city]);
        $clinicss['state_name'] = $state->name;
        $clinicss['city_name'] = $city->name;
        
        $code = substr($clinicss['city_name'],0,1);

        if($clinicId == 1) {
            $code .= "G";
        } else {
            $code .= "T";
        }

        $patientCode = $this->getPatientCount($clinicId);

        $code .= $patientCode;

        $code .= $this->getMonthLetter();

        $code .= date('y');

        //print_r($code);die;
        
        return $code;
	}

	function getPatientCount($clinicId) {
		$patientConditions = array(
			'clinic_id' => $clinicId,
			'added >=' => date('Y-m-01'),
			'added <=' => date('Y-m-d H:i:s')
		);
		$patients = $this->model->getRowPat('patients', $patientConditions, 'count');
	
		return ($patients + 1) > 9 ? ($patients + 1) : "0" . ($patients + 1);
	}

   function getMonthLetter() {
	switch(date('F')) {
		case 'January': return 'E';
		case 'February': return 'F';
		case 'March': return 'G';
		case 'April': return 'H';
		case 'May': return 'I';
		case 'June': return 'J';
		case 'July': return 'K';
		case 'August': return 'L';
		case 'September': return 'M';
		case 'October': return 'N';
		case 'November': return 'O';
		case 'December': return 'P';
		default: return "";
     }
  }

  public function getConsumerCode_get() {
	$code = "O";

	$patientCode = $this->getPatientCount(3);

	$code .= $patientCode;

	$code .= $this->getMonthLetter();

	$code .= date('y');
	
	return $code;
   }
public function SendReminder()
{
    $totalSent = 0;
    $errorCount = 0;
    $successMsg = "Reminders sent successfully.";
    $errorMsg = "Error sending reminders.";
    $Pat = $this->model->getPatReminder();
    foreach($Pat as $p)
    {
        $mobile = $p->mobile;
        $conditions = array(
            'returnType' => 'single',
            'conditions' => array(
                'id' => 8
            )
        );
		$clinic = $this->model->getRow('clinics',['id'=>$p->clinic_id]);
		$msg = 'Hi ' . $p->name . ',
		Just a friendly reminder your upcoming appointment with Dr. Gupta  on ' . $p->appointment_date . ' at  ' . $clinic->name . ' 
		Please, arrive 10 minutes before the scheduled time for registration
		Regards -Dr Gupta Natural Clinic';
        $smsData = $this->ManageOrderOtpModel->getSmsRows($conditions);
        $smsData['mobileNos'] = $mobile;
        $smsData["message"] = $msg;

        if ($this->ManageOrderOtpModel->send_sms($smsData)) {
            $totalSent++;
        } else {
            $errorCount++;
        }
    }
    $response = array(
        'success' => $totalSent > 0,
        'totalSent' => $totalSent,
        'errorCount' => $errorCount,
        'message' => $totalSent > 0 ? $successMsg : $errorMsg
    );
    echo json_encode($response);
}

	
	
	public function template_master($action=null,$id=null)
	{
		$data['user'] 	= $user		= $this->checkLogin();
		$view_dir 		= 'masters/template_master/';
		switch ($action) {
			case null:
				$data['title'] 		= 'Template Master';
				$data['contant'] 	= $view_dir.'index';
				$data['tb_url']	  	=  current_url().'/tb';
				$data['new_url']	=  current_url().'/create';
				$this->template($data);
				break;

			case 'tb':
				$this->load->library('pagination');
				$data['contant'] 		= $view_dir.'tb';
				$config 				= array();
				$config["base_url"] 	= base_url()."template-master/tb";
				$config["total_rows"]  	= count($this->model->sms_master());
				$data['total_rows']    	= $config["total_rows"];
				$config["per_page"]    	= 10;
				$config["uri_segment"] 	= 3;
				$config['attributes']  	= array('class' => 'pag-link');
				$this->pagination->initialize($config);
				$data['links']   		= $this->pagination->create_links();
			    $data['page']    		= $page = ($id!=null) ? $id : 0;
			    $data['search']	 		= $this->input->post('search');
			    $data['update_url']		= base_url('template-master/create/');
			    $data['delete_url']		= base_url('template-master/delete/');
			    $data['rows']    		= $this->model->sms_master($config["per_page"],$page);
			    load_view($data['contant'],$data);
				break;

			case 'create':
				$data['title'] 		  	= 'New Template ';
				$data['contant']      	= $view_dir.'create';
				$data['action_url']	  	= base_url('template-master/save');
				$data['cities']			= [];
				if ($id!=null) {
					$data['row'] 		= $this->model->getRow('sms_master',['id'=>$id]);
					$data['action_url']	= base_url('template-master/save/'.$id);
					
				}
				load_view($data['contant'],$data);
				break;

			case 'save':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					$data = array(
                     'url'=>'http://bulksms.webcure.in/api/sendhttp.php?authkey=',
					 'dlt_te_id'=>$_POST['template_id'],
					 'template'=>$_POST['template'],
					 'senderId'=>'DRGUPN',
					 'authKey'=>'406743ADVfTu8RTzx6512de85P1',
					 'routeId'=>'4',
					 'is_static'=>'1',

					);
					if ($id!=null) {
						if($this->model->Update('sms_master',$data,['id'=>$id])){
							$saved = 1;
						}
					}
					else{
						
						if($this->model->Save('sms_master',$data)){
							$saved = 1;
						}
					}

					if ($saved == 1 ) {
						$return['res'] = 'success';
						$return['msg'] = 'Saved.';
					}
				}
				echo json_encode($return);
				break;

			case 'delete':
				$return['res'] = 'error';
				$return['msg'] = 'Not Deleted!';
				if ($id!=null) {
					if($this->model->Delete('sms_master',['id'=>$id])){
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
		
	}


	public function clinic_vocation($action=null,$id=null)
	{
		$data['user'] 	= $user		= $this->checkLogin();
		$view_dir 		= 'masters/clinic_vocation/';
		switch ($action) {
			case null:
				$data['title'] 		= 'Clinic Vocation';
				$data['contant'] 	= $view_dir.'index';
				$data['tb_url']	  	=  current_url().'/tb';
				$data['new_url']	=  current_url().'/create';
				$data['clinics']	  	= $this->app_lib->clinics();
				$data['states']	  		= $this->app_lib->states(101);
				$data['cities']			= [];
				$this->template($data);
				break;

			case 'tb':
				$this->load->library('pagination');
				$data['contant'] 		= $view_dir.'tb';
				$config 				= array();
				$config["base_url"] 	= base_url()."clinic-vocation/tb";
				$config["total_rows"]  	= count($this->model->clinic_vocation());
				$data['total_rows']    	= $config["total_rows"];
				$config["per_page"]    	= 10;
				$config["uri_segment"] 	= 3;
				$config['attributes']  	= array('class' => 'pag-link');
				$this->pagination->initialize($config);
				$data['links']   		= $this->pagination->create_links();
			    $data['page']    		= $page = ($id!=null) ? $id : 0;
			    $data['search']	 		= $this->input->post('search');
			    $data['update_url']		= base_url('clinic-vocation/create/');
			    $data['delete_url']		= base_url('clinic-vocation/delete/');
			    $data['rows']    		= $this->model->clinic_vocation($config["per_page"],$page);
			    load_view($data['contant'],$data);
				break;
			  case 'create':
				$data['title'] 		  	= 'New Vocation';
				$data['contant']      	= $view_dir.'create';
				$data['action_url']	  	= base_url('clinic-vocation/save');
				$data['clinics']	  	= $this->app_lib->clinics();
				$data['cities']			= [];
				if ($id!=null) {
					$data['clinics']	  	= $this->app_lib->clinics();
					$data['row'] 		= $this->model->getRow('clinic_vocation',['id'=>$id]);
					$data['action_url']	.=  '/'.$id;
				}
				load_view($data['contant'],$data);
				break;

			case 'save':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					if ($id!=null) {
						if($this->model->Update('clinic_vocation',$_POST,['id'=>$id])){
							$saved = 1;
						}
					}
					else{
						if($p_id = $this->model->Save('clinic_vocation',$_POST)){
							$saved=1;
						}
					}

					if ($saved == 1 ) {
						$return['res'] = 'success';
						$return['msg'] = 'Saved.';
					}
				}
				echo json_encode($return);
				break;

			case 'delete':
				$return['res'] = 'error';
				$return['msg'] = 'Not Deleted!';
				if ($id!=null) {
					if($this->model->Delete('clinic_vocation',['id'=>$id])){
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


	public function unit_master($action=null,$id=null)
	{
		$data['user'] 		= $this->checkLogin();
		$view_dir = 'masters/unit_master/';
		switch ($action) {
			case null:
				$data['title'] 		= 'Unit';
				$data['contant'] 	= $view_dir.'index';
				$data['tb_url']	  	=  current_url().'/tb';
				$data['new_url']	=  current_url().'/create';
				$this->template($data);
				break;

			case 'tb':
				$data['contant'] 	= $view_dir.'tb';
				$data['update_url']	= base_url('unit-master/create/');
				$data['delete_url']	= base_url('unit-master/delete/');
				$data['rows']		= $this->model->units();
				// $this->pr($data);
				load_view($data['contant'],$data);
				break;

			case 'create':
				$data['title'] 		  = 'New Unit';
				$data['contant']      = $view_dir.'create';
				$data['action_url']	  = base_url('unit-master/save');
				if ($id!=null) {
					$data['action_url']	  .=  '/'.$id;
					$data['row'] = $this->model->getRow('unit_master',['id'=>$id]);
				}
				
				
				load_view($data['contant'],$data);
				break;

			case 'save':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					$this->form_validation->set_rules('name', 'Name', 'required');
					if ($this->form_validation->run() !== FALSE)
	                {
	                    if ($id!=null) {
							if($this->model->Update('unit_master',$_POST,['id'=>$id])){
								$saved = 1;
							}
						}
						else{
							
							if($this->model->Save('unit_master',$_POST)){
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
			case 'delete':
				$return['res'] = 'error';
				$return['msg'] = 'Not Deleted!';
				if ($id!=null) {
					if($this->model->_delete('unit_master',['id'=>$id])){
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


	public function general_settings($action=null,$id=null)
	{
		$data['user'] 		= $this->checkLogin();
		$view_dir = 'masters/general_settings/';
		switch ($action) {
			case null:
				$data['title'] 		= 'General Settings';
				$data['contant'] 	= $view_dir.'index';
				$data['tb_url']	  	=  current_url().'/tb';
				$this->template($data);
				break;

			case 'tb':
				$data['action_url']	  = base_url('general-settings/save');
				$data['contant'] 	= $view_dir.'create';
				$data['update_url']	= base_url('unit-master/create/');
				$data['delete_url']	= base_url('unit-master/delete/');
				$data['row'] 		= $this->model->getRow('general_master',['id'=>1]);
				// $this->pr($data);
				load_view($data['contant'],$data);
				break;

			case 'create':
				$data['title'] 		  = 'New Unit';
				$data['contant']      = $view_dir.'create';
				$data['action_url']	  = base_url('unit-master/save');
				if ($id!=null) {
					$data['action_url']	  .=  '/'.$id;
					$data['row'] = $this->model->getRow('unit_master',['id'=>$id]);
				}
				
				
				load_view($data['contant'],$data);
				break;

			case 'save':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					$this->form_validation->set_rules('meeting_slot_duration', 'Meeting Slot Duration', 'required');
					if ($this->form_validation->run() !== FALSE)
	                {
	                    
						if($this->model->Update('general_master',$_POST,['id'=>1])){
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
				}
				echo json_encode($return);
				break;
			case 'delete':
				$return['res'] = 'error';
				$return['msg'] = 'Not Deleted!';
				if ($id!=null) {
					if($this->model->_delete('unit_master',['id'=>$id])){
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