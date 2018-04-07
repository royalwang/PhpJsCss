$backup_file = 'db-newsletter' . date("Y-m-d-H-i-s") . '.sql';

exec('C:\xampp\mysql\bin\mysqldump --opt -user root -password toor -host localhost newsletter > db-newsletter.sql');

//$sql = "SELECT * INTO OUTFILE `dbnewsletter.sql` FROM newsletter";
//echo $st = $db->query($sql);
