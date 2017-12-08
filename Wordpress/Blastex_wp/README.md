# Blastex_wp Smtp email client plugin for Wordpress

Wordpress smtp client plugin with SSL/TLS. Send emails without smtp server with html from wp_mail function (gets mx hosts from dns servers). You don't need install smtp server. See how to override wp_mail function in wordpress.

### Send emails with wp_mail function (Only secure connections with SSL/TLS)
```php
<?php
    
  $to = 'hello@emal.com, hello@boom.com';
  $subject 'Hello from email client';
  $html = '<h1>Hello message from smtp !!! </h1> <br> <p> Message from wordpress plugin! </p>';
  
  $attachments = array( 'path/to/file1' , 'path/to/file2' );

  // Install and activate plugin and send emails with attachments
  $ok = wp_mail($to, $subject, $html, $attachments);
  // or without
  $ok = wp_mail($to, $subject, $html);
  
  // Show error
  echo $ok;
  
?>
```

#### Blastex_wp License
```
License:
1) Commercial use only after 10 USD Donation on PayPal account: hello@breakermind.com
2) Private use for Free (0.00 USD)
```
