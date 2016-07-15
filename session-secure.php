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

// secure id value integer
$id = (int)$_GET['userid'];
$id = (int)$_POST['userid'];

// How secure POST values from html <form> when you click submit button in form
echo "POST username " . $username = htmlentities($_POST['username'], ENT_QUOTES, 'utf-8');

// when click on form button
if(isset($_POST['submit'])){
    // Username from form ( . <- concat text and variable in one string)
    echo "Username from form " . $_POST['username'] . "<br>";
    
    // print array with file(s) to upload
    echo "Files from form (only images allowed): <br>";
    print_r($_FILES);
    
    // single file upload
    $uploads_dir = 'uploads2';
    // create folder
    mkdir($uploads_dir, 0755, true);    
    $name = $_FILES["file"]["name"];
    move_uploaded_file($_FILES["file"]["tmp_name"], "$uploads_dir/".$name);
    // end single file upload
    
    // AND multiple file upload
    $uploads_dir = 'uploads1';
    // create folder
    mkdir($uploads_dir, 0755, true);
    // allowed file extensions only images
    $allowed = array('gif','jpg','jpeg','png');
    // upload files
    foreach ($_FILES["file"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["file"]["tmp_name"][$key];
            $name = $_FILES["file"]["name"][$key];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            // check files extensions
            if (in_array($ext, $allowed)) {              
              // upload file to server folder
              move_uploaded_file($tmp_name, $uploads_dir."/".$name);
            }
        }
    }
    // end multiple file upload
  
}
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

<?php
// clear POST and GET input 
function Clear(){
  foreach ($_GET as $key => $val) { 
      if (is_string($val)) { 
          $_GET[$key] = htmlentities($val, ENT_QUOTES, 'UTF-8'); 
      } else if (is_array($val)) { 
          $_GET[$key] = Clear($val); 
      } 
  } 
  foreach ($_POST as $key => $val) { 
      if (is_string($val)) { 
          $_POST[$key] = htmlentities($val, ENT_QUOTES, 'UTF-8'); 
      } else if (is_array($val)) { 
          $_POST[$key] = Clear($val); 
      } 
  } 
}
// use
Clear();

// PDO mysql connection
function Conn(){
$connection = new PDO('mysql:host=localhost;dbname=xmail;mysql:charset=utf8mb4', 'root', 'toor');
// don't cache query
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
// throw error exception
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// show warning text
//$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
// don't colose connecion on script end
$connection->setAttribute(PDO::ATTR_PERSISTENT, false);
// set utf for connection
$connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
return $connection;
}

// strip java script tags from html content
function strip_javascript($filter, $allowed=1){
if($allowed == 1) // 1 href=...
$filter = preg_replace('/href=([\'"]).*?javascript:.*?\\1/i', "'", $filter);

if($allowed == 1) // 2 <script....
$filter = preg_replace("/<script.*?>.*?<\/script>/i", "", $filter);

if($allowed == 1) // 4 <tag on.... ---- useful for onlick or onload
$filter = preg_replace("/<(.*)?\son.+?=\s*?(['\"]).*?\\2/i", "<$1", $filter);
return $filter;
}

?>



