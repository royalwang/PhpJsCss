# Blastex_wp Smtp email client for Wordpress

Wordpress smtp client SSL/TLS. Send emails without smtp server with html (gets mx hosts from dns servers). How to override wp_mail function in wordpress. You don't need install smtp server!

### Send emails with wp_mail function (Only secure connections with SSL/TLS)
```php
<?php
// Install and activate plugin and send emails
wp_mail($to, $subject, $html);
?>
```
