<?php
namespace App\Lib1;

echo "<br> Current namespace " . __NAMESPACE__ . "<br>";

class MyClass1 {
	public function WhoAmI() {
		return __METHOD__ . "<br>";
	}
}
?>