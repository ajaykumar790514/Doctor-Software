<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Main.php');
class Inventory extends Main {
	// tmp
	// INSERT INTO `tb_admin_menu` (`id`, `title`, `url`, `icon_class`, `parent`, `status`, `indexing`, `add_on`, `add_by`, `update_on`, `update_by`) VALUES 
	// (40, 'Inventory', 'inventory', 'la la-suitcase', '', '1', 0, '2022-12-29 03:31:27', NULL, '2022-12-29 03:31:59', NULL);
	// tmp
	


	public function index($action=null,$id=null)
	{
		$data['user'] = $user 			= $this->checkLogin();
		$view_dir = 'inventory/';
		switch ($action) {
			case null:
				$data['title'] 			= 'Inventory';
				$data['contant'] 		= $view_dir.'index';
				$data['tb_url']	  		= current_url().'/tb';
				$data['new_url']		= current_url().'/create';
				$data['categories']	  	= $this->app_lib->categories(0);
				$data['sub_categories']	= $this->app_lib->categories(NULL);
				$data['clinics']	  	= $this->app_lib->clinics();
				$this->template($data);
				break;

			case 'tb':
				$this->load->library('pagination');

				$data['contant'] 		= $view_dir.'tb';
				$config 				= array();
				$config["base_url"] 	= base_url()."inventory/tb";
				$config["total_rows"]  	= count($this->model->shops_inventory($user));
				$data['total_rows']    	= $config["total_rows"];
				$config["per_page"]    	= 10;
				$config["uri_segment"] 	= 3;
				$config['attributes']  	= array('class' => 'pag-link ');
				$this->pagination->initialize($config);
				$data['links']   		= $this->pagination->create_links();
			    $data['page']    		= $page = ($id!=null) ? $id : 0;
			    $data['search']	 		= $this->input->post('search');
			    $data['update_url']		= base_url('inventory/create/');
			    $data['delete_url']		= base_url('inventory/delete/');
			    $data['transfer_url']	= base_url('inventory/transfer/');
			    $data['rows']    		= $this->model->shops_inventory($user,$config["per_page"],$page);
			    load_view($data['contant'],$data);

				// $data['contant'] 	= $view_dir.'tb';
				// $data['update_url']	= base_url('medicines/create/');
				// $data['delete_url']	= base_url('medicines/delete/');
				// $data['rows']		= $this->model->products();
				// // $this->pr($data);
				// load_view($data['contant'],$data);
				break;

			case 'create':
				$data['title'] 		  	= 'New Inventory';
				$data['contant']      	= $view_dir.'create';
				$data['action_url']	  	= base_url('inventory/save');
				$data['categories']	  	= $this->app_lib->categories(0);
				$data['sub_categories']	= $this->app_lib->categories(NULL);
				$data['products']		= $this->app_lib->products();
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
					$main_clinic = $this->app_lib->main_clinic();
					if (!@$main_clinic) {
						$return['msg'] = 'Main Branch Not Assigned!';
						echo json_encode($return); die();
					}
					$_POST['shop_id'] = $main_clinic->id;
					$check_cond['product_id'] 	= $_POST['product_id'];
					$check_cond['shop_id'] 		= $_POST['shop_id'];
					$qty = $_POST['qty'];

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
			case 'transfer':
				// echo $id;
				$return['res'] = 'error';
				$return['msg'] = 'Not Saved!';
				$saved = 0;
				$row 		= $this->app_lib->inventory($id);
				if ($this->input->server('REQUEST_METHOD')=='POST') {

					// echo json_encode($row);
					$insert['product_id'] 	= $row->product_id;
					$insert['qty'] 		 	= $_POST['qty'];
					$insert['shop_id'] 	 	= $_POST['clinic_id'];

					$check_cond['product_id'] 	= $row->product_id;
					$check_cond['shop_id'] 		= $_POST['clinic_id'];

					if ($inventory = $this->model->getRow('shops_inventory',$check_cond)) {
						$inventory['qty'] += $inventory->qty;
						if($this->model->Update('shops_inventory',$insert,$check_cond)){
							$saved = 1;
						}
						$shops_inventory_id = $inventory->id;

					}else{
						// echo "string";
						if($insert_id = $this->model->Save('shops_inventory',$insert)){
							$saved = 1;
							$shops_inventory_id = $insert_id;
						}
					}

					if ($saved == 1 ) {
						$log_data['product_id'] 		= $insert['product_id'];
						$log_data['qty'] 				= $_POST['qty'];
						$log_data['shop_id'] 			= $insert['shop_id'];
						$log_data['action'] 			= 'TRANSRER';
						$log_data['shops_inventory_id'] = $shops_inventory_id; 
						$this->model->Save('shop_inventory_logs',$log_data);

						$update['qty'] = $row->qty - $_POST['qty'];
						$this->model->Update('shops_inventory',$update,['id'=>$row->id]);

						$return['res'] = 'success';
						$return['msg'] = 'Transferred.';
					}

					echo json_encode($return);
				}
				else{
					$data['inventory'] 		= $row;
					// echo _prx($data['inventory']); die();
					$this->db->where('mtb.id != ',$row->shop_id);
					$data['clinics'] 		= $this->model->clinics();
					$data['contant']      	= $view_dir.'transfer';
					$data['action_url']	  	= base_url('inventory/transfer/'.$id);
					load_view($data['contant'],$data);
					// echo _prx($clinics);
					
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