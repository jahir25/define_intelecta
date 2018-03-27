<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        _is_logged();
        $this->data['controller'] = 'dashboard';
    }

    public function load_dashboard() {
        $this->load->model('master/users_model');
        
        $this->data['privileges'] = _getPrivileges();

        $this->load->view($this->data['controller'] . '/load_dashboard', $this->data);
    }

    public function load_list($_token) {

        _verify_csrf($_token);


        $this->data['item_privileges'] = _getPrivileges();



        $this->load->view($this->data['controller'] . '/load_list', $this->data);
    }

    public function online($_token = '') {

        _verify_csrf($_token);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.p+hp */