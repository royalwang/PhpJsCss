<?php
namespace App\Lib2;

echo "<br> Current namespace " . __NAMESPACE__ . "<br>";
/**
* 
*/

class MyClass2
{	
	private $hTxtPriv = "Hello text private";
	public $hTxtPub = "Hello text public";
	protected $hTxtPro = "Hello text protected";

	public function WhoAmI(){
		return "Second class " . __METHOD__ . "<br>";
	}	

	protected function HelloPro($txt = "HOHoHo"){
		echo "<br>";
		echo $this->hTxtPub;
		echo $this->hTxtPriv;
		echo $this->hTxtPro;
		echo "<br>";
		return $txt;
	}

	private function HelloPriv($txt = "HOHoHo"){
		echo "<br>";
		echo $this->hTxtPub;
		echo $this->hTxtPriv;
		echo $this->hTxtPro;
		echo "<br>";
		return $txt;
	}

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
}


?>
