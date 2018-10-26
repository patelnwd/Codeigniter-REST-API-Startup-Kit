<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

defined('FROM') OR define('FROM',"no-reply@domain.in");
defined('FROM_NAME') OR define('FROM_NAME',"Name");

class Email_lib{
    public $CI;
    public function __construct(){
        $this->CI = &get_instance();
        $this->CI->load->library(array('email'));
    }

    public function sendMailTo($to = array(), $subject, $html){
        try {
            $this->CI->email->from(FROM, FROM_NAME);
            $this->CI->email->to($to);
            $this->CI->email->subject($subject);
            $this->CI->email->message($html);
            //$this->email->attach('/path/to/file2.pdf');
            return $this->CI->email->send();
        }catch (Exception $e){
            return false;
        }
    }

    public function sendMailToCc($to = array(), $cc = array(), $subject, $html){
        try {
            $this->CI->email->from(FROM, FROM_NAME);
            $this->CI->email->to($to);
            $this->CI->email->cc($cc);
            $this->CI->email->subject($subject);
            $this->CI->email->message($html);
            //$this->email->attach('/path/to/file2.pdf');
            return $this->CI->email->send();
        }catch (Exception $e){
            return false;
        }
    }

    public function sendMailToCcBcc($to = array(), $cc = array(), $bcc = array(), $subject, $html){
        try {
            $this->CI->email->from(FROM, FROM_NAME);
            $this->CI->email->to($to);
            $this->CI->email->cc($cc);
            $this->CI->email->bcc($bcc);
            $this->CI->email->subject($subject);
            $this->CI->email->message($html);
            //$this->email->attach('/path/to/file2.pdf');
            return $this->CI->email->send();
        }catch (Exception $e){
            return false;
        }
    }

    public function sendMailToAdmin($subject, $html){
        try {
            $this->CI->email->from(FROM, FROM_NAME);
            $this->CI->email->to();
            $this->CI->email->subject($subject);
            $this->CI->email->message($html);
            //$this->email->attach('/path/to/file2.pdf');
            return $this->CI->email->send();
        }catch (Exception $e){
            return false;
        }
    }
}