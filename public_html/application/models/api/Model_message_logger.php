<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	
	class Model_message_logger extends CI_Model{
		protected $tableName = "message_log";
		
		public function logMessage($data){
			try{
				//print_r($data); return;
				$default_record = [
					'message_type'     => $data['message_type'],
					'message_text'     => $data['message_text'],
					'mobile_numbers'   => $data['mobile_numbers'],
					'module'           => $data['module'],
					'total_count'      => count($data['mobile_numbers']),
					'sent_time'        => unix_timestamp(),
					'status'           => $data['status'],
					'gateway'          => $data['gateway'],
					'gateway_response' => $data['gateway_response'],
					'error_msg'        => $data['error_message'],
				];
				$query_result = $this->db->insert($this->tableName, $default_record);
				if(true === $query_result){
					return true;
				}
				else{
					return false;
				}
			}
			catch(Exception $e){
				return false;
			}
		}
	}