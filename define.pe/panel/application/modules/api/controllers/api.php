<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('master/contacto_model');
        
    }


 

    public function postAddContact() {
      
        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
            exit(json_encode(array('status'=>FALSE, 'message'=>'Error metodo post')));

        $_item_data['option']  = trim($this->input->post('exampleSelect1', TRUE));

        if(empty($_item_data['option']))
            exit(json_encode(array('status'=>FALSE, 'message'=>'Completar una opción')));


        $_item_data['name']  = trim($this->input->post('name', TRUE));

        if(empty($_item_data['name']))
            exit(json_encode(array('status'=>FALSE, 'message'=>'Completar Nombre')));
        
 
        $_item_data['phone'] = trim($this->input->post('tel', TRUE));

        if(empty($_item_data['phone']))
           exit(json_encode(array('status'=>FALSE, 'message'=>'Completar Teléfono')));
        
        $_item_data['email'] = $this->input->post('email', TRUE);
        if (!filter_var($_item_data['email'], FILTER_VALIDATE_EMAIL))
            exit(json_encode(array('status'=>FALSE, 'message'=>'Completar email válido')));


        $_item_data['message']  = trim($this->input->post('message', TRUE));

        if(empty($_item_data['message']))
            exit(json_encode(array('status'=>FALSE, 'message'=>'Completar el campo mensaje')));


        $_item_data['add_date'] = date('Y-m-d');
        $_item_data['user_id'] = 1;
 
        $result = $this->contacto_model->add($_item_data);

        if( $result ){
            
            $name = $_item_data['name'];
            $to = 'ventas@define.pe, yennifer@seek.pe';
            send_email($_item_data['email'], $to, $_item_data['name'],"Define formulario de contacto $name",
                $this->load->view('email/_emailContact', 
                    array(
                        'option' => $_item_data['option'],
                        'phone' => $_item_data['phone'],
                        'name' => $_item_data['name'],
                        'email' => $_item_data['email'],
                        'message'=> $_item_data['message']
                    ), TRUE)
            );

            _build_json(TRUE);
        }

        _build_json();


    }
  
    public function postAddNews() {
      
        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
            exit(json_encode(array('status'=>FALSE, 'message'=>'Error metodo post')));

      
        
        $_item_data['email'] = $this->input->post('email', TRUE);
        if (!filter_var($_item_data['email'], FILTER_VALIDATE_EMAIL))
            exit(json_encode(array('status'=>FALSE, 'message'=>'Completar email válido')));



        $_item_data['add_date'] = date('Y-m-d');
        $_item_data['user_id'] = 1;
 
        $result = $this->contacto_model->add($_item_data);

        $email = $_item_data['email'];
        if( $result ){
            $to = 'ventas@define.pe, yennifer@seek.pe';
           $r =  send_email($_item_data['email'],  $to , 'Contacto',"Nuevo suscriptor de $email",
                $this->load->view('email/_emailNews', 
                    array(
                        'email' => $email
                    ), TRUE)
            );
            
            _build_json(TRUE);
        }

        _build_json();


    }


    
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.p+hp */