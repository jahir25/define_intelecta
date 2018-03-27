<?php

 
    
    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = 'Contacto';
        // Get the form fields and remove whitespace.
        // $name = strip_tags(trim($_POST["name"]));
				// $name = str_replace(array("\r","\n"),array(" "," "),$name);
        // $message = trim($_POST["message"]);
       
        $email = trim($_POST["email"]);
        if(empty($email))
            exit(json_encode(array('status'=>FALSE,'message'=>'Correo correo')));

        // Check that data was sent to the mailer.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            exit(json_encode(array('status'=>FALSE,'message'=>'Correo incorrecto')));

      
        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "ventas@define.pe";
        //$recipient = "htrigoso@seek.pe";

        // Set the email subject.
        $subject = "Nuevo suscriptor desde $name";

        // Build the email content.
        $email_content = "Email: $email\n";
        // $email_content = "Name: $name\n";
        // $email_content .= "Message:\n$message\n";

        // Build the email headers.

        $email_headers = "From: $name <$email>\r\n";
        $email_headers .= "Bcc: Define Seek <define@seek.pe>\r\n";

        // Send the email.
        if (@mail($recipient, $subject, $email_content, $email_headers)) 
            exit(json_encode(array('status'=>TRUE,'message'=>'Correo enviado')));
        else
            exit(json_encode(array('status'=>FALSE,'message'=>'Error al enviar correo')));


    } else {
        exit(json_encode(array('status'=>FALSE,'message'=>'Acceso no permitido')));
    }

?>
