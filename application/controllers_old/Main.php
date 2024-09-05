<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
		parent::__construct();
       $this->service_charges = 0;
       
    }

	public function template($data)
	{
		$user         = $this->checkLogin();
		$data['menu'] = $this->user_module->get_menu($user);
		$data['parm'] = $this->checkPermission();
		$data['comp'] = 'M L W';
		$data['service_charges'] = $this->service_charges;
		if (!isset($data['title'])) { $data['title'] = $data['comp']; }
		$data['logo'] = base_url().'static/app-assets/images/logo/logo.png';
		if (!isset($data['tb_url'])){ $data['tb_url'] = ''; } 
		
		$this->load->view('template',$data);
	}

	public function changeStatus($id_column=null)
	{
		if ($this->input->is_ajax_request()) {
			$data = explode(',',$_POST['data']);
			$id = $data[0];
			$tb = $data[1];
			$update = array('status' => $_POST['value'] );
			if ($id_column==null) {
				$cond = ['id' => $id];
				$column = "";
			}
			else{
				$cond = [$id_column => $id];
				$column = "column='$id_column'";
			}

			$this->model->Update($tb,$update,$cond);
			$status = $this->model->getRow($tb,$cond)->status;
			if ($status==1) {
				echo "<span class='changeStatus' onclick='changeStatus(this)' value='0' data='".$id.",".$tb."' ".$column." title='Click for chenage status' ><i class='la la-check-circle'></i></span>";
			} 
			else{
				echo "<span class='changeStatus' onclick='changeStatus(this)' value='1' data='".$id.",".$tb." ' ".$column." title='Click for chenage status'><i class='icon-close'></i></span>";
			}	
		}
	}

	public function change_status()
	{
		if ($this->input->is_ajax_request()) {
			$data = explode(',',$_POST['data']);
			$id 	= $data[0];
			$tb 	= $data[1];
			$id_column  = $data[2];
			$val_column  = $data[3];
			$update = array($val_column => $_POST['value'] );
			$cond = [$id_column => $id];
			$column = "column='$id_column'";
			
			$this->model->Update($tb,$update,$cond);
			$status = $this->model->getRow($tb,$cond)->$val_column;

			if ($status==1) {
				echo "<span class='changeStatus'  data-toggle='change-status' value='0' data='".$_POST['data']."' title='Click for chenage status' ><i class='la la-check-circle'></i></span>";
			} 
			else{
				echo "<span class='changeStatus' data-toggle='change-status' value='1' data='".$_POST['data']."'  title='Click for chenage status'><i class='icon-close'></i></span>";
			}	
		}
	}

	public function changeIndexing()
	{
		if ($this->input->is_ajax_request()) {
			$data = explode(',',$_POST['data']);
			$id 	= $data[0];
			$tb 	= $data[1];
			$id_column  = $data[2];
			$val_column  = $data[3];
			$update = array($val_column => $_POST['value'] );
			$cond = [$id_column => $id];
			$this->model->Update($tb,$update,$cond);	
		}
	}

	public function changeStatusDispaly()
	{
		if ($this->input->is_ajax_request()) {
			$data = explode(',',$_POST['data']);
			$id = $data[0];
			$tb = $data[1];
			$ex = '';
			$update = array('display' => $_POST['value'] );
			if (@$data[2]) :
				$cond = [ $data[2] => $id];
				$ex = ','.$data[2];
			else:
				$cond = ['id' => $id];
			endif;



			$this->model->Update($tb,$update,$cond);
			echo $this->db->last_query();
			echo $display = $this->model->getRow($tb,$cond)->display;

			if ((int)$display==1) {
				echo "string";
				echo "<span class='changeStatusDispaly' value='0' data='".$id.",".$tb.$ex."'><i class='la la-check-circle'></i></span>";


			} 
			else{
				echo "string22";
				echo "<span class='changeStatusDispaly' value='1' data='".$id.",".$tb.$ex." '><i class='icon-close'></i></span>";
			}	
		}
	}



	public function get_states($country_id=101,$selected_id=null)
	{	
		$rows = $this->app_lib->states($country_id);
		foreach ($rows as $key => $value) {
			$selected = ($key == $selected_id) ? 'selected' : '';
			echo optionStatus($key,$value,1,$selected);
		}
		
	}

	public function get_cities($state_id=null,$selected_id=null)
	{
		
		$rows = $this->app_lib->cities($state_id);
		foreach ($rows as $key => $value) {
			$selected = ($key == $selected_id) ? 'selected' : '';
			echo optionStatus($key,$value,1,$selected);
		}
	}

	public function sub_categories($parent)
	{
		if ($parent!=0) {
			$rows = $this->app_lib->categories($parent);
			echo optionStatus('0','-- Select --',1);
			foreach ($rows as $key => $value) {
				echo optionStatus($value->id,$value->name,$value->active);
			}
		}
		else{
			echo optionStatus('','-- Select Category First --',1);
		}
	}

	public function getProducts($parent_cat_id=NULL,$sub_cat_id=NULL)
	{
		if (@$parent_cat_id) {
			$rows = $this->app_lib->products($parent_cat_id,$sub_cat_id);
			echo optionStatus('0','-- Select --',1);
			foreach ($rows as $key => $value) {
				echo optionStatus($value->id,$value->name,$value->active);
			}
		}
		else{
			echo optionStatus('','-- Select Category First --',1);
		}
	}

	

	public function between_dates($start,$end)
	{
		$dateArray = array();
		$period = new DatePeriod(
			     new DateTime($start),
			     new DateInterval('P1D'),
			     new DateTime($end)
		);
		foreach($period as $date) {                 
		      $dateArray[] = $date->format('Y-m-d'); 
		}

		return $dateArray;
	}

	



	public function checkLogin(){
		$loggedin = false;
		if (get_cookie('63a490ed05b42') && get_cookie('63a490ed05b43') && get_cookie('63a490ed05b44')) {
			$user_id = value_encryption(get_cookie('63a490ed05b42'),'decrypt');
			$user_nm = value_encryption(get_cookie('63a490ed05b43'),'decrypt');
			$type    = value_encryption(get_cookie('63a490ed05b44'),'decrypt');
			if (is_numeric($user_id) && !is_numeric($user_nm)) {
				$check['id'] 	   = $user_id;
				$check['username'] = $user_nm;
				if ($type=='admin') {
					$user = $this->model->getRow('tb_admin',$check);
					if(!@$user){
						$user = $this->model->getRow('clinics',$check);
						$user->status 	= $user->active;
						$user->photo 	= $user->banner;
					}
				}
				elseif($type=='host'){
					$user = $this->model->getRow('usermaster',$check);
					if ($user) {
						$user->status = $user->isactive;
						// $user->user_role = 4;

					}
				}
				else{
					$user = false;
				}

				if ($user) {
					if ($user->status==1) {
						$user->type = $type;
						$loggedin = true;
					}
				}
			}
		}

			// echo "<pre>";
			// print_r($user);
			// print_r($_COOKIE);
			// echo "</pre>";

			// die();

		if ($loggedin) {
			return $user;
		}
		else{
			delete_cookie('63a490ed05b42');	
		    delete_cookie('63a490ed05b43');	
		    delete_cookie('63a490ed05b44');	
		    redirect(base_url().'login');
		}
	}

	public function checkCookie(){
		$loggedin = false;
		if (get_cookie('63a490ed05b42') && get_cookie('63a490ed05b43') && get_cookie('63a490ed05b44')) {
			$user_id = value_encryption(get_cookie('63a490ed05b42'),'decrypt');
			$user_nm = value_encryption(get_cookie('63a490ed05b43'),'decrypt');
			if (is_numeric($user_id) && !is_numeric($user_nm)) {
				$loggedin = true;
			}
		}

		if ($loggedin) {
			return true;
		}
		else{
			delete_cookie('63a490ed05b42');	
		    delete_cookie('63a490ed05b43');	
		    delete_cookie('63a490ed05b44');	
		    redirect(base_url().'login');
		}
	}

	function checkPermission(){
		$add=$update=$delete=1;

		$user=$this->checkLogin();
		$base_url = base_url();
		$current_url = current_url();
		$url=str_replace($base_url, "", $current_url);

		$url= explode('/', $url);
		if (count($url)>1) {
			$url= $url[0].'/'.$url[1];
		}
		else{
			$url = $url[0];
		}
		if($menu_id=$this->model->getRow('tb_admin_menu', array('url' => $url,'status'=>1 ))){
			$d=array('role_id' => $user->user_role,'menu_id'=> $menu_id->id );
			if($parmission=$this->model->getRow('tb_role_menus',$d))
			{
				$add=$parmission->add;
				$update=$parmission->update;
				$delete=$parmission->delete;
			}
		}
		$data['add']=$add;
		$data['update']=$update;
		$data['delete']=$delete;
		return $data;
	}

	function checkPermission2($action){
		$permission=$this->checkPermission();
		if ($permission[$action]==1) {
			return true;
		}
		else{
			// echo "string";
			$data['contant']='access_denied';
			$this->loadTemplate($data);
		}
	}

	function gen_Otp($mobile){
		$this->delete_old_otp();
		$otp=rand( 10000 , 99999 );
		$data=$this->model->getRow('otp',array('mobile'=>$mobile));
		if ($data) {
			$otp=$data->otp;
		}
		else
		{
			$this->send_sms($otp,$mobile);
			$d=array('mobile'=>$mobile,'otp'=>$otp,'time'=>time());
			$this->model->add('otp',$d);
		}	
	}

	function resend_Otp($mobile){
		$this->delete_old_otp();
		$otp=rand ( 10000 , 99999 );	
		$data=$this->model->getRow('otp',array('mobile'=>$mobile));
		if ($data) {
			$otp=$data->otp;
		}
		else
		{
			$d=array('mobile'=>$mobile,'otp'=>$otp,'time'=>time());
			$this->model->add('otp',$d);
		}	
		$this->send_sms($otp,$mobile);
		echo "Resend";
	}

	public function delete_old_otp()
	{
		$data=$this->model->get('otp');
		foreach ($data as $row) {
			$time =  time()-(int)$row->time;
			if ($time>=900) {
				$this->model->delete('otp',array('id' => $row->id));
			}
			
		}
	}


	function send_sms($otp,$mob)
	{
	 	file_get_contents("http://techfizone.com/send_sms?mob=".$mob."&otp=".$otp."&id=EasyCareer");
	}

	function send_email($booking_id,$type='booking')
	{	

		$b = $this->model->getRow('booking',$booking_id);
		// echo prx($b);

		if (@$b->email) {
			$sendOk = true;
		
			if ($type=='booking') {
				$subject  = "New Booking ";
				$bodyHtml = "<p><strong>GUESTS NAME</strong> : ".$b->guest_name." </p>
							<p><strong>BOOKING FOR</strong> : ".date('D, M d, Y',strtotime($b->start_date))." - ".date('D, M d, Y',strtotime($b->end_date))." </p>
							<p><strong>CONFIRMATION CODE</strong> : ".$b->confirmation_code ."</p>
							<p><strong>MOBILE</strong> : ".$b->contact." </p>";
				if (@$b->razorpay_payment_link_id) {
				$bodyHtml .="<a href='https://razorpay.com/payment-link/".$b->razorpay_payment_link_id."'>
				            Click here to pay</a>";				
				}
			}
			elseif ($type=='extend') {
				$subject = "Booking extended ";
				$bodyHtml = "<p><strong>GUESTS NAME</strong> : ".$b->guest_name." </p>
							<p><strong>BOOKING FOR</strong> : ".date('D, M d, Y',strtotime($b->start_date))." - ".date('D, M d, Y',strtotime($b->end_date))." </p>
							<p><strong>MOBILE</strong> : ".$b->contact." </p>";

			}
			elseif ($type=='cancel') {
				$subject = "Booking cancelled ";
				$bodyHtml = "<p><strong>GUESTS NAME</strong> : ".$b->guest_name." </p>
							<p><strong>BOOKING FOR</strong> : ".date('D, M d, Y',strtotime($b->start_date))." - ".date('D, M d, Y',strtotime($b->end_date))." </p>
							<p><strong>MOBILE</strong> : ".$b->contact." </p>";

			}
			else{
				$subject = "Amazon SES test (SMTP interface accessed using PHP)";
				$bodyHtml = '<h1>Email Test</h1>
				            <p>This email was sent through the
				            <a href="https://aws.amazon.com/ses">Amazon SES</a> SMTP
				            interface using the <a href="https://github.com/PHPMailer/PHPMailer">
				            PHPMailer</a> class.</p>';
			}

			$flat = $this->model->getRow('property',['flat_id'=>$b->flat_id]);
			$propmaster = $this->model->getRow('propmaster',['id'=>$flat->propid]);

			$bodyHtml .="<br><br><p>".$propmaster->propname."</p><p>".$flat->flat_name."( ".$flat->flat_no." )</p><p>".$propmaster->address."</p><p>".$flat->contact_preson."</p><p>".$flat->contact_preson_mobile."</p>";

       
		}
		// die();


		if (@$sendOk) {
			$postData['to'] 		= $b->email;
			$postData['to'] 		= 'ankitv4087@gmail.com';
			// $postData['to'] 		= 'nitin.deep2008@gmail.com';
			$postData['subject'] 	= $subject;
			$postData['bodyText'] 	= "";
			$postData['bodyHtml'] 	= $bodyHtml;

	        // $postData1 = json_encode($postData);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,base_url()."mail/send");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$postData);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec($ch);
			curl_close ($ch);

			// echo prx($server_output);
		}

		// [id] => 1
  //   [renter_type] => 
  //   [booking_type] => 
  //   [booking_from] => PANEL
  //   [guest_id] => 20
  //   [confirmation_code] => 39591
  //   [status] => 4
  //   [guest_name] => Ankit Verma
  //   [gender] => Male
  //   [email] => ankitv4087@gmail.com
  //   [contact] => 8887382475
  //   [of_adults] => 1
  //   [of_children] => 0
  //   [of_infants] => 0
  //   [start_date] => 2022-01-18
  //   [end_date] => 2022-01-22
  //   [of_nights] => 5
  //   [booked] => 
  //   [listing] => 
  //   [earnings] => 
  //   [flat_id] => 330
  //   [notes] => 
  //   [checkin_time] => 
  //   [checkin_status] => 0
  //   [purpose_of_trip] => 
  //   [vehcleno] => 
  //   [checkout_time1] => 
  //   [checkout_date] => 
  //   [pre_checkout] => 0
  //   [price_type] => 
  //   [price] => 6295
  //   [user_id] => 1
  //   [security_deposit] => 0
  //   [lockin_days] => 0
  //   [notice_days] => 0
  //   [checkout_remark] => 
  //   [checkout_next_place] => 
  //   [cancel_reason] => 
  //   [is_foreigner] => 1
  //   [booking_remark] => test
  //   [order_id] => 
  //   [booking_id] => 
  //   [rzp_payment_id] => 
  //   [price_currency] => 
  //   [rzp_capture_response] => 
  //   [booking_date] => 2022-01-10
  //   [rzp_refund_response] => 
  //   [extended] => 0
  //   [extended_remark] => 
  //   [ref_booking_id] => 0
  //   [discount_amount] => 100
  //   [discount_remark] => test
  //   [flat_changed] => 0
  //   [change_flat_remark] => 
  //   [wave_off_amount] => 0
  //   [wave_off_remark] => 
  //   [service_charges] => 0
  //   [rescheduled] => 1
  //   [reschedule_remark] => 
  //   [reschedule_wave_off_amount] => 100
  //   [reschedule_wave_off_remark] => 
  //   [razorpay_payment_link_id] => plink_Ii6PTCorx2iD2s
  //   [reference_id] => 61dc5c49b84ad
  //   [payment_status] => 3
  //   [payment_mode] => 6
  //   [cancellation_reason_id] => 1
  //   [refund_amount] => 5000.00
  //   [cancellation_note] => 
	}

	public function _uploadFile($path='',$file_name="file")
	{
		$directory = '../../public/uploads/'.$path.'/';
		if (base_url()=='http://localhost/sites/mrs/') {
			$directory = 'public/uploads/'.$path.'/';
		}
		$config['upload_path']          = $directory;
		$config['allowed_types'] 		= '*';
        $config['remove_spaces']        = TRUE;
        $config['encrypt_name']         = TRUE;
        $config['max_filename']         = 20;
        $this->load->library('upload', $config);
        if($this->upload->do_upload($file_name)){
        	$upload_data = $this->upload->data();
        	return img_base_url().'public/uploads/'.$path.'/'.$upload_data['file_name'];
        }
        return false;
	}
	public function _unlink_file($path,$file_name)
	{
		$directory = '../../public/uploads/'.$path.'/';
		if (base_url()=='http://localhost/sites/mrs/') {
			$directory = 'public/uploads/'.$path.'/';
		}
		unlink($directory.$file_name);
	}


	public function pr($data)
	{
		echo "<pre>";
		print_r($data);
		echo"</pre>";
		die();
	}

	public function test($amount)
	{
		echo "<img src='../../public/uploads/property-images/1617829587.jpg'>";
		$this->load->helper('file');
		$src = "../public/uploads/property-images/1617829587.jpg";  // source folder or file

		

		

		// $dest = "../public/uploads/16178295877.jpg";   // destination folder or file        
		// // echo $string = read_file('../../public/uploads/property-images/1617829587.jpg');
		// copy($src, $dest);
		// echo prx(tax_amount($amount));
	}

	public function check_duplicate($where,$column,$id=null)
	{
		$tb = $this->_get_tb($where);
        $cond[$column] = $_GET[$column];

        if(@$tb) :

            if ($id!=null) { 
            	$this->db->where('id != ',$id);
            }
            $this->db->where($column,$_GET[$column]);
            $row = $this->db->get($tb)->row();           
            echo (@$row) ? 'false' : 'true';
        else:
            echo 'true';
        endif;
	}

	public function _get_tb($type)
    {
        if ($type == 'plan-master') :
            $tb     = 'plan_master';
        elseif($type == 'relation-master') :
            $tb     = 'relation_master';
        elseif($type == 'security-question') :
            $tb     = 'security_question_master';
        elseif($type == 'language-master') :
            $tb     = 'language_master';
        else:
            $tb     = false;
        endif;

       return $tb;
    }


}

