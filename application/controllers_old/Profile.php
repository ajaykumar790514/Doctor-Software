<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Main.php');

class Profile extends Main
{
	
	public function index($action=null,$p1=null,$p2=null,$p3=null)
	{
		$data['user'] = $user   	= $this->checkLogin();
		switch ($action) {
			case null:
				$data['title']      = 'Edit Profile';
				$data['contant']    = 'profile/index';
				
				// echo prx($data);
				// die();
				// $data['tb_url']	    = base_url().'plan-master/tb';
				
				$this->template($data);
				break;

			case 'update':
				
				$id = $user->id;
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				if ($this->input->server('REQUEST_METHOD')=='POST') {

					if($user->user_role==8 or $user->user_role==7){  // for clinics

						if (@$_FILES['photo']['name']) {
							if($file = upload_file('banner','photo')){
								$_POST['banner'] = $file;
							}
						}

						if (@$_POST) {
							if($this->model->Update('clinics',$_POST,['id'=>$id])){
								$return['res'] = 'success';
								$return['msg'] = 'Saved.';
							}	
						}
					}
					else {			// for admin and admin_users
						if (@$_FILES['photo']['name']) {
							if($file = upload_file('users','photo')){
								$_POST['photo'] = $file;
							}
						}
						if (@$_POST) {
							if($this->model->Update('tb_admin',$_POST,['id'=>$id])){
								$return['res'] = 'success';
								$return['msg'] = 'Saved.';
							}	
						}
					}
					


				}
				echo json_encode($return);
				break;

			case 'change-password':
				// echo prx($_POST);
				$id = $data['user']->id;
				$user = $data['user'];
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				if (@$_POST['old_password'] && @$_POST['password'] && @$_POST['conf_password']) {
					if ($_POST['password'] == $_POST['conf_password']) {
						if ($_POST['password'] == $user->password) {
							$updatePassword['password'] = $_POST['password'];
							if($this->model->Update('tb_admin',$updatePassword,['id'=>$id])){
								$return['res'] = 'success';
								$return['msg'] = 'Password changed successfully. Login Again.';
								delete_cookie('63a490ed05b42');	
								delete_cookie('63a490ed05b43');	
								delete_cookie('63a490ed05b44');	
								// redirect(base_url());
							}
						}
						else{
							$return['res'] = 'error';
							$return['msg'] = 'Incorrect old password!';
						}
					}
					else{
						$return['res'] = 'error';
						$return['msg'] = 'Confirm password not match!';
					}
				}
				else{
					$return['res'] = 'error';
					$return['msg'] = 'Please fill in all mandatory fields!';
				}
				echo json_encode($return);

				break;
			
			default:
				// code...
				break;
		}
	}
}

 ?>