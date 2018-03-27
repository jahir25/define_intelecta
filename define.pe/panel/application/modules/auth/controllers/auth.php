<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('auth/auth_model');

        $data = $this->session->userdata('user_info');
        
           
    }

    public function load_login() {

        $this->load->view('auth/load_login', $this->data);
    }

    public function post_login() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
            exit(json_encode(array('status' => FALSE, 'message' => 'No se pudo completar la operación. 1')));

        if (!$this->input->is_ajax_request())
            exit(json_encode(array('status' => FALSE, 'message' => 'No se pudo completar la operación. 2')));
 

        $_username = $this->input->post('username', TRUE);
        $_password = $this->input->post('password', TRUE);

        $this->valid_login(trim($_username), trim($_password));

        if ($this->basicauth->login(trim($_username), trim($_password)))
            exit(json_encode(array('status' => TRUE, 'redirect' => base_url('dashboard'))));

        exit(json_encode(array('status' => FALSE, 'message' => 'El usuarios y/o contraseña son inválidos.')));
    }

    private function valid_login($_username, $_password) {
        if (empty($_username))
            exit(json_encode(array('status' => FALSE, 'message' => 'El username no puede estar en blanco.')));

        if (empty($_password))
            exit(json_encode(array('status' => FALSE, 'message' => 'El password no puede estar en blanck.')));
    }

    public function logout() {
        $this->basicauth->logout();
        redirect();
    }

    public function validate_session() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
            exit(json_encode(array('status' => FALSE, 'message' => 'No se pudo completar la operación.')));

        if (!$this->input->is_ajax_request())
            exit(json_encode(array('status' => FALSE, 'message' => 'No se pudo completar la operación.')));

        if (!$this->basicauth->verify_csrf($this->input->post('token', TRUE)))
            exit(json_encode(array('status' => FALSE, 'message' => 'No se pudo completar la operación.')));

        $_user_session = $this->session->userdata('user_info');
        if (!$_user_session)
            exit(json_encode(array('status' => TRUE)));

        exit(json_encode(array('status' => FALSE)));
    }

    public function is_logged_ajax() {
        $url = 'http://define.pe/panel/index.php/dashboard';
        if (!is_logged_in())
            exit(json_encode(array('status' => TRUE, 'redirect' =>  $url)));
        exit(json_encode(array('status' => FALSE)));
    }

}
