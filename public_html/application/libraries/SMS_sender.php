<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	defined('AUTH_KEY') OR define('AUTH_KEY', 'xxxxxxxxxxxxxxxxxxxxxxxxx');
	defined('SENDER_ID') OR define('SENDER_ID', 'xxxxxxxxxxxxxx');
	defined('DEFAULT_GATEWAY') OR define('DEFAULT_GATEWAY', 'MSG91');


	/**
	 * Class SMS_sender
	 * Written By MUKESH PATEL
	 * Date: 08/Sept/2017
	 */
	class SMS_sender{
		public $result = [];
		public $CI;
		public $valid_call;
		public $module;
		public $LISTED_GATEWAY = [
			'MSG91' => [
				'AUTH_KEY' => AUTH_KEY,
				'CAMPAIGN' => 'General',
			],
		];

		function __construct(){
			$this->CI =& get_instance();
			$this->CI->load->model('api/Model_message_logger');
			$this->valid_call = false;
			$this->result = [
				'STATUS'           => false,
				'GATEWAY'          => DEFAULT_GATEWAY,
				'GATEWAY_RESPONSE' => [
					"message" => "gateway not called till now",
					"type"    => "break",
				],
				'ERROR'            => 'none',
				'DB_LOG'           => false,
			];
			$this->setModule("General");
		}

		/**
		 * @param      $mobile_number_arr
		 * @param      $message_str
		 * @param bool $gateway
		 * @param bool $campaign
		 *
		 * @return bool
		 */
		public function send($mobile_number_arr, $message_str, $gateway = false, $campaign = false){
			try{
				/** @var TYPE_NAME $gateway */
				if(false === $gateway){
					$gateway = DEFAULT_GATEWAY;
				}
				if(false === array_key_exists($gateway, $this->LISTED_GATEWAY)){
					throw new Exception("Unknown Gateway, Gateway ($gateway) not listed here", 1);
				}
				elseif(false === is_array($mobile_number_arr)){
					throw new Exception("Mobile no should be in array type", 1);
				}
				elseif(strlen($message_str) < 1){
					throw new Exception("Message is empty", 1);
				}
				/** @var TYPE_NAME $mobile_number_arr */
				elseif(false === $this->validateMobiles($mobile_number_arr)){
					throw new Exception($this->result['ERROR'], 1);
				}
				else{
					switch($gateway){
						case 'MSG91':
							$this->result['GATEWAY'] = $gateway;
							$this->valid_call = true;
							$message_to_array = [
								[
									'message' => $message_str,
									'to'      => $mobile_number_arr,
								],
							];
							$gateway_resp = $this->sendToMsgSocket($message_to_array);
							$sent_success = false;
							if($gateway_resp){
								$sent_success = $this->verifyGatewayResp($this->result['GATEWAY_RESPONSE'], $gateway);
							}
							if(true === $gateway_resp && true === $sent_success){
								$record = [
									'message_type'     => "General",
									'message_text'     => $message_str,
									'mobile_numbers'   => json_encode($mobile_number_arr),
									'module'           => $this->module,
									'status'           => true,
									'gateway'          => $this->result['GATEWAY'],
									'gateway_response' => json_encode($this->result['GATEWAY_RESPONSE']),
									'error_message'    => $this->result['ERROR'],
								];
								//print_r($record);
								$result = $this->CI->Model_message_logger->logMessage($record);
								$this->result['DB_LOG'] = $result;
								$this->result['STATUS'] = true;

								return true;
							}
							else{
								throw new Exception($this->result['ERROR'], 1);
							}
							break;
						default:
							throw new Exception("Unknown Gateway, Gateway ($gateway) not listed here", 1);
							break;
					}
				}
			}
			catch(Exception $e){
				$this->result['ERROR'] = $e->getMessage();
				$record = [
					'message_type'     => "General",
					'message_text'     => $message_str,
					'mobile_numbers'   => json_encode($mobile_number_arr),
					'status'           => false,
					'module'           => $this->module,
					'gateway'          => $this->result['GATEWAY'],
					'gateway_response' => json_encode($this->result['GATEWAY_RESPONSE']),
					'error_message'    => $this->result['ERROR'],
				];
				$result = $this->CI->Model_message_logger->logMessage($record);
				$this->result['DB_LOG'] = $result;

				return false;
			}
		}

		/**
		 * @param $mobile_arr
		 *
		 * @return bool
		 */
		public function validateMobiles($mobile_arr){
			try{
				foreach($mobile_arr as $index => $mobile_no){
				    logger($mobile_no);
					if( !preg_match("/^[789]\d{9}$/", $mobile_no)){
						throw new Exception("Invalid Mobile No found at [" . ++$index . "], please use indian mobile no only", 1);
					}
				}

				//$this->mobile_numbers = implode(",", $mobile_arr);
				return true;
			}
			catch(Exception $e){
				$this->result['ERROR'] = $e->getMessage();

				return false;
			}
		}

		/**
		 * Main Function which has been called after all check and validation form our side.
		 *
		 * @param  [array of array] $message_to_array [this should be an associative array with 'message' and 'to' key]
		 * 'message': "contain Plain text for message"
		 * 'to': contain an array of mobile no without country code.
		 * e.g. $message_to_array = ['message'=>"plain text",'to'=>['7867XXXXX','8789576XXX']]
		 *
		 * @return bool
		 * [true or false, set gateway_response if success and set error if fails]
		 */
		public function sendToMsgSocket($message_to_array){
			if( !$this->valid_call){
				$this->result['ERROR'] = "You can't call Socket directly";

				return false;
			}
			else{
				// print_r($message_to_array); return false;
				$url = "http://api.msg91.com/api/v2/sendsms";
				$curl = curl_init();
				$body = [
					"sender"  => SENDER_ID,
					"route"   => "4",
					"country" => "91",
					"sms"     => $message_to_array,
				];
				$body_json = json_encode($body);
				curl_setopt_array($curl, [
					CURLOPT_URL            => "$url",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_CUSTOMREQUEST  => "POST",
					CURLOPT_POSTFIELDS     => $body_json,
					CURLOPT_HTTPHEADER     => [
						"authkey: " . AUTH_KEY,
						"content-type: application/json",
					],
				]);

				/*$response = json_encode([
					"message" => "59ae2b9e8af9099f138b4585",
					"type"    => "success",
				]);*/
				$response = curl_exec($curl);
				/*$response = json_encode([
					"message" => "Dummy Result Error",
					"type"    => "error",
					"code"    => "205",
				]);*/
				$resp_decode = json_decode($response, true);
				// print_r($resp_decode);
				$err = curl_error($curl);
				curl_close($curl);
				if($err){
					$this->result['ERROR'] = $err;

					return false;
				}
				else{
					$this->result['GATEWAY_RESPONSE'] = $resp_decode;

					return true;
				}
			}
		}

		public function verifyGatewayResp($gateway_resp, $gateway){
			$resp_decode = $gateway_resp;
			if(isset($resp_decode['type']) && $resp_decode['type'] === 'success'){
				$this->result['STATUS'] = true;

				return true;
			}
			else if(isset($resp_decode['type']) && $resp_decode['type'] === 'error'){
				$this->result['ERROR'] = $this->getErrorCodeMessage($resp_decode['code']);

				return false;
			}
		}

		/**
		 * @param $error_code
		 *
		 * @return mixed|string
		 */
		public function getErrorCodeMessage($error_code){
			$error_message_code = [
				// Missing Parameter
				'101' => 'Missing mobile no',
				'102' => 'Missing message',
				'103' => 'Missing sender ID',
				'104' => 'Missing username',
				'105' => 'Missing password',
				'106' => 'Missing Authentication Key',
				'107' => 'Missing Route',
				// Invalid Parameter
				'202' => 'Invalid mobile number. You must have entered either less than 10 digits or there is an alphabetic character in the mobile number field in API',
				'203' => 'Invalid sender ID. Your sender ID must be 6 characters, alphabetic',
				'207' => 'Invalid authentication key. Crosscheck your authentication key from your account’s API section',
				'208' => 'IP is blacklisted. We are getting SMS submission requests other than your whitelisted IP list',
				// Error Codes
				'205' => 'This route is dedicated for high traffic. You should try with minimum 20 mobile numbers in each request',
				'209' => 'Default Route for dialplan not found',
				'210' => 'Route could not be determined',
				'301' => 'Insufficient balance to send SMS',
				'302' => 'Expired user account. You need to contact your account manager.',
				'303' => 'Banned user account',
				'306' => 'This route is currently unavailable. You can send SMS from this route only between 9 AM - 9 PM.',
				'307' => 'Incorrect scheduled time',
				'308' => 'Campaign name cannot be greater than 32 characters',
				'309' => 'Selected group(s) does not belong to you',
				'310' => 'SMS is too long. System paused this request automatically.',
				'311' => 'Request discarded because same request was generated twice within 10 seconds',
				'418' => 'IP is not whitelisted',
				'505' => 'Your account is a demo account. Please contact support for details',
				'506' => 'Small campaign limit exceeded. (only 20 campaigns of less than 100 SMS in 24 hours can be sent, exceeding it will show the error)',
				// System errors
				'001' => 'Unable to connect database',
				'002' => 'Unable to select database',
				'601' => 'Internal error.Please contact support for details',
			];
			$error_message = isset($error_message_code[$error_code]) ? $error_message_code[$error_code] : "UnKnown Error Code [" . $error_code . "]";

			return $error_message;
		}

		public function setModule($module){
			$this->module = ucwords($module);
		}
	}