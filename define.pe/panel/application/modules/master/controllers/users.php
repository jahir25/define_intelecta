<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Users extends CI_Controller {
    function __construct() {
        parent::__construct();
        _is_logged();
        $this->data['controller'] = strtolower(get_class($this));
        $this->load->model('master/users_model');
        $this->data['back_parameter'] = '?back_url=' . base64_encode(base_url(uri_string()));
        $this->data['back_url'] = base_url(uri_string());
    }

    /* PAGINATION */
    public function load_list($_token, $_like = '_woval', $_offset = 0) {
        _verify_csrf($_token);

        $_like = urldecode($_like);

        $_count = $this->users_model->get_count($_like);
        $this->data['pagination'] = _build_pagination(
                base_url('master/' . $this->data['controller'] . '/load_list/' . $this->data['csrf_token'] . '/' . $_like . '/'), $_count->count, 6, PAGINATION_LIMIT
        );

        $this->data['items_info'] = $this->users_model->get_pagination(
                PAGINATION_LIMIT, $_offset, "u.id, u.name as name,lastname,username, ,phone,email,ug.name as type", $_like
        );
        
        $this->data['offset'] = $_offset;
        $this->data['like'] = ($_like === '_woval') ? '' : $_like;

        $this->data['privileges'] = _getPrivileges();

        $this->load->view('master/' . $this->data['controller'] . '/load_list', $this->data);
    }

    /* END PAGINATION */

    public function load_add($_token) {

        _verify_csrf($_token);

        $this->data['back_url'] = base64_decode($this->input->get('back_url'));

        $_users_groups_info = $this->users_model->get_user_groups();
        $this->data['user_groups'] = _build_select_options($_users_groups_info, 'id', 'name');


       
 
        $this->load->view('master/' . $this->data['controller'] . '/load_add', $this->data);
    }

    public function load_update($_token = FALSE, $_id = FALSE) {

        _verify_csrf($_token);


        $_item_info = $this->users_model->get_by_id($_id);
        if (!$_item_info)
            _build_json();


        $this->data['back_url'] = base64_decode($this->input->get('back_url'));
        $_users_groups_info = $this->users_model->get_user_groups();
        $this->data['user_groups'] = _build_select_options($_users_groups_info, 'id', 'name', $_item_info->user_group_id);

        $this->data['item_info'] = $_item_info;

       
        
 
        $this->load->view('master/' . $this->data['controller'] . '/load_update', $this->data);
    }

    private function validate_post($_id = FALSE) {


        _is_post();
        _is_ajax_request();



        _verify_csrf($this->input->post('token', TRUE));


        if ($_id) {
            if (!$this->users_model->get_by_id($_id))
                _build_json(FALSE, array('message_identifier' => '_validate_if_exists_user_id'));
        }


        $_name = $this->input->post('name', TRUE);
        $_item_data['name'] = _validate_empty($_name, '#name', '_validate_empty_name');


        $_lastname = $this->input->post('lastname', TRUE);
        $_item_data['lastname'] = _validate_empty($_lastname, '#lastname', '_validate_empty_lastname');


        $_dni = trim($this->input->post('dni', TRUE));
        $_item_data['dni'] = _validate_numeric($_dni, '#dni', '_validate_empty_dni');
        $_item_data['dni'] = _validate_length($_dni, 8, '#dni', '_validate_length_dni');




        $_user_info = $this->users_model->get_by_dni($_dni);
        if ($_user_info)
            _validate_if_exists($_user_info, $_id, '#dni', '_validate_if_exists_dni');


        
        $_item_data['phone'] = trim($this->input->post('phone', TRUE));

        
        $_item_data['email'] = _isToupper($this->input->post('email', TRUE));


        $_user_group_id = trim($this->input->post('user_group_id', TRUE));

        $_item_data['user_group_id'] = _validate_empty($_user_group_id, '#user_group_id', '_validate_empty_user_group');



        $_username = trim($this->input->post('username', TRUE));
        $_item_data['username'] = _validate_empty($_username, '#username', '_validate_empty_username');

        
        $_user_group = $this->users_model->get_user_groups_by_id($_user_group_id);
        if (!$_user_group)
            _build_json(FALSE, array('id' => '#user_group_id','message_identifier' => '_validate_if_exists_user_group_id'));
        
        $_user_info_group = $this->users_model->get_registered_user_id_by_group($_username,$_user_group_id);

        if ($_user_info_group)
            _validate_if_exists($_user_info_group, $_id, '#username', '_validate_if_exists_username');
       

        if ($_id) {
            $_password = trim($this->input->post('password', TRUE));
            if ($_password !== '') 
                $_item_data['password'] = $this->basicauth->create_hash($_password);
            
        } else {
            $_password = trim($this->input->post('password', TRUE));
            $_item_data['password'] = _validate_empty($_password, '#password', '_validate_empty_password');

            $_item_data['password'] = $this->basicauth->create_hash($_password);
        }

      
        
        

        if (!$_id) {
            $_item_data['add_date'] = $this->data['current_date'];
            $_item_data['user_id'] = $this->data['logged_user_info']->id;
        }

        return $_item_data;
    }

    public function post_add() {

        $_item_data = $this->validate_post();


        if ($this->users_model->add($_item_data))
            _build_json(TRUE);


        _build_json();
    }

    public function post_update() {

        $_id = trim($this->input->post('id', TRUE));
        if (!is_numeric($_id))
            _build_json();


        $_item_data = $this->validate_post($_id);


        if ($this->users_model->update($_item_data, $_id))
            _build_json(TRUE);


        _build_json();
    }

    public function post_delete($_token = FALSE, $_id = FALSE) {

        _is_post();
        _is_ajax_request();
        _verify_csrf($_token);



        $_item_info = $this->users_model->get_by_id($_id);

        if (!$_item_info)
            _build_json();


        $_item_data = array(
            'state' => 99
        );


        if ($this->users_model->update($_item_data, $_item_info->id))
            _build_json(TRUE);

        _build_json();
    }

    









}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.p+hp */