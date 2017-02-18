<?php
  // polskie znaki
	function mail_register_utf8($email, $from_user = "Breakermind.com", $from_email = "forex@breakermind.com", $subject = 'Breakermind - Welcome! Register confirmation.')
   	{
   		ini_set("sendmail_from", "noreply@fxstar.eu");
      	$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
      	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";      	
      	$headers = "From: $from_user <$from_email>" . "\r\n" . "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=UTF-8" . "\r\n" . "Reply-to: <$from_email>" . "\r\n";
    	return mail($email, $subject, 'Your profil was created. If not you ignore this email.' , $headers);
   	}

  // bez polskich
	function mail_register($email){
		ini_set("sendmail_from", "noreply@fxstar.eu");
		//ini_set('smtp_port', 25);				
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		$headers[] = 'From: Breakermind.com <forex@breakermind.com>';
		$headers[] = 'Reply-to: <forex@breakermind.com>';
		$m = mail($email, "Breakermind - Welcome! Register confirmation.", 'Your profil was created."', implode('\r\n', $headers));
		return $m;
	}
 ?>
