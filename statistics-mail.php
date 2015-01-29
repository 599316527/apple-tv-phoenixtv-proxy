<?php

require('statistics.inc.php');

ob_start();
include(TPL_PATH.'statistics-mail.tpl.html');
$mailContent = ob_get_clean();

$now = whatTimeIsIt();

require_once(LIB_PATH.'PHPMailer/class.phpmailer.php');

$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = SMTP_SERVER;
$mail->SMTPAuth = SMTP_AUTH;
$mail->Username = SMTP_USERNAME;
$mail->Password = SMTP_PASSWORD;
$mail->SMTPSecure = 'tls';

$mail->From = MAIL_FROM;
$mail->FromName = MAIL_FROM_NAME;
$mail->addAddress(MAIL_RECEIVER);

$mail->CharSet = 'UTF-8';
$mail->WordWrap = 80;
$mail->isHTML(true);

$mail->Subject = 'PODCAST訂閱量統計 - ' . $now;
$mail->Body    = $mailContent;
$mail->AltBody = strip_tags($mailContent);

$ret = $mail->send();

echo $now;
echo "\t";
if ($ret) {
    echo 'Sent to ' . MAIL_RECEIVER;
} else {
    echo $mail->ErrorInfo;
}


