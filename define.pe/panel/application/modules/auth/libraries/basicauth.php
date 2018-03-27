<?php

define("PBKDF2_HASH_ALGORITHM", "sha256");
define("PBKDF2_ITERATIONS", 1000);
define("PBKDF2_SALT_BYTE_SIZE", 24);
define("PBKDF2_HASH_BYTE_SIZE", 24);

define("HASH_SECTIONS", 4);
define("HASH_ALGORITHM_INDEX", 0);
define("HASH_ITERATION_INDEX", 1);
define("HASH_SALT_INDEX", 2);
define("HASH_PBKDF2_INDEX", 3);

class Basicauth {

    function __construct() {
        $this->CI = &get_instance();
    }
    public function create_csrf_token() {

        $CI = & get_instance();
        if ($CI->session->userdata('csrfToken')) {
            $csrfHash = $CI->session->userdata('csrfToken');
        } else {
            $csrfHash = md5(uniqid(rand(), TRUE));
            $CI->session->set_userdata(array('csrfToken' => $csrfHash));
        }
        return $csrfHash;
    }

    public function verify_csrf($token) {

        $CI = & get_instance();
        if ($CI->session->userdata('csrfToken') && $CI->session->userdata('csrfToken') == $token)
            return TRUE;
        else
            return FALSE;
    }

    public function login($username, $password) {

        $_user_info = $this->CI->auth_model->get_user_by_username($username);

        if ($_user_info) {

            if ($this->validate_password($password, $_user_info->password)) {
                $_user_info->logged_in = TRUE;

                $_user_info->info_group = FALSE;

                $_group_info  = $this->CI->auth_model->get_user_groups_by_id($_user_info->user_group_id);

                if ($_group_info) 
                    $_user_info->info_group = $_group_info;
                

                
                

                $this->CI->session->set_userdata('user_info', $_user_info);
                return TRUE;
            }
        }

        return FALSE;
    }

    public function logout() {
        $this->CI->session->set_userdata('user_info', array());
    }

    public function create_hash($password) {
        // format: algorithm:iterations:salt:hash
        $salt = base64_encode(mcrypt_create_iv(PBKDF2_SALT_BYTE_SIZE, MCRYPT_DEV_URANDOM));
        return PBKDF2_HASH_ALGORITHM . ":" . PBKDF2_ITERATIONS . ":" . $salt . ":" .
                base64_encode($this->pbkdf2(
                                PBKDF2_HASH_ALGORITHM, $password, $salt, PBKDF2_ITERATIONS, PBKDF2_HASH_BYTE_SIZE, true
        ));
    }

    private function validate_password($password, $correct_hash) {
        $params = explode(":", $correct_hash);
        if (count($params) < HASH_SECTIONS)
            return FALSE;
        $pbkdf2 = base64_decode($params[HASH_PBKDF2_INDEX]);
        return $this->slow_equals(
                        $pbkdf2, $this->pbkdf2(
                                $params[HASH_ALGORITHM_INDEX], $password, $params[HASH_SALT_INDEX], (int) $params[HASH_ITERATION_INDEX], strlen($pbkdf2), TRUE
                        )
        );
    }

    private function slow_equals($a, $b) {
        $diff = strlen($a) ^ strlen($b);
        for ($i = 0; $i < strlen($a) && $i < strlen($b); $i++) {
            $diff |= ord($a[$i]) ^ ord($b[$i]);
        }
        return $diff === 0;
    }

    private function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false) {
        $algorithm = strtolower($algorithm);
        if (!in_array($algorithm, hash_algos(), true))
            trigger_error('PBKDF2 ERROR: Invalid hash algorithm.', E_USER_ERROR);
        if ($count <= 0 || $key_length <= 0)
            trigger_error('PBKDF2 ERROR: Invalid parameters.', E_USER_ERROR);

        if (function_exists("hash_pbkdf2")) {
            // The output length is in NIBBLES (4-bits) if $raw_output is false!
            if (!$raw_output) {
                $key_length = $key_length * 2;
            }
            return hash_pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output);
        }

        $hash_length = strlen(hash($algorithm, "", true));
        $block_count = ceil($key_length / $hash_length);

        $output = "";
        for ($i = 1; $i <= $block_count; $i++) {
            // $i encoded as 4 bytes, big endian.
            $last = $salt . pack("N", $i);
            // first iteration
            $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
            // perform the other $count - 1 iterations
            for ($j = 1; $j < $count; $j++) {
                $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
            }
            $output .= $xorsum;
        }

        if ($raw_output)
            return substr($output, 0, $key_length);
        else
            return bin2hex(substr($output, 0, $key_length));
    }

}
