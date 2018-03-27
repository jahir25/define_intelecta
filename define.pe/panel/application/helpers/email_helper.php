<?php

function send_email($email,$to, $name, $subject, $message) {

    $CI =& get_instance();
   
    
    $config = array(
        'crlf' => "\r\n",
        'newline' => "\r\n",
        'mailtype'  => 'html',
        'charset' => 'utf-8',
        'wordwrap' => TRUE,
        'mailtype' => 'html'
    );
    
    $CI->load->library('email');

    
    $CI->email->initialize($config);
    
    
    $CI->email->from($email, $name);
    $CI->email->to($to);
    $CI->email->subject($subject);
    $CI->email->message($message);

    
    return $CI->email->send();

}



