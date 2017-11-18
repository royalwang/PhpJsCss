<?php
error_reporting('E_ALL');
// only from localhost
//ini_set('sendmail_from', 'hello@domain.com');
//echo mail('hello@breakermind.com', 'DKIM test', 'DKIM test ..... works');
require 'mailer/PHPMailerAutoload.php';
require_once('mailer/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
$body             = file_get_contents('body.html');
$body             = eregi_replace("[\]",'',$body);
$mail             = new PHPMailer();
// Add dkim keys
if (!empty($DKIMdomain)) {
	$mail->DKIM_domain = $DKIMdomain; 		// domain dns
	$mail->DKIM_private = $DKIMprivkey;		// private key path to file
	$mail->DKIM_selector = $DKIMselector;  	//this effects what you put in your DNS record
	$mail->DKIM_passphrase = $DKIMpassword;	// nothing if empty
}
		
$mail->IsSMTP(); 
$mail->Host       = "domain.com";           // SMTP server
$mail ->CharSet = "utf-8";                 // polish characters
$mail->SMTPSecure = "tls";                 // tls or ssl as you need
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
//$mail->SMTPDebug  = 1;                   // 1 = errors and messages, 2 = messages only
$mail->Username   = "hello@domain.com";     // SMTP account username
$mail->Password   = "###############";     // SMTP account password
$mail->SetFrom('hello@domain.com', 'Marcyś');
$mail->AddReplyTo("hello@domain.com","Breakermind");
$mail->Subject    = "PHPMailer Test Subject ąćńółśężźńąą via smtp, basic with authentication";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
$mail->MsgHTML($body);
$address = "hello@breakermind.com";
$mail->AddAddress($address, "Marcyś");
//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
