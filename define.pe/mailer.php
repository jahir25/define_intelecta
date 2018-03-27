<?php

    // My modifications to mailer script from:
    // http://blog.teamtreehouse.com/create-ajax-contact-form
    // Added input sanitizing to prevent injection

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        // $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $exampleSelect1 = strip_tags(trim($_POST["exampleSelect1"]));
        $name = strip_tags(trim($_POST["name"]));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $tel = trim($_POST["tel"]);
        $message = trim($_POST["message"]);

        // Check that data was sent to the mailer.
        if ( empty($exampleSelect1) OR empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($tel) OR empty($message))
            exit(json_encode(array('status'=>FALSE,'message'=>'Completar los campos')));
          
        
 
        $recipient = "ventas@define.pe";
       
        $subject = "Define formulario de contacto $name";

        
        $email_content = "Vivanco: $exampleSelect1\n\n";
        $email_content .= "Celular: $tel\n\n";
        $email_content .= "Nombre: $name\n\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Message:\n$message\n";

        
        $email_headers = "From: $name <$email>\r\n";
        $email_headers .= "Bcc: Define Seek <define@seek.pe>\r\n";

       
        if (@mail($recipient, $subject, $email_content, $email_headers)) 
            exit(json_encode(array('status'=>TRUE,'message'=>'Correo enviado')));
        else
            exit(json_encode(array('status'=>FALSE,'message'=>'Error al enviar correo')));
        

    } else {
         exit(json_encode(array('status'=>FALSE,'message'=>'Acceso no permitido')));
    }

?>
