<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Main.php');
class Users extends Main {

	public function user($action=null,$id=null)
	{
		$data['user']    = $this->checkLogin();
		switch ($action) {
			case null:
				$data['title'] = 'Users';
				$data['contant'] = 'users/users/index';
				$data['tb_url']	  =  base_url().'users/user/tb';
				$data['new_url']	  =  base_url().'users/user/create';
				$this->template($data);
				break;

			case 'tb':
				$data['contant'] 	  = 'users/users/tb';
				$data['update_url']	  =  base_url().'users/user/create/';
				$data['delete_url']	  =  base_url().'users/user/delete/';
				
				$data['rows'] = $this->model->getData('tb_admin',0,'asc','name');

				// $this->pr($data);
				load_view($data['contant'],$data);
				break;

			

			case 'create':
				$data['contant'] = 'users/users/create';
				$data['action_url']	  =  base_url().'users/user/save';
				$data['user_role']  = $this->model->getData('tb_user_role',0,'asc','name');
				if ($id!=null) {
					$data['action_url']	  =  base_url().'users/user/save/'.$id;
					$data['row'] = $this->model->getRow('tb_admin',['id'=>$id]);
				}
				load_view($data['contant'],$data);

				break;

			case 'save':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				if ($this->input->server('REQUEST_METHOD')=='POST') {

					// $this->pr($_POST);

					
					if ($id!=null) {
						$row = $this->model->getRow('tb_admin',['id'=>$id]);
						if($this->model->Update('tb_admin',$_POST,['id'=>$id])){
							$saved = 1;
						}
					}
					else{
						if($id = $this->model->SaveGetId('tb_admin',$_POST)){
							$saved = 1;
						}
					}

					if ($saved == 1 ) {
						$file_name = 'photo';
						if (@$_FILES[$file_name]['name']) {
						$directory = '../../public/uploads/user-images/';
						if (base_url()=='http://localhost/mrs/') {
							$directory = 'public/uploads/user-images/';
						}
						$config['upload_path']          = $directory;
               			$config['allowed_types'] 		= '*';
		                $config['remove_spaces']        = TRUE;
			            $config['encrypt_name']         = TRUE;
			            $config['max_filename']         = 20;
			            $this->load->library('upload', $config);
			            if($this->upload->do_upload($file_name)){
			            	$upload_data = $this->upload->data();
			            	$img['photo']  = img_base_url().'public/uploads/user-images/'.$upload_data['file_name'];
			            	if($this->model->Update('tb_admin',$img,['id'=>$id])){
				            	if (@$row) {
				            		if(@$row->pic!=''){
				            			if (base_url()=='http://localhost/mrs/') {
										unlink($row->pic);
										}
										else{
											unlink('../../'.$row->pic);
										}
				            		}
								}
							}
			            }
					}
						$return['res'] = 'success';
						$return['msg'] = 'Saved.';
					}
				}
				echo json_encode($return);
				break;

				case 'delete':
					
				break;

			}
	}

	public function admin_menu($action=null,$id=null)
	{
		$data['user'] 		= $this->checkLogin();
		switch ($action) {
			case null:
				$data['title'] = 'Admin Menu';
				$data['contant'] = 'users/admin_menu/index';
				$data['tb_url']	  =  base_url().'users/admin_menu/tb';
				$data['new_url']	  =  base_url().'users/admin_menu/create';
				$this->template($data);
				break;

			case 'tb':
				$data['contant'] 	  = 'users/admin_menu/tb';
				$data['update_url']	  =  base_url().'users/admin_menu/create/';
				$data['delete_url']	  =  base_url().'users/admin_menu/delete/';
				$data['rows']		= $this->model->admin_menus();
				// $this->pr($data);
				load_view($data['contant'],$data);
				break;

			case 'create':
				$data['title'] 		  = 'New Admin Menu';
				$data['contant']      = 'users/admin_menu/create';
				$data['action_url']	  =  base_url().'users/admin_menu/save';
				if ($id!=null) {
					$data['action_url']	  =  base_url().'users/admin_menu/save/'.$id;
					$data['row'] = $this->model->getRow('tb_admin_menu',['id'=>$id]);
				}
				$data['menus']   = $this->model->admin_menus('');
				load_view($data['contant'],$data);
				break;

			case 'save':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					if ($id!=null) {
						if($this->model->Update('tb_admin_menu',$_POST,['id'=>$id])){
							$saved = 1;
						}
					}
					else{
						if($this->model->Save('tb_admin_menu',$_POST)){
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

			
			default:
				// code...
				break;
		}
		

		// $this->pr($data);
		// $this->template($data);
	}


	public function user_role($action=null,$id=null)
	{
		$data['user'] 		= $this->checkLogin();
		switch ($action) {
			case null:
				$data['title'] = 'User Role';
				$data['contant'] = 'users/user_role/index';
				$data['tb_url']	  =  base_url().'users/user_role/tb';
				$data['new_url']	  =  base_url().'users/user_role/create';
				$this->template($data);
				break;

			case 'tb':
				$data['contant'] 	  = 'users/user_role/tb';
				$data['update_url']	  =  base_url().'users/user_role/create/';
				$data['delete_url']	  =  base_url().'users/user_role/delete/';
				$data['m_access_url'] =  base_url().'users/user_role/menu_access/';
				$data['rows']		  = $this->model->getData('tb_user_role');
				// $this->pr($data);
				load_view($data['contant'],$data);
				break;

			case 'create':
				$data['title'] 		  = 'User Role';
				$data['contant']      = 'users/user_role/create';
				$data['action_url']	  =  base_url().'users/user_role/save';
				if ($id!=null) {
					$data['action_url']	  =  base_url().'users/user_role/save/'.$id;
					$data['row'] = $this->model->getRow('tb_user_role',['id'=>$id]);
				}
				$data['menus']   = $this->model->admin_menus('');
				load_view($data['contant'],$data);
				break;

			case 'save':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					if ($id!=null) {
						if($this->model->Update('tb_user_role',$_POST,['id'=>$id])){
							$saved = 1;
						}
					}
					else{
						if($this->model->Save('tb_user_role',$_POST)){
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

			case 'menu_access':
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				if ($this->input->server('REQUEST_METHOD')=='POST') {
					// $this->pr($_POST);

					$menu_id    = $_POST['m_id'];
					$type   	= $_POST['type'];
					$role_id    = $id;
					$row = $this->model->getRow('tb_admin_menu',['id'=>$menu_id]);
					if($row){
						$check['role_id']   = $role_id;
						$check['menu_id'] 	= $menu_id;
						$value = 0;
						if ($type=='set'){
							$value = 1;
						}
						// $update['propmasterid'] 	= $p_id;

						if ($type=='set' && $_POST['name']=='') {
							
							if($this->model->getRow('tb_role_menus',$check)){
								if ($this->model->Update('tb_role_menus',$update,$check)) {
									$saved = 1;
								}
							}
							else{
								if ($this->model->Save('tb_role_menus',$check)) {
									$saved = 1;
								}
							}
						}
						else if($_POST['name']!=''){
							$update[$_POST['name']] = $value;
							if($this->model->getRow('tb_role_menus',$check)){
								if ($this->model->Update('tb_role_menus',$update,$check)) {
									$saved = 1;
								}
							}
							else{
								$return['msg'] = 'Menu Not Assigned!';
							}
						}
						else{
							if ($this->model->Delete('tb_role_menus',$check)) {
								$saved = 1;
							}
						}
					}
					if ($saved == 1) {
						$return['res'] = 'success';
						$return['msg'] = 'Saved.';
					}

					echo json_encode($return);
					
				}
				else{
					$page     = 'users/user_role/menu_access';
					$data['m_access_url'] =  base_url().'users/user_role/menu_access/';

					$menus   = $this->model->admin_menus('');
					$data['role_id'] = $role_id = $id;
					if ($menus) {
						foreach ($menus as $row) {
							$row->checked = '';
							$row->c_checked = '';
							$row->u_checked = '';
							$row->d_checked = '';
							if ($t = $this->model->getRow('tb_role_menus',['menu_id'=>$row->id,'role_id'=>$role_id])) {
								$row->checked = 'checked';
							}
							if (@$t->add==1) {
								$row->c_checked = 'checked';
							}
							if (@$t->update==1) {
								$row->u_checked = 'checked';
							}
							if (@$t->delete==1) {
								$row->d_checked = 'checked';
							}
						}
					}

					// $this->pr($menus);
					$data['menus']  = $menus;
					load_view($page,$data);
				}
				break;

			
			default:
				// code...
				break;
		}
		

		// $this->pr($data);
		// $this->template($data);
	}



}
