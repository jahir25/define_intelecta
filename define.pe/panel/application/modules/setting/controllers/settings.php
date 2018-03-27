<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('setting/settings_model');

        $this->load->helper('auth/auth');

        $this->data['controller'] = strtolower(get_class($this));

        _is_logged();
    }

    public function load_update($_token) {

        _verify_csrf($_token);

        $_item_info = $this->settings_model->get();
        if (!$_item_info)
            _build_json();

        $this->data['item_info'] = $_item_info;
        $this->load->view('process/' . $this->data['controller'] . '/load_update', $this->data);
    }

    public function post_update() {

        $_id = trim($this->input->post('id', TRUE));
        if (!is_numeric($_id))
            _build_json();


        $_item_data = $this->validate_post($_id);


        if ($this->settings_model->update($_item_data, $_id))
            _build_json(TRUE,array('message' => 'Se actualizó la Configuración'));


        _build_json();
    }

    private function validate_post($_id = FALSE) {

        _is_post();
        _is_ajax_request();
        _verify_csrf($this->input->post('token', TRUE));


        if ($_id)
            if (!$this->settings_model->get_by_id($_id))
                _build_json();


        $_type = $this->input->post('tax', TRUE);
        $_item_data['tax'] = _validate_numeric($_type, '#tax', '_validate_not_tax');


        $_serie_factura = $this->input->post('serie_factura', TRUE);
        $_item_data['serie_factura'] = _validate_empty($_serie_factura, '#serie_factura', '_validate_empty_serie_factura');

        $_serie_boleta = $this->input->post('serie_boleta', TRUE);
        $_item_data['serie_boleta'] = _validate_empty($_serie_boleta, '#serie_boleta', '_validate_empty_serie_boleta');

        $_serie_ticket = $this->input->post('serie_ticket', TRUE);
        $_item_data['serie_ticket'] = _validate_empty($_serie_ticket, '#serie_ticket', '_validate_empty_serie_ticket');

        $_code_ticketera = $this->input->post('code_ticketera', TRUE);
       
        $_item_data['code_ticketera'] = _validate_empty($_code_ticketera, '#code_ticketera', '_validate_empty_ticketera');


        $_company = $this->input->post('company', TRUE);

        $_item_data['company'] = _validate_empty($_company, '#company', '_validate_empty_company');

        $_ruc = $this->input->post('ruc', TRUE);
        
        $_item_data['ruc'] = _validate_numeric($_ruc, '#ruc', '_validate_numeric_ruc');

        $_item_data['ruc'] = _validate_length($_ruc, 11, '#ruc', '_validate_length_ruc');

        $_item_data['ruc'] = _validate_ruc($_ruc, '#ruc', '_validate_format_ruc');



        $_manager = $this->input->post('manager', TRUE);
        $_item_data['manager'] = _validate_empty($_manager, '#manager', '_validate_empty_company');

        $_address = $this->input->post('address', TRUE);
        $_item_data['address'] = _validate_empty($_address, '#address', '_validate_empty_address');

        $_phone = $this->input->post('phone', TRUE);
        $_item_data['phone'] = _validate_numeric($_phone, '#phone', '_validate_empty_phone');

        return $_item_data;
    }

}

/* End of file guides.php */
/* Location: ./application/controllers/process/guides.p+hp */