<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    /**
     * @param $length
     *
     * @return string
     */
    function generate_password($length, $special_char = false) {
        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
        $alphabet .= '1234567890';
        $alphabet .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if(true === $special_char){
            $alphabet .= '<@!~#$&*^>_=';
        }
        $pass = array (); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $alphabet = str_shuffle($alphabet);
            $pass[] = $alphabet[$n];
        }

        return implode($pass); //turn the array into a string
    }

    /**
     * @param $user_name
     * @param $email
     *
     * @return mixed
     */
    function createUserName($user_name, $email) {
        return $email;
        $em = explode("@", $email);
        $un = substr($user_name, 0, strlen($user_name) - 4);
        $userName = str_replace(array (' '), "", $un . $em[0]);

        return $userName;
    }

    function ind_date($format) {
        date_default_timezone_set('Asia/Kolkata');

        return date($format);
    }

    function unix_timestamp() {
        date_default_timezone_set('Asia/Kolkata');

        return time();
    }

    function readable_unix_date($unix_timestamp, $format = false) {
        if (false === $format) {
            $format = "d-M-Y";
        }

        return date($format, $unix_timestamp);
    }

    function parseLocation($location) {
        if ( !isset($location) || null === $location || '' === $location) {
            return "Unknown";
        }
        else {
            $ex = explode(",", $location);
            $final_location = [];
            foreach (array_reverse($ex) as $i => $address_unit) {
                $final_location[] = $address_unit;
                if ($i == 2) {
                    break;
                }
            }

            return implode(", ", array_reverse($final_location));
        }
    }

    function showPostedDate($unix_timestamp) {
        $date = date('Y-m-d');
        $unix_date = date('Y-m-d', $unix_timestamp);
        // Today ?
        if ($date == $unix_date) {
            return "Today";
        }
        else {
            return readable_unix_date($unix_timestamp);
        }
        /*// Yesterday ?
        $date_diff =
        if(){

        }
        else{
            return readable_unix_date($unix_timestamp);
        }*/
    }

    function getIP() {
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];
        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        }
        elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        }
        else {
            $ip = $remote;
        }

        return $ip;
    }

    function show($data) {
        echo "<pre>";
        print_r($data);
    }

    function getEmailLink($email) {
        $domain = explode('@', $email);
        if (isset($domain[1])) {
            return "http://" . $domain[1];
        }
        else {
            return "http://gmail.com";
        }
    }

    function getAddressStr($user_address_data) {
        $address = '';
        $len = count($user_address_data);
        $count = 0;
        foreach ($user_address_data as $a) {
            if (++$count == $len - 1) {
                break;
            }
            $address .= $a . ", ";
        }
        $address = trim($address, ", ");

        return $address;
    }

    function getNewOTP($length = 6) {
        //return "101112";
        $alphabet_small = 'abcdefghijklmnopqrstuvwxyz';
        $alphabet_big = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $number = '1234567890';
        $alphabets = [
            $alphabet_small,
            $alphabet_big,
            $number,
        ];
        $len = [
            strlen($alphabets[0]) - 1,
            strlen($alphabets[1]) - 1,
            strlen($alphabets[2]) - 1,
        ];
        $pass = []; //remember to declare $pass as an array
        for ($i = 0; $i < $length; $i++) {
            //$alpha_index = mt_rand(0,2); // all
            //$alpha_index = mt_rand(1,2); // A-Z and 0-9
            $alpha_index = 2; // 0-9 only
            $n = $len[$alpha_index];
            $pass[] = $alphabets[$alpha_index][mt_rand(0, $n)];
        }

        return implode($pass); //turn the array into a string
    }

    function getOTPMessage($OTP = false) {
        if (false === $OTP)
            $OTP = getNewOTP();
        return "Dear Customer," . PHP_EOL . "$OTP is your one time password (OTP). Please enter the OTP to proceed," . PHP_EOL . " and don't share with anyone. Thank you," . PHP_EOL . "Team " . COMPANY_NAME;
    }

    function getRegisterationMessage($user = false, $password = false) {
        if ($user && $password) {
            return "Dear Customer," . PHP_EOL . " Welcome to " . COMPANY_NAME . " Your account has been created with 33Ads. Youe User ID: $user and Password: $password, Please dont't share with others.";
        }
    }

    function secure_mobile_str($mobile_no) {
        $m_split = str_split($mobile_no);
        $secret_mobile = [];
        $len = count($m_split);
        for ($i = 0; $i < $len; $i++) {
            if (in_array($i, [
                2,
                3,
                5,
                6,
                7,
                8,
            ])) {
                $secret_mobile[] = "*";
            }
            else {
                $secret_mobile[] = $m_split[$i];
            }
        }

        return implode($secret_mobile);
    }

    function response($status, $message, $data) {
        $resp_arr = [
            'status' => $status,
            'msg'    => $message,
            'output' => $data,
        ];

        return json_encode($resp_arr);
    }

    function get_uploaded_image_json($uploaded_image_result, $http_url = false) {
        $img_path = [];
        if (true === $http_url) {
            foreach ($uploaded_image_result as $img) {
                $split_path = explode("uploads/", $img['full_path']);
                $img_path[] = base_url("images/uploads/" . $split_path[1]);
            }
        }
        else {
            foreach ($uploaded_image_result as $img) {
                $img_path[] = $img['full_path'];
            }
        }
        if (count($img_path) === 0) {
            $img_path = [
                dummy_image(),
                dummy_image(),
                dummy_image(),
                dummy_image(),
            ];
        }

        return json_encode($img_path);
    }

    function dummy_image($type = false) {
        if (false !== $type) {
            switch ($type) {
                case 'F_DP':
                    return base_url("images/generic/user-female-icon.png");
                    break;
                case 'M_DP':
                    return base_url("images/generic/user-male-icon.png");
                    break;
                default:
                    return base_url("images/generic/post_image.png");
            }
        }
        else {
            return base_url("images/generic/post_image.png");
        }
    }

    function getDefaultPassword($str = false) {
        if (false == $str) {
            return "Pass123";
        }
        else {
            return $str;
        }
    }

    function defaultMobileNo() {
        return 9999999999;
    }

    function defaultEmail() {
        return "demo@ads.in";
    }

    function detectLoginWith($username) {
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        }
        elseif (preg_match('/^[789]{1}[0-9]{9}$/', $username)) {
            return 'mobile';
        }
        else {
            return 'username';
        }
    }

    function logger($data, $file = 'default') {
        try {
            $log_path = APPPATH . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . $file . '.log';
            $file = fopen($log_path, 'a');
            fputs($file, "LOCAL LOGGER: " . date('d-m-Y H:i:s') . " - " . print_r($data, true) . PHP_EOL);
            fclose($file);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

