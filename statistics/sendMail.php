<?php

require('include.php');

ob_start();
include(TPL_PATH.'statistics/mail.tpl.html');
$mailContent = ob_get_clean();

$now = whatTimeIsIt();

require_once(LIB_PATH.'PHPMailer/PHPMailerAutoload.php');

$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = Query::getParam('smtp_host');
$mail->SMTPAuth = Query::getParam('smtp_auth');
$mail->Username = Query::getParam('smtp_username');
$mail->Password = Query::getParam('smtp_password');
$mail->SMTPSecure = Query::getParam('smtp_secure');

$mail->From = Query::getParam('mail_from');
$mail->FromName = Query::getParam('mail_from_name');
$receiver = Query::getParam('mail_receiver');
$mail->addAddress($receiver, Query::getParam('mail_receiver_name'));

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


