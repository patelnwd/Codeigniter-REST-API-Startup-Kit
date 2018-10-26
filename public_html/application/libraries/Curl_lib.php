<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	
	class Curl_lib{
		public $mCurl;
		public $available_method = [
			'GET',
			'POST',
		];
		public $error;
		public $output;
		public $status;
		public $optArr;
		
		function _construct(){
			$this->error = 'none';
			$this->status = false;
			$this->output = [];
			$this->load->library([
				'encryption',
			]);
			$this->mCurl = [
				'method' => "GET",
			];
			$this->optArr = [
			];
		}
		
		function baseCurl($url, $postData = false){
			try{
				if(isset($url)){
					$ch = curl_init();
					// 2. set the options, including the url
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					if(false !== $postData){
						curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
						curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
					}
					// 3. execute and fetch the resulting HTML output
					$output = curl_exec($ch);
					// 4. free up the curl handle
					curl_close($ch);
					$this->status = true;
					$this->output = $output;
				}
				else{
					throw new Exception("Invalid URL supplied");
				}
			}
			catch(Exception $e){
				$this->status = false;
				$this->output = [];
				$this->error = $e->getMessage();
			}
		}

		public function process_login($username, $password, $key = false){
			$url = BASE_URL_API . "user/login_process";
			$postData = [
				'username'=>$username,
				'password'=>$password,
				'API_TOKEN'=>$key
			];
			$this->baseCurl($url, $postData);			
		}
	}