<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Main.php');

class Reports extends Main
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function prescription($action=null,$id=null)
	{
		$data['user'] = $user 			= $this->checkLogin();
		$view_dir = 'reports/prescription/';
		switch ($action) {
			case null:
				$data['title'] 			= 'Prescription Report';
				$data['contant'] 		= $view_dir.'index';
				$data['tb_url']	  		= current_url().'/tb';
				if (@$_GET['client_code']) {
					$_POST['name']		= $_GET['client_code'];
					$data['tb_url']	  	= current_url().'/tb?client_code='.$_GET['client_code'];
				}
				$data['new_url']		= current_url().'/create';
				$data['categories']	  	= $this->app_lib->categories(0);
				$data['sub_categories']	= $this->app_lib->categories(NULL);
				$data['clinics']	  	= $this->app_lib->clinics();
				$data['a_status']		= $this->app_lib->appointment_status();
				$this->template($data);
				break;

			case 'tb':
				$this->load->library('pagination');
				if (@$_GET['client_code']) {
					$_POST['name']		= $_GET['client_code'];
				}

				$data['contant'] 		= $view_dir.'tb';
				$config 				= array();
				$config["base_url"] 	= base_url()."inventory/tb";
				$config["total_rows"]  	= count($this->model->prescription_reports($user));
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
			    $data['rows']    		= $this->model->prescription_reports($user,$config["per_page"],$page);
			    load_view($data['contant'],$data);
			    // echo _prx($data['rows']);
				break;

		}
	}
}
?>