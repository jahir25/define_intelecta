<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('_is_logged')) {

    function _is_logged() {
        $CI = &get_instance();


     
        

        $_user_session = $CI->session->userdata('user_info');
        if (!$_user_session) {
            if ($CI->input->is_ajax_request())
                _build_json(FALSE);
            else
                redirect();
        }
    }

}


if (!function_exists('is_logged_in')) {

    function is_logged_in() {
        $CI = &get_instance();
        $_user_session = $CI->session->userdata('user_info');

        if ($_user_session)
            return TRUE;

        return FALSE;
    }

}

