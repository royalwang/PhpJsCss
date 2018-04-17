# PhpMailer send email from php

```php
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendmail($to = 'hello@breakermind.com',$to_name = 'Marcys',$sub = '', $msg = '', $from = 'noreply@xx.xx', $from_name = 'Roninex'){	
	$mail = new PHPMailer(true); // true - enables exceptions
	try {
		$mail->CharSet = 'UTF-8';
	    $mail->SMTPDebug = 0; // 0,1,2
	    $mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
	    $mail->isSMTP();   
	    $mail->Host = 'host.xx.xx';
	    $mail->SMTPAuth = true;                 
	    $mail->Username = 'noreply@xx.xx';
	    $mail->Password = '';
	    $mail->SMTPSecure = 'tls'; // tls, ssl
	    $mail->Port = 587;
	    $mail->setFrom($from, $from_name);
	    //Recipients
	    $mail->addAddress($to, $to_name);     
	    $mail->addReplyTo($from,'Name');
	    //Content
	    $mail->isHTML(true); // Set email format to HTML
	    $mail->Subject = $sub;
	    $mail->Body    = '<div>'.$msg.'</div>';
	    $mail->AltBody = 'Przełącz e-mail do trybu html!';
	    if(!$mail->Send()){
            return false;
        } else {        	
            return true;	        	
        }		    
	} catch (Exception $e) {
	    // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	    return false;	    
	}
}
?>
```
