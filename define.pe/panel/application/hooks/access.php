<?php

class Access {

    function create_csrf_token() {
        $this->CI = &get_instance();
        $this->CI->data['csrf_token'] = $this->CI->basicauth->create_csrf_token();
    }

    function initialize_data() {
        $this->CI = &get_instance();
        $_logged_user_info = $this->CI->session->userdata('user_info');
        if (!empty($_logged_user_info)) {
            $this->CI = &get_instance();
            $this->CI->data['logged_user_info'] = $this->CI->session->userdata('user_info');
        }
        $this->CI->data['current_date'] = date('Y-m-d H:i:s');

 

        $this->CI->data['add_date'] = date('Y-m-d');

        $this->CI->data['add_time'] = date('H:i:s');
    }

}
