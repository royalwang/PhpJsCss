<?php
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

// use before insert data to mysql query
Clear();
?>
