<?php
namespace App\Zupa;
/**
* Zupa\MyClass3
*/

use App\Lib1\MyClass1 as MX1;
use App\Lib2\MyClass2 as MX2;

echo "<br> Current namespace " . __NAMESPACE__ . "<br>";

$objx = new MX1();
echo "Lib1 from Zupa namespace " . $objx->WhoAmI();

class MyClass3
{
	public function WhoAmI() {
		echo "<br><br>";
		
		$objx = new MX2();
		echo "Lib2 from Zupa namespace in class3 Method <br>" . $objx->WhoAmI();

		return "Third class " . __METHOD__ . "<br>";
	}
}
?>