<?php
	defined('BASEPATH') OR exit('No direct script access allowed');


	class Homepage extends MY_Controller{
		function __construct(){
			parent::__construct();
			// $this->load->model('api/Model_ads');
			// $this->load->model('api/Model_user');
		}

		/*public function index(){
			$data['pageTitle'] = 'Homepage';
			$data['search_input'] = [
				'location'    => "",
				'cat'         => "",
				'search_text' => "",
			];
			// $data['latest_ads'] = $this->Model_ads->getLatestAd();
			// $data['latest_user'] = $this->Model_user->getLatestuser();
			// $data['user_loggedin'] = $this->session->has_userdata('current_user');
			$this->load->view('view_Homepage', $data);
		}*/

		public function index(){
			$data['pageTitle'] = 'Homepage';
			$this->load->view('view_Homepage_new', $data);
		}
	}
