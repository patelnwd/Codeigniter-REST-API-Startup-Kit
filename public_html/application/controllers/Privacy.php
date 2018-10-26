<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy extends MY_Controller {
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['pageTitle'] = 'Privacy Policy';
		$this->load->view('view_privacyPolicy', $data);
	}
}
