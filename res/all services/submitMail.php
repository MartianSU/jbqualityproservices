<?php

    $btnSendMail = $_POST['submitMail'];

    if(isset($btnSendMail)){
        
        $nameClient = $_POST['nameClient'];
        $email = $_POST['email'];
        $message = $_POST['emailSubject'];

        if($nameClient !== "" || $email !== "" || $message !== ""){
            senEmail($nameClient,$email,$message);
        }
    }

    function senEmail($nameClient_,$email_,$message_){
        $mensaje = wordwrap($message_,70,"\r\n");

        $para = "igneodigital@pm.me";

        $asunto = "Información del cliente, obtenido del sitio web Igneo";
        $from_email = filter_var($email_, FILTER_SANITIZE_EMAIL);

        $cabeceras = "MIME-Version: 1.0\r\n";

        if(filter_var($from_email, FILTER_VALIDATE_EMAIL)){        
            $cabeceras .= "Content-type: text/html; chartset=iso-utf-8\r\n";
            $cabeceras = "From: " . $nameClient_ . "<" . $email_ . ">";
            $exito = mail($para,$asunto,$mensaje,$cabeceras);
            if($exito){
                echo "<script> alert('message sent successfully...'); 
                    window.location.replace('index.html');</script>";
            }else{
                echo "<script> alert('Unable to send message, there was a sending error...Please try again'); 
                    window.location.replace('index.html');</script>";
            }
        }else{
            echo "<script> alert('The email address is not valid...insert a valid address.'); 
                window.location.replace('index.html');</script>";
        } 
    }
?>
