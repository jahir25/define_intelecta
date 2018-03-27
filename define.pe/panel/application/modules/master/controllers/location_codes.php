<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Location_codes extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('master/location_codes_model');

        $this->load->helper('auth/auth');

        $this->data['controller'] = 'location_codes';

        _is_logged();
    }

    public function post_load_provinces() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
            _build_json(FALSE);

        if (!$this->input->is_ajax_request())
            _build_json(FALSE);

        if (!$this->basicauth->verify_csrf($this->input->post('token', TRUE)))
            _build_json(FALSE);


        $this->load->model('master/location_codes_model');

        $_id = $this->input->post('id', TRUE);
        if (!$this->location_codes_model->get_department_by_id($_id))
            _build_json(FALSE);


        $_provinces = $this->location_codes_model->get_provinces($_id);
        _build_json(TRUE, array('html' => _build_select_options($_provinces, 'id', 'name')));
    }

    public function post_load_districts() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
            _build_json(FALSE);

        if (!$this->input->is_ajax_request())
            _build_json(FALSE);

        if (!$this->basicauth->verify_csrf($this->input->post('token', TRUE)))
            _build_json(FALSE);

        $this->load->model('master/location_codes_model');

        $_id = $this->input->post('id', TRUE);
        if (!$this->location_codes_model->get_province_by_id($_id))
            _build_json(FALSE);

        $_districts = $this->location_codes_model->get_districts($_id);

        _build_json(TRUE, array('html' => _build_select_options($_districts, 'id', 'name')));
    }


     public function post_load_cities() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
            _build_json(FALSE);

        if (!$this->input->is_ajax_request())
            _build_json(FALSE);

        if (!$this->basicauth->verify_csrf($this->input->post('token', TRUE)))
            _build_json(FALSE);


        $this->load->model('master/location_codes_model');

        $_id = $this->input->post('id', TRUE);
        if (!$this->location_codes_model->get_countries_by_id($_id))
            _build_json(FALSE);


        $_cities = $this->location_codes_model->get_cities_by_country_id($_id);
        _build_json(TRUE, array('html' => _build_select_options($_cities, 'id', 'name')));



        
    }















}

/* End of file welcome.php */

/* Location: ./application/controllers/Buildings.p+hp */