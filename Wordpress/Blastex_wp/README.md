# Blastex_wp Smtp email client plugin for Wordpress

Wordpress smtp client plugin with SSL/TLS. Send emails without smtp server with html from wp_mail function (gets mx hosts from dns servers). You don't need install smtp server. See how to override wp_mail function in wordpress.

### Send emails with wp_mail function (Only secure connections with SSL/TLS)
```php
<?php
    
  $to = 'hello@emal.com, hello@boom.com';
  $subject 'Hello from email client';
  $html = '<h1>Hello message from smtp !!! </h1> <br> <p> Message from wordpress plugin! </p>';
  
  // Install and activate plugin and send emails
  wp_mail($to, $subject, $html);
  
?>
```
