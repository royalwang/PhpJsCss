# PhpMailer example

### With tls
$mail->SMTPSecure = 'tls';

### with ssl
$mail->SMTPSecure = 'ssl';


### no validate tls certificate
$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true) );
