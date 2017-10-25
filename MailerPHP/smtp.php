<?php
require_once('class.phpmailer.php');
include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
require('PHPMailerAutoload.php');

$mail             = new PHPMailer();

// $body             = file_get_contents('contents.html');
$body             = '<h1>simple test 1 email send</h1>';
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
// $mail->Host       = "tls://domain.pl:25"; // SMTP server
$mail->Host       = "domain.pl"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail ->CharSet = "utf-8";                 // polish characters
$mail->SMTPSecure = "tls";                 // tls or ssl as you need
// $mail->SMTPSecure = false;
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Port       = 25;                    // set the SMTP port for the example server
$mail->Username   = "info@domain.pl"; // SMTP account username
$mail->Password   = "pass";        // SMTP account password

$mail->Sender = 'info@domain.pl';
$mail->SetFrom('info@domain.pl', 'Hello');
$mail->AddReplyTo('info@domain.pl',"Hello");

// To
$mail->AddAddress("nanomoow@example.com");
// CC, BCC
$mail->addCustomHeader("Cc:fxstar@example.com");
$mail->addCustomHeader("Bcc:ho@breakermind.com");

$mail->Subject    = "PHPMailer Test Subject via smtp, basic with authentication";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
//$mail->Body     = 'Hi! This is my first e-mail sent through PHPMailer.';

//Attachments
$mail->AddAttachment("images/phpmailer.gif");      // attachment
// $mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

// Not verify tls certs
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

echo "<pre>";
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
