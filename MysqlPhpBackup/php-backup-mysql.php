<?php
ob_start();
 
$username = "root"; 
$password = ""; 
$hostname = "localhost"; 
$dbname   = "cars";
 
// if mysqldump is on the system path you do not need to specify the full path
// simply use "mysqldump --add-drop-table ..." in this case
$command = "C:\\xampp\\mysql\\bin\\mysqldump --add-drop-table --host=$hostname
    --user=$username ";
if ($password) 
        $command.= "--password=". $password ." "; 
$command.= $dbname;
system($command);
 
$dump = ob_get_contents(); 
ob_end_clean();
 
// send dump file to the output
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($dbname . "_" . 
    date("Y-m-d_H-i-s").".sql"));
flush();
echo $dump;
exit();
?>
