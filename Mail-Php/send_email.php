<?php
// Send emai function
function email($to = 'hello@breakermind.com', $subject = 'Witaj !', $from = 'noreply@domain.xx', $fname = 'Albercik'){    
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    // Create email headers
    $headers .= 'From: '.$fname.' <'.$from.">\r\n".
           'Reply-To: '.$from."\r\n" .
           'X-Mailer: PHP/' . phpversion();
    // Compose a simple HTML email message
    $message = '<html><body>';
    $message .= '<h1 style="color:#f40;">Hi Zelda!</h1>';
    $message .= '<p style="color:#080;font-size:18px;">Will you marry me?</p>';
    $message .= '</body></html>';
    // Sending email
    return mail($to, $subject, $message, $headers, '-f '.$from);    
}

// Send email
if(email() == 1){
  echo 'Email has been send.';
}
?>

<?php
// Version with posish characters
function sendmail($email = 'hello@breakermind.com', $subject = "Smtp test", $from_email = "noreply@qflash.pl", $from_user = "Breakermind"){
        ini_set("sendmail_from", $from_email);
        // ini_set('smtp_port', 25);
        // Email
        $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
        $from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
        // Headers
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        // $headers[] = 'Content-type: text/html; charset=iso-8859-2';
        $headers .= "From: ".$from_user." <".$from_email.">\r\n";
        $headers .= "Reply-to: <'.$from_email.'>\r\n";        
        return mail($email, $subject, '<h1>Your profil was created</h1>', $headers, '-f '.$from_email);
}

?>
