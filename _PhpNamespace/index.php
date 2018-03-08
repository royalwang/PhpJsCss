<?php
// Importowanie i aliasy
use App\Lib1\MyClass1 as MC1;
use App\Lib2\MyClass2 as MC2;
use App\Zupa\Zimna\MyClass3 as MC3;

// Klasa pochdna klasy 2
use App\Lib2\MyClass4 as MC4;

// First class
$obj1 = new MC1();
echo $obj1->WhoAmI();

// Druga klasa z App/Lib2/MyClass2
$obj2 = new MC2();
echo $obj2->WhoAmI();

// Trzecia klasa z App/Zupa/Zimna/MyClass3
$obj3 = new MC3();
echo $obj3->WhoAmI();

// Klasa pochodna
echo "<br>===========================<br>";
$obj4 = new MC4();
echo $obj4->Show();
echo "<br>===========================<br>";

// SBieząca nazwa namespace
echo "<br> Current namespace " . __NAMESPACE__ . " (root app file empty)";

// autoload
function __autoload($class) {
	// convert namespace to full file path
	$class = 'classes/' . str_replace('\\', '/', $class) . '.php';
	require_once($class);
}

?>
