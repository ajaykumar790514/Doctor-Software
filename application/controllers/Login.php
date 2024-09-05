<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Main.php');
class Login extends Main {

	public function index($type='admin')
	{
		if ($this->input->server('REQUEST_METHOD')=='POST') {

			if (!$_POST['username'] or !$_POST['password']) {
				$return['res'] = 'error';
				$return['msg'] = 'Please Enter Username & Password !';
				echo json_encode($return); die();
			}
			
			$check['username'] = $_POST['username'];
			$type = $_POST['type'];
			if (@$_POST['type']=='admin') {
				$user = $this->model->getRow('tb_admin',$check);
				// echo prx($user);
				if(!@$user){
					$user = $this->model->getRow('clinics',$check);
					$user->status 	= $user->active;
					$user->password = value_encrypt($user->password,'decode');
				}
			}
			elseif(@$_POST['type']=='host') {
				$user = $this->model->getRow('usermaster',$check);
				if ($user) {
					$user->status 	= $user->isactive;
				}
				$_POST['password'] 	= md5($_POST['password']);
			}
			else{
				$user = false;
			}
			

			if ($user) {
				if ($user->status==1) {
					// echo prx($user);
					if ($_POST['password']==$user->password) {
						$user = array_encryption($user);
						$type = value_encryption($type,'encrypt');
						set_cookie('63a490ed05b42',$user['id'],8000*24*30);
						set_cookie('63a490ed05b43',$user['username'],8000*24*30);
						set_cookie('63a490ed05b44',$type,8000*24*30);
						$return['res'] = 'success';
						$return['msg'] = 'Login Successful Please Wait Redirecting...';
						$return['redirect_url'] = base_url();
					}
					else {
						$return['res'] = 'error';
						$return['msg'] = 'Incorrect Password';
					}
				}
				else {
					$return['res'] = 'error';
					$return['msg'] = 'Account Temporarily Disabled!';
				}
			}
			else {
				$return['res'] = 'error';
				$return['msg'] = 'User Not Found!';
			}
			echo json_encode($return);

		}
		else{
			$data['title'] 	= 'Login';
			$data['type']	=	$type;
			load_view('login',$data);
		}
	}

	public function logout()
	{
		delete_cookie('63a490ed05b42');	
		delete_cookie('63a490ed05b43');	
		delete_cookie('63a490ed05b44');	
		redirect(base_url());
	}
}
