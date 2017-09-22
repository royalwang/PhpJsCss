<?php
require_once('class.phpmailer.php');
include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

// $body             = file_get_contents('contents.html');
$body             = '<h1>simple test 1 000 email send</h1>';
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "qflash.pl"; // SMTP server
$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->CharSet = "utf-8";                 // polish characters
// $mail->SMTPSecure = "tls";                 // tls or ssl as you need
$mail->SMTPSecure = "ssl"; 
// $mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
//$mail->Username   = "noreply@email.cxz"; // SMTP account username
//$mail->Password   = "BleBleBle";        // SMTP account password
$mail->SetFrom('noreply@breakermind.com', 'Hello');
$mail->AddReplyTo("noreply@breakermind.com","Hi");
$mail->Subject    = "PHPMailer Test Subject via smtp, basic with authentication or without authentication";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$address = "info@qflash.pl";
$mail->AddAddress($address, "Hello gmail");

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
$i = 1;
while ($i <= 1){
	$mail->MsgHTML( $body." nr: ".$i." time: ".date('Y-m-d H:i:s', time()) );
	if(!$mail->Send()) {
	  echo "Mailer Error: " . $mail->ErrorInfo." nr ".$i;
	} else {
	  echo "Message sent! nr: ".$i;
	}
$i++;
}

?>