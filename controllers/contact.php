<?php
require("./vendor/autoload.php");
require("config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require("models/category.php");

$categoryModel = new Category();
$categories = $categoryModel->getList();

require("models/user.php");

if(isset($_POST["send"])) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = strip_tags(trim($value));
    }

    if(
        !empty($_POST["name"]) &&
        (mb_strlen($_POST["name"]) >= 2 ||
        mb_strlen($_POST["name"]) < 120) &&
        !empty($_POST["subject"]) &&
        (mb_strlen($_POST["subject"]) > 3 ||
        mb_strlen($_POST["subject"]) < 120) &&
        !empty($_POST["message"]) &&
        filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
    ) {
    
        $mail = new PHPMailer;
    
        $mail->CharSet = 'UTF-8';
    
        $mail->isSMTP();
    
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    
        $mail->SMTPDebug = 0;
    
        $mail->Host = "smtp.gmail.com";
    
        $mail->Port = 587;
    
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    
        $mail->SMTPAuth = true;
    
        $mail->Username = $email_address;
    
        $mail->Password = $email_password;
    
        $mail->setFrom($_POST["email"], $_POST["name"]);
    
        $mail->addAddress($email_address, $name);
    
        $mail->Subject = $_POST["subject"];
    
        $mail->Body = $_POST["message"];
    
        if (!$mail->send()) {
            echo 'Erro de envio: ' . $mail->ErrorInfo;
        } else {
            $email_message = "Mensagem enviada";
        }
    } else {
        $email_alert_message = "Por favor, preencha a área de texto.";
    }
}

require("views/contact.php");