
<?php

$domain = htmlentities($_GET['id'], ENT_QUOTES, 'utf-8');
if (empty($domain)) {
  $domain = 'fxstar.eu';
}

$hosts = array();
getmxrr('breakermind.com', $hosts);
var_dump($hosts);

 foreach($hosts as $host) {
     echo '<br>'.$host . ' ' . gethostbyname($host) . '<br>';
 }

 $mx = dns_get_record ('breakermind.com', DNS_MX);
 echo "<pre>";
 print_r($mx);


 foreach ($mx as $v) {
   echo $v['pri'] . "<br>";
 }

?>
