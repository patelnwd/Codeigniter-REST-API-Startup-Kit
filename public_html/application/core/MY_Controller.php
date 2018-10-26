<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    
    class MY_Controller extends CI_Controller {
        function __construct () {
            parent::__construct();
        }
        
        public function is_logged_in ($user) {
            $user = $this->session->userdata($user);
            if ( !isset($user)) {
                return false;
            }
            else {
                return true;
            }
        }
        
        public function showData ($data, $data_type = false) {
            echo "<pre>";
            if (true === $data_type) {
                var_dump($data);
            }
            else {
                print_r($data);
            }
        }
        
        public function log ($data, $file = 'default') {
            return logger($data, $file);
            /*try {
                $log_path = APPPATH . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . $file . '.log';
                $file = fopen($log_path, 'a');
                fputs($file, "LOCAL LOGGER: ".date('d-m-Y H:i:s')." - ".print_r($data, true) . PHP_EOL);
                fclose($file);
                
                return true;
            } catch (Exception $e) {
                return false;
            }*/
        }
    }
