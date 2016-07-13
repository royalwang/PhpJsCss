<?php
// PDO funkcja
function Conn(){
  //$connection = new PDO('mysql:host=localhost;dbname=xmail;mysql:charset=utf8mb4', 'root', 'toor');
  // for utf8
  $connection = new PDO('mysql:host=localhost;dbname=xmail;mysql:charset=utf8', 'root', 'toor');
  $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $connection->setAttribute(PDO::ATTR_PERSISTENT, true);
  //$connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
  // for utf8
  $connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
  return $connection;
}
// secure input numbers
$id = (int)$_POST['id'];
// secure input text
$txt = htmlentities($_POST['txt'], ENT_QUOTES, 'utf-8'); // sql injection
// secure pass md5 hash
$pass = md5($_POST['pass']);
try { 
    // połącz do bazydanych mysql
    $db = Conn();
    
    // zapytanie
    $res = $db->query("SELECT * FROM database WHERE id = '$id' AND name = '$txt' GROUP BY id ORDER BY id DESC LIMIT 100");
    
    // rezultat, PDO::FETCH_ASSOC, PDO::FETCH_NUM, PDO::FETCH_OBJ, PDO::FETCH_BOTH, PDO::FETCH_COLUMN, (default FETCH_BOTH)
    $rows = $res->fetchAll(PDO::FETCH_ASSOC);
    
    // policz ile wierszy
    echo $count = $res->rowCount();
    
    // wyświetl tablicę print_r
    print_r($rows);
    
    // lub pętla foreach
    $i = 1;
    foreach ($rows as $row) {
      // if ASSOC lub BOTH
      echo "Wiersz ".$i." Id ".$row['id']." Imię ".$row['name'];
      // if NUM lub BOTH
      echo "Wiersz ".$i." Id ".$row[0]." Imię ".$row[1];
    }
    
    // ERORORS
    print_r($db->errorInfo());
    echo "PDO::errorCode(): ", $db->errorCode();
} catch (PDOException $e) {
    if ($e->getCode() == '2A000')
        echo "Syntax Error: ".$e->getMessage();
} 
// OR LONG VERSION prepare and bind
//$name ="jon"; $pass="pass"; $email = "email@email.ooo";
//$sth = $db->prepare("INSERT INTO example (firstname, lastname, email) VALUES (?, ?, ?)");
//$sth->bind_param("sss", $name, $pass, $email);
//$sth->execute();
//$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
// OR
//$sth = $dbh->prepare('SELECT name, colour, calories FROM fruit WHERE calories < :calories AND colour = :colour');
//$sth->bindParam(':calories', $calories, PDO::PARAM_INT);
//$sth->bindParam(':colour', $colour, PDO::PARAM_STR, 12);
// or
//$sth = $db->prepare('SELECT name, colour, calories FROM fruit WHERE calories < ? AND colour = ? AND colour1 = ? AND colour2 = ?');
//$sth->bindParam(1, $name, PDO::PARAM_STR, 250); 
//$sth->bindParam(2, $pass, PDO::PARAM_INT); 
//$sth->bindParam(3, $color, PDO::PARAM_BOOL); 
//$sth->bindParam(4, $blob, PDO::PARAM_LOB);
//$sth->execute();
//$rows = $sth->fetchAll(PDO::FETCH_BOTH);
?>
