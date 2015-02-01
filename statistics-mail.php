<?php

require('statistics.inc.php');

ob_start();
include(TPL_PATH.'statistics-mail.tpl.html');
$mailContent = ob_get_clean();

$now = whatTimeIsIt();

require_once(LIB_PATH.'PHPMailer/class.phpmailer.php');

$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = getParam('smtp_host');
$mail->SMTPAuth = getParam('smtp_auth');
$mail->Username = getParam('smtp_username');
$mail->Password = getParam('smtp_password');
$mail->SMTPSecure = getParam('smtp_secure');

$mail->From = getParam('mail_from');
$mail->FromName = getParam('mail_from_name');
$receiver = getParam('mail_receiver');
$mail->addAddress($receiver, getParam('mail_receiver_name'));

$mail->CharSet = 'UTF-8';
$mail->WordWrap = 80;
$mail->isHTML(true);

$mail->Subject = 'Podcast Statistics Report @ ' . $now;
$mail->Body    = $mailContent;
$mail->AltBody = strip_tags($mailContent);

$ret = $mail->send();

echo $now;
echo "\t";
if ($ret) {
    echo 'Sent to ' . $receiver;
} else {
    echo $mail->ErrorInfo;
}


