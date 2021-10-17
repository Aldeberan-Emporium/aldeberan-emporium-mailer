<?php
    require "vendor/autoload.php";

    $mail = new PHPMailer(true);   
    $userEmail = $_GET['email'];
    $userName = $_GET['name'];
    /*
    $orderRef = $_GET['ref'];
    $orderItems = $_GET['items'];
    $orderAddress = $_GET['address'];
    */
    try {
        //Server settings
        $mail->isSMTP();                                     
        $mail->Host       = 'smtp.gmail.com';               
        $mail->SMTPAuth   = true;                                
        $mail->Username   = getenv("USERNAME");     
        $mail->Password   = getenv("PASSWORD");             
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port = 465;                                   

        //Send Email
        $mail->setFrom(getenv("USERNAME"), 'Aldeberan Emporium');

        //Recipients           
        $mail->addAddress($userEmail, $userName); 

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Thank you for purchasing with Aldeberan Emporium!';
        $mail->Body    = 'Dear'.$userName.',<br/>Here are your order details,<br/>';
        $mail->send();
    } catch (Exception $e) {}     
?> 