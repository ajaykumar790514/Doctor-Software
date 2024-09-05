<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Main.php');
class Pagenotfound extends Main {

	public function index()
	{
		$data['user'] = $this->checkLogin();
		$data['title'] = 'Error 404 ';
		$data['contant'] = 'error_404';
		// $this->pr($data);
		$this->template($data);
	}
}