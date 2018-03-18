<?php
namespace Xlib\Pdo;

class Credentials
{	
	public $mysqlhost = "localhost";
	public $mysqluser ="root";
	public $mysqlpass = "";
	public $mysqlport = "3306";
	public $mysqldb = "moto";

	function __construct(){
		ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '200M');
        ini_set('max_input_time', 0);
        ini_set('max_execution_time', 0);
	}
}
?>