<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules extends MY_Controller {
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->posting();
	}
	
	public function posting(){
		$data['pageTitle'] = 'Rules And Condition';
		$this->load->view('view_rulePostingAds', $data);
	}
}
