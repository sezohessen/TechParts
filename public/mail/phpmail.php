<?php

if (!isset($_POST['to'])) {
    echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">input email<input type="text" name="to"><input type="submit" value="Send"></form>';
    die;
}

error_reporting(E_ALL ^ (E_NOTICE. E_WARNING. E_DEPRECATED));
include 'phpmailer/PHPMailerAutoload.php';

function phpMailer($to, $from, $fromName, $replyto, $replytoName, $subject, $body) {
	$result = array();
	$mail = new PHPMailer();
	$mail->Debug = 3;
	$mail->CharSet = 'utf-8';
	$mail->SetFrom($from, $fromName);
	$mail->Subject = $subject;
	$mail->MsgHTML($body);
	$mail->ClearReplyTos();
	$mail->AddReplyTo($replyto, $replytoName);
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$result[0] = false;
		$result[1] = 'Mail error: '.$mail->ErrorInfo;
		echo 'Mail error: '.$mail->ErrorInfo;
		return $result;
	} else {
		$result[0] = true;
		$result[1] = 'Message sent!';
		echo 'Message sent!';
		return $result;
	}
}

$domain = preg_replace('/^www\./i', '', $_SERVER['HTTP_HOST']);

if ($domain == 'localhost') {
    $domain = 'localhost.com';
} else if ($domain == 'localhost:8080') {
    $domain = gethostname();
}

$from = 'info@' . $domain;
phpMailer($_POST['to'], $from, 'info', $from, 'info', 'Test', 'Just test');
?>
