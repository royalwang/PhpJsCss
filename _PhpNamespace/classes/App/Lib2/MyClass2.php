<?php
namespace App\Lib2;

echo "<br> Current namespace " . __NAMESPACE__ . "<br>";

class MyClass2 {
	public function WhoAmI() {
		return "Second class " . __METHOD__ . "<br>";
	}
}
?>