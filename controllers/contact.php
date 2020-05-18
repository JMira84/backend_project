<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require("models/user.php");

$userModel = new User();

if (isset($_SESSION["user_id"])) {
    $user = $userModel->getLoggedUser();
}

if(isset($_POST["send"])) {

    require("/Users/joaom/vendor/autoload.php");

    $mail = new PHPMailer;

    $mail->CharSet = 'UTF-8';

    $mail->isSMTP();

    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    $mail->SMTPDebug = 0;

    $mail->Host = "smtp.gmail.com";

    $mail->Port = 587;

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->SMTPAuth = true;

    $mail->Username = "joao.mira01@gmail.com";

    $mail->Password = "kpfdvhxszspmccpk";

    $mail->setFrom($_POST["email"], $_POST["name"]);

    $mail->addAddress("joao.mira01@gmail.com", "João Mira");

    $mail->Subject = $_POST["subject"];

    $mail->Body = $_POST["message"];

    $mail->send();

    if (!$mail->send()) {
        echo 'Erro de envio: ' . $mail->ErrorInfo;
    } else {
        $email_message = "Mensagem enviada";
    }
}

require("views/contact.php");