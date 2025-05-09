<?php

    $btnSendMail = $_POST['submitMail'];

    if(isset($btnSendMail)){
        
        $nameClient = $_POST['nameClient'];
        $email = $_POST['email'];
        $cxmail = $_POST['cxemail'];
        $date = $_POST['date'];
        $phone = $_POST['phone'];
        $message = $_POST['emailSubject'];
        
        

        if($nameClient !== "" || $email !== "" || $message !== ""){
            senEmail($nameClient,$email,$cxmail,$date,$phone,$message);
        }
    }

    function senEmail($nameClient_,$email_,$cxmail_,$date_,$phone_,$message_){
        if($phone_){$message_ .= "\nPhone number: " . $phone_ . "\n";}
        if($cxmail_){$message_ .= "\nCustomer Email Address: " . $cxmail_ . "\n";}
        if($date_){$message_ .= "\nContact me this day: " . $date_ . "\n";}
        $mensaje = wordwrap($message_,70,"\r\n");

        $para = "jbqualityproservices@gmail.com";

        $asunto = "🔔️✉️ A new message from your website jbqualityproservices.com ✉️🔔️";
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
