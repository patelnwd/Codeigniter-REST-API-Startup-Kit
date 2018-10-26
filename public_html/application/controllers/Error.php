<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends MY_Controller {
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['pageTitle'] = 'Error';
		$this->load->view('MY_error/view_error_404', $data);
	}
}
