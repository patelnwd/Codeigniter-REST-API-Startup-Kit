<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentation extends CI_Controller {	
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
    }

	public function index(){
        $filePath = str_replace("public_html","",$_SERVER['CONTEXT_DOCUMENT_ROOT']).'Docs/sample-request.json';
        $data = [
            'api_list' => json_decode(file_get_contents($filePath))->item
        ];
		$this->load->view('api-demo/view_documentation', $data);
	}
}
