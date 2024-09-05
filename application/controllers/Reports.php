<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Main.php');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Reports extends Main
{
	
	function __construct()
	{
		parent::__construct();
		//  $this->load->library('ZipStream');
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


	public function patient_report($action=null,$id=null)
	{
		$data['user'] = $user 			= $this->checkLogin();
		$view_dir = 'reports/patient/';
		switch ($action) {
			case null:
				$data['title'] 			= 'Patient Report';
				$data['contant'] 		= $view_dir.'index';
				$data['tb_url']	  		= current_url().'/tb';
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
				$config["base_url"] 	= base_url()."patient-report/tb";
				$config["total_rows"]  	= count($this->model->patient_report($user));
				$data['total_rows']    	= $config["total_rows"];
				$config["per_page"]    	= 25	;
				$config["uri_segment"] 	= 3;
				$config['attributes']  	= array('class' => 'pag-link ');
				$this->pagination->initialize($config);
				$data['links']   		= $this->pagination->create_links();
			    $data['page']    		= $page = ($id!=null) ? $id : 0;
			    $data['search']	 		= $this->input->post('search');
			    $data['rows']    		= $this->model->patient_report($user,$config["per_page"],$page);
				 //$this->export_to_excel($data['rows']);
				// if ($this->input->post('export_excel')) {
				// 	$this->export_to_excel($data['rows']);
				// } else {
				 	load_view($data['contant'], $data);
				// }
				break;

		}
	}
	public function export_to_excel()
{
    $clinic = $this->input->post('clinic_id');
    $search = $this->input->post('search');
    $result = $this->model->patient_report_excel($clinic, $search);

    // Initialize CSV data with column headers
    $csvData = "Sr.No.,Clinic,Patient Name,Mobile,Gender,Age,State,City,Pincode,Address,Marital Status\n";

    $i = 1;
    foreach ($result as $row) {
        // Determine marital status
        $status = ($row->marital_status == 1) ? "Married" : (($row->marital_status == 2) ? "Unmarried" : "");

        // Append row data to CSV data
        $csvData .= $i++ . ',';
        $csvData .= '"' . $row->clinic_name . '(' . $row->clinic_code . ')",';
        $csvData .= '"' . $row->name . '(' . $row->code . ')",';
        $csvData .= $row->mobile . ',';
        $csvData .= $row->gender . ',';
        $csvData .= $row->age . ',';
        $csvData .= $row->state_name . ',';
        $csvData .= $row->city_name . ',';
        $csvData .= $row->pincode . ',';
        $csvData .= '"' . $row->address . '",';
        $csvData .= $status . "\n";
    }

    // Set headers
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment;filename="Clinic_Wise_Patient_Report.csv"'); // Set the filename here
	header('Cache-Control: max-age=0');

    // Output CSV data
    echo $csvData;
}

	
	
	
	




	
}
?>