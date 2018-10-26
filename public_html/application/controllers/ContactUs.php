<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactUs extends MY_Controller {
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['pageTitle'] = 'ContactUs';
		$this->load->view('view_ContactUs', $data);		
	}
}
