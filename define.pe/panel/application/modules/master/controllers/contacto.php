<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contacto extends CI_Controller {

   
    function __construct() {
        parent::__construct();
        _is_logged();

        $this->data['controller'] = strtolower(get_class($this));

        $this->load->model('master/contacto_model');
    
    }

     public function load_list($_token) {
        _verify_csrf($_token);

         $this->load->view('master/' . $this->data['controller'] . '/load_list', $this->data);
    }

     public function load_ajax()
    {


        $column_order =  array(null, 'option','name', 'phone','email','message','add_date'); 
        $column_search =      array('option','name', 'phone','email','message','add_date'); 


        $_post = $this->input->post();
        $list = $this->contacto_model->get_datatables($_post,$column_order,$column_search );
        $data = array();
        $no = $_post['start'];
        foreach ($list as $pos) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $pos->option;
            $row[] = $pos->name;
            $row[] = $pos->phone;
            $row[] = $pos->email;
            $row[] = $pos->message;
            $row[] = _format_date($pos->add_date, 'd/m/Y');
            $row[] = $pos->id;
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_post['draw'],
                        "recordsTotal" => $this->contacto_model->count_all(),
                        "recordsFiltered" => $this->contacto_model->count_filtered($_post,$column_order,$column_search),
                        "data" => $data,
                );
     
        exit(json_encode($output));
    }
 

    public function modal_details()
    {
        _verify_csrf($this->input->post('token',TRUE));

        $_id = $this->input->post('id',TRUE);

 
        $this->data['item_info'] = $this->contacto_model->get_by_id( $_id);
       

        $_html = $this->load->view('master/' . $this->data['controller'] . '/modal_details', $this->data,TRUE); 

        _build_json(TRUE, array('html' =>$_html ));

         
    }






}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.p+hp */
