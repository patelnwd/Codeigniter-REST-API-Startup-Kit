<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['pageTitle'] = 'Settings';
		$this->load->view('user/view_Settings', $data);		
	}
}
