<?php
    require_once 'global_call.php';

    use PHPMailer\PHPMailer\PHPMailer;
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = $_ENV['PHPMAIL_HOST'];
    $mail->Port = $_ENV['PHPMAIL_PORT'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['PHPMAIL_FROM'];
    $mail->Password = $_ENV['PHPMAIL_PWRD'];
    $mail->setFrom('information@abuloy.ph', 'Mr. Abuloy');
    $mail->addAddress('information@abuloy.ph', 'Abuloy PH');
    if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
        $mail->Subject = 'Abuloy PH Inquiry';
        $mail->isHTML(false);
        $mail->Body = <<<EOT
            Email: {$_POST['email']}
            Name: {$_POST['name']}
            Message: {$_POST['message']}
        EOT;
        if (!$mail->send()) {
            $msg = 'Sorry, something went wrong. Please try again later.';
        } else {
            $msg = 'Message sent! Thanks for contacting us.';
            echo `<script>$('.form-msg').removeClass('hide')</script>`;
        }
    } else {
        $msg = 'Share it with us!';
    }
?>