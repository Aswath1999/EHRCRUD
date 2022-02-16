<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link bootstrap file -->
    <link rel="stylesheet" href="<?php echo $ROOT ?>css/bootstrap.min.css">
    <!-- Font awesome css -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" 
    <!-- date picker css -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <!-- link custom css file -->
    <link rel="stylesheet" href="<?php echo $ROOT ?>css/styles.css">
    <title>EHR</title>
</head>
<body>
    <?php 
        require_once __DIR__.'/../config.php'; 
        // start session
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        require_once __DIR__ . '/../PHPMailer/PHPMailer/src/Exception.php';
        require_once __DIR__ . '/../PHPMailer/PHPMailer/src/PHPMailer.php';
        require_once __DIR__ . '/../PHPMailer/PHPMailer/src/SMTP.php';

        function sendmail($to,$from, $subject, $message){

            // SEND MAIL by PHP MAILER
            $mail = new PHPMailer();
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP(); // Use SMTP protocol
            // $mail->SMTPDebug = 2;
            $mail->Host = 'smtp.gmail.com'; // Specify  SMTP server
            $mail->SMTPAuth = true; // Auth. SMTP
            $mail->Username = your email id // Mail who send by PHPMailer
            $mail->Password = your password; // your pass mail box
            $mail->SMTPSecure = 'tls'; // Accept SSL
            $mail->Port = 587; // port of your out server
            $mail->setFrom($from); // Mail to send at
            $mail->addAddress($to); // Add sender
            $mail->addReplyTo($from); // Adress to reply
            $mail->isHTML(true); // use HTML message
            $mail->Subject = $subject;
            $mail->Body = $message;
  
            // SEND
            if( !$mail->send() ){
                $_SESSION['message']="Error with sending email";
            }
            else{
                $_SESSION['message']="Please check your email and verify.Please check the spam folder";
                return true;
            }
  
        }
    ?>
