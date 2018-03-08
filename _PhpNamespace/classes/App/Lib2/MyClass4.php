<?php

namespace App\Lib2;

use App\Lib2\MyClass2;

/**
* 
*/
class MyClass4 extends MyClass2
{	
	function __construct($txt = "ClassAttr")
	{
		echo "Klasa pochodna od klasy MyClass2 <br> " . $this->hTxtPub;
	}

	protected function HelloPro($txt = "Overirde"){
		return "Override protected function";
	}

	// Private się nie dziedziczy !!!
	//private function HelloPriv($txt = "Overirde"){
	//	return "Override private function";
	//}

	public function HelloPub($txt = "HOHoHo"){
		$this->HelloPriv();
		$this->HelloPro();
		echo "<br>";		
		echo $this->hTxtPub;
		echo $this->hTxtPriv;
		echo $this->hTxtPro;
		echo "<br>";
		return $txt;
	}

	public function Show(){
		// echo $this->HelloPriv();
		echo $this->HelloPro();
	}
}
