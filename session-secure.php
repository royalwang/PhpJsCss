<?php
session_start();
// display errors
ini_set('display_errors', 1);
// show errors 0 - no errors 'E_ALL' - show
error_reporting(0);

// set utf content type (wyświetl polskie znaki w przeglądarce)
header('Content-Type: text/html; charset=utf-8');
// default charset to utf-8 (wyświetl polskie znaki w przeglądarce)
ini_set("default_charset", "UTF-8");

// don't allow javascript(jquery) access to session cookie
ini_set( 'session.cookie_httponly',1);
// session id only cookies no url params
ini_set('session.use_only_cookies',1);
// send cookie only with https connection 1 - https, 0 - http
ini_set('session.cookie_secure',0);

// set session cookie domain
ini_set('session.cookie_domain','domain.loc');
// set session cookie path
ini_set('session.cookie_path', '/');

// session life time 0 - unlimited (seconds) how long cookie live in browser
ini_set('session.cookie_lifetime', 0);
// defines how long an unused PHP session will be kept alive in seconds (default 1440)
ini_set('session.gc_maxlifetime', '1440');

// max post size for example (allow send 5 files x upload 10M)
ini_set("post_max_size","50MB");
// max upload file size
ini_set("upload_max_filesize","10M");

// mail send from 
ini_set('sendmail_from', 'domain.loc');
//ini_set('SMTP','domain.com');
//ini_set('smtp_port',25);

// if session variable is not set redirect to login page
if ($_SESSION['loged'] != 1) {
  // redirect to another page
  // header('Location: login.php');
}

// how set session value
$_SESSION['MAX'] = 'Super jest';
// is set or is empty 
if(isset($_SESSION['MAX'])){
  echo $_SESSION['MAX'];
}
// if not empty
if(!empty($_SESSION['MAX'])){
  echo $_SESSION['MAX'];
}

// array
echo "Show session values (array): " . print_r($_SESSION);
// serialize string
echo "Show session values (serialize): " . serialize($_SESSION);
// json string
echo "Show session values (json): " . json_encode($_SESSION);

// How secure $_GET values it gets from url: 
// http://localhost/index.php?username=Jim&lastname=Jimone
echo "GET username ". $username = htmlentities($_GET['username'], ENT_QUOTES, 'utf-8');

// How secure POST values from html <form> when you click submit button in form
echo "POST username " . $username = htmlentities($_POST['username'], ENT_QUOTES, 'utf-8');

// print array with file(s) to upload
print_r($_FILES);
?>

<form method="post" action="" enctype="multipart/form-data">
  <label>Username</label>
  <input type="text" name="username" placeholder="Insert username" autocomplate="false" value="">
  <!-- single file -->
  <label>Single file</label>
  <input type="file" name="file">
  <!-- multiple files -->
  <label>Multiple files</label>
  <input type="file" name="file[]" multiple>
  <!-- submit button -->
  <input type="submit" name="submit" value="Send POST">
</form>
