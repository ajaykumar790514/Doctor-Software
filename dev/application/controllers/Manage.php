<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Main.php');
class Manage extends Main {

	public function index()
	{
		$data['user'] 		= $this->checkLogin();
		$data['title'] 		= 'Dashboard';
		$data['contant'] 	= 'dashboard';
		$this->template($data);
	}

	
}
