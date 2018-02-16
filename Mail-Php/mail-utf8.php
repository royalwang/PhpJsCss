<?php
// Wyślij e-mail z polskimi znakami, postfix www-data override
function sendmail($email, $subject = "Smtp test", $from_user = "Breakermind", $from_email = "noreply@breakermind.com"){
        ini_set("sendmail_from", $from_email);
        ini_set('smtp_port', 25);
        // Subject base64
        $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
	// Subject Quoted
	// $subject = "=?UTF-8?Q?".quoted_printable_encode($subject)."?=";
        $from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
        // Headers
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';
        // $headers[] = 'Content-type: text/html; charset=iso-8859-2';
        $headers[] = 'From: '.$from_user.' <'.$from_email.'>';
        $headers[] = 'Reply-to: <'.$from_email.'>';
        return mail($email, $subject, '<h1>Your profil was created</h1>', implode('\r\n', $headers), '-f '.$from_email);
}
?>
