<?php

if(!isset($_POST['to'])) {
    echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">input email<input type="text" name="to"><input type="submit" value="Send"></form> 5';
    die;
}

error_reporting(E_ALL ^ (E_NOTICE. E_WARNING. E_DEPRECATED));
include 'phpmailer/PHPMailerAutoload.php';

function phpMailer($to, $from, $fromName, $replyto, $replytoName, $subject, $body) { 
	$result = array();
	$mail = new PHPMailer();
	$mail->IsSMTP(true);
	$mail->SMTPDebug = 3;
	$mail->SMTPAuth = true;
	$mail->Host = "mail.topart.services";
	$mail->SMTPSecure = 'tls';
	$mail->Port = 465;
	$mail->Username = "noreplay@topart.services";
	$mail->Password = "2#EHS6cQp!C.";
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

$from = 'noreplay@topart.services';
phpMailer($_POST['to'], $from, $from, $from, $from, 'Test', 'Just test');
?>
