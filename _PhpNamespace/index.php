<?php
/*
	!!! PHP namespaces import classes !!!
*/

// Import and use alias
use App\Lib1\MyClass1 as MC1;
use App\Lib2\MyClass2 as MC2;
use App\Zupa\Zimna\MyClass3 as MC3;

// First class
$obj1 = new MC1();
echo $obj1->WhoAmI();

// Second class from App/Lib2/MyClass2
$obj2 = new MC2();
echo $obj2->WhoAmI();

// Third class from App/Zupa/Zimna/MyClass3
$obj3 = new MC3();
echo $obj3->WhoAmI();

// Show current namespace
echo "<br> Current namespace " . __NAMESPACE__ . " (root app file empty)";

// autoload function
function __autoload($class) {
	// convert namespace to full file path
	$class = 'classes/' . str_replace('\\', '/', $class) . '.php';
	require_once($class);
}

?>
