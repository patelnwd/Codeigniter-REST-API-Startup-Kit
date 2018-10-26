<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms extends MY_Controller {
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['pageTitle'] = 'Terms & Conditions';
		$this->load->view('view_termsAndConditions', $data);
	}
}
